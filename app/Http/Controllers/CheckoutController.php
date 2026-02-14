<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use App\Services\BillingService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Throwable;

class CheckoutController extends Controller
{
    public function handleCallback(Request $request)
    {
        $data = $request->all();

        // Log silent POST callback from Bank of America
        Log::channel('checkout')->info('🔔 /checkout/callback — Silent POST from BoA', [
            'ip' => $request->ip(),
            'raw' => file_get_contents('php://input'),
            'parsed' => $data,
        ]);

        return response('OK');
    }

    /**
     * Debug #1: Signed fields / signature sanity check.
     * Use to confirm signed_field_names includes required items (e.g., card_type).
     */
    private function ddSigned(array $fields, string $signature): void
    {
        dd([
            'signed_field_names' => $fields['signed_field_names'] ?? null,
            'has_card_type_in_signed' => isset($fields['signed_field_names'])
                ? str_contains((string)$fields['signed_field_names'], 'card_type')
                : false,
            'card_type' => $fields['card_type'] ?? null,
            'signature' => $signature,
        ]);
    }

    /**
     * Debug #2: Full payload that will be used to build checkout_post.
     * Shows apiUrl + fields + signature + card (unsigned).
     */
    private function ddPreparePayload(
        string $apiUrl,
        array $fields,
        string $signature,
        array $validated
    ): void {
        dd([
            'apiUrl' => $apiUrl,
            'fields' => $fields,
            'signature' => $signature,
            'card' => [
                'card_number' => $validated['card_number'] ?? null,
                'card_expiry_date' => $validated['card_expiry_date'] ?? null,
                'card_cvn' => $validated['card_cvn'] ?? null,
            ],
        ]);
    }

    private function ddCheckout(string $mode, string $apiUrl, array $fields, string $signature, array $validated): void
    {
        if ($mode === 'signed') {
            $this->ddSigned($fields, $signature);
        }
        if ($mode === 'full') {
            $this->ddPreparePayload($apiUrl, $fields, $signature, $validated);
        }
    }

    private function saEndpoint(string $key): string
    {
        if (!config('secure_acceptance.enabled')) {
            throw new \RuntimeException('Secure Acceptance is disabled (BOA_SA_ENABLED=false).');
        }

        $url = (string) config("secure_acceptance.endpoints.$key");
        if ($url === '') {
            throw new \RuntimeException("Secure Acceptance endpoint [$key] is not configured.");
        }

        return $url;
    }

    public function checkout(Request $request)
    {
        $accessKey = env('SECURE_ACCEPTANCE_ACCESS_KEY');
        $profileId = env('SECURE_ACCEPTANCE_PROFILE_ID');
        $secretKey = env('SECURE_ACCEPTANCE_SECRET_KEY');
        $apiUrl = env('SECURE_ACCEPTANCE_API_URL');

        return view('checkout', [
            'access_key' => $accessKey,
            'profile_id' => $profileId,
            'secret_key' => $secretKey,
            'apiUrl' => $apiUrl,
        ]);
    }

    public function prepare(Request $request)
    {
        // ----------------------------
        // A) Cart truth
        // ----------------------------
        [$itemsPresent, $total] = $this->calculateCartTotalFromSession();

        // Intent: trial / purchase / restore (server-truth by cart)
        $intent = $this->detectIntentFromCart($itemsPresent);

        // trial: идём в token_create даже при total=0
        $needsTokenization = ($intent === 'trial');

        // деньги > 0 => обычный платёж
        $requiresPayment = ((float)$total) > 0.0;

        // карта нужна если платёж ИЛИ токенизация
        $needsCard = $requiresPayment || $needsTokenization;

        if (empty($itemsPresent)) {
            return back()
                ->withErrors(['cart' => 'No items in your cart. Please add products before proceeding.'])
                ->withInput();
        }

        // ----------------------------
        // B) Normalize inputs (card + billing)
        // ----------------------------
        $this->normalizeRequest($request);

        // ----------------------------
        // C) Validate (billing always, card only if requiresPayment)
        // ----------------------------
        [$validated, $stateCode] = $this->validateCheckout($request, $needsCard);

        if ($stateCode === null) {
            return back()->withErrors(['bill_state' => 'Invalid US state.'])->withInput();
        }

        // ----------------------------
        // D) Ensure user (guest register/login)
        // ----------------------------
        $email = $this->ensureUserAndGetEmail($validated);

        // E) Gateway needed?
        $needsGateway = $requiresPayment || $needsTokenization;

        if (!$needsGateway) {
            return $this->finalizeBillingAndRespond([
                'type' => 'free',
                'total' => number_format((float)$total, 2, '.', ''),
            ]);
        }

        // ----------------------------
        // F) PAID FLOW: готовим BoA Secure Acceptance redirect
        // ----------------------------
        if (!$this->secureAcceptanceEnabled()) {
            return back()->withErrors(['payment' => 'Payment gateway is disabled.'])->withInput();
        }

        if ($this->isStubMode()) {
            return $this->finalizeBillingAndRespond([
                'type' => 'stub',
                'total' => number_format((float)$total, 2, '.', ''),
            ]);
        }

        // Создаём контекст "ожидаем оплату/токенизацию" — ОБЯЗАТЕЛЬНО до запроса в BoA
        $order = $this->createPendingOrderContext($itemsPresent, $total, $email, $validated, $stateCode);

        // Выбираем endpoint и поля по intent
        if ($needsTokenization) {
            $apiUrl = $this->saEndpoint('token_create');
            $fields = $this->buildTokenCreateFields($order, $validated, $email, $stateCode);
        } else {
            $apiUrl = $this->saEndpoint('pay');
            $fields = $this->buildPayFields($order, $validated, $email, $stateCode);
        }

        // Подпись
        $signature = $this->signSecureAcceptance($fields, env('SECURE_ACCEPTANCE_SECRET_KEY'));

        // Отдаём прокладку, которая POST'ит в BoA
        return view('checkout_post', [
            'apiUrl' => $apiUrl,
            'fields' => $fields,
            'signature' => $signature,

            // UNSIGNED поля карты — добавятся hidden в форме
            'card_number' => (string) ($validated['card_number'] ?? ''),
            'card_expiry_date' => (string) ($validated['card_expiry_date'] ?? ''),
            'card_cvn' => (string) ($validated['card_cvn'] ?? ''),
        ]);
    }

    public function paymentResult(Request $request)
    {
        Log::channel('checkout')->info('/payment/result hit', [
            'method' => $request->method(),
        ]);

        // Do NOT log full payload in production (it may contain sensitive data).
        // Log only minimal routing identifiers.
        Log::channel('checkout')->info('/payment/result meta', [
            'req_reference_number' => (string)$request->get('req_reference_number'),
            'transaction_id'       => (string)$request->get('transaction_id'),
            'req_transaction_type' => (string)$request->get('req_transaction_type'),
            'decision'             => (string)$request->get('decision'),
            'reason_code'          => (string)$request->get('reason_code'),
        ]);

        // 1) Verify Secure Acceptance signature first.
        if (!$this->verifySecureAcceptanceResponse($request->all())) {
            Log::channel('checkout')->warning('Invalid BoA signature on /payment/result', [
                'req_reference_number' => (string)$request->get('req_reference_number'),
            ]);

            return view('cancelled', [
                'data' => $this->formatResultData($request),
                'errorsOut' => ['Invalid payment signature.'],
            ]);
        }

        $provider         = 'boa';
        $decision         = (string)$request->get('decision');
        $reasonCode       = (string)$request->get('reason_code');          // 100 = OK
        $authResponse     = (string)$request->get('auth_response');        // often "00" for charge
        $txType           = (string)$request->get('req_transaction_type'); // create_payment_token / sale / authorization
        $referenceNumber  = (string)$request->get('req_reference_number');

        if ($referenceNumber === '') {
            Log::channel('checkout')->warning('Missing reference number on /payment/result');

            return view('cancelled', [
                'data' => $this->formatResultData($request),
                'errorsOut' => ['Missing reference number in payment response.'],
            ]);
        }

        // 2) Record callback into payment_events (raw + parsed) for audit + idempotency on входе.
        // NOTE: transaction_id may be empty on some gateway flows; create a deterministic fallback ID.
        $rawPayload = (string)$request->getContent();
        $txId = (string)$request->get('transaction_id');

        if ($txId === '') {
            // Fallback transaction id must be stable enough to deduplicate retries for the same callback.
            $seed = $referenceNumber . '|' .
                (string)$request->get('request_token') . '|' .
                (string)$request->get('signed_date_time') . '|' .
                $rawPayload;

            $txId = 'missing:' . sha1($seed); // 48 chars max
            Log::channel('checkout')->warning('Missing transaction_id; using fallback hash id', [
                'reference_number' => $referenceNumber,
                'fallback_txid' => $txId,
            ]);
        }

        $parsedPayloadJson = json_encode($request->all(), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        if ($parsedPayloadJson === false) {
            $parsedPayloadJson = json_encode([
                '_error' => 'json_encode_failed',
                'message' => json_last_error_msg(),
            ], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        }

        $flow = ($txType === 'create_payment_token') ? 'token_create' : 'pay';

        $amountRaw = $request->get('auth_amount') ?? $request->get('req_amount');

        if ($flow === 'token_create') {
            // Trial — нет денежной операции
            $amount = '0.00';
        } else {
            // Обычный платёж
            $amount = ($amountRaw !== null && $amountRaw !== '')
                ? (string)$amountRaw
                : null;
        }

        // Insert payment event with UNIQUE(provider, transaction_id).
        $shouldProcess = true;
        try {
            DB::table('payment_events')->insert([
                'provider'         => $provider,
                'reference_number' => $referenceNumber,
                'transaction_id'   => $txId,
                'flow'             => $flow,
                'decision'         => $decision,
                'reason_code'      => $reasonCode,
                'auth_response'    => $authResponse,
                'amount'           => $amount,
                'currency'         => (string)($request->get('req_currency') ?? 'USD'),
                'raw_payload'      => $rawPayload,
                'parsed_payload'   => $parsedPayloadJson,
                'received_at'      => now(),
                'created_at'       => now(),
                'updated_at'       => now(),
            ]);

            Log::channel('checkout')->info('Payment event recorded', [
                'reference_number' => $referenceNumber,
                'transaction_id' => $txId,
                'flow' => $flow,
            ]);
        } catch (\Throwable $e) {
            // SQLSTATE 23000 = integrity constraint violation (duplicate unique).
            $sqlState = (string)($e->getCode() ?? '');
            if ($sqlState !== '23000') {
                Log::channel('checkout')->error('Failed to insert payment_event', [
                    'reference_number' => $referenceNumber,
                    'transaction_id' => $txId,
                    'error' => $e->getMessage(),
                ]);
                throw $e;
            }

            $existing = DB::table('payment_events')
                ->where('provider', $provider)
                ->where(function ($q) use ($txId, $flow, $referenceNumber) {
                    // UNIQUE(provider, transaction_id)
                    $q->where('transaction_id', $txId)

                    // UNIQUE(provider, flow, reference_number)
                    ->orWhere(function ($q2) use ($flow, $referenceNumber) {
                        $q2->where('flow', $flow)
                            ->where('reference_number', $referenceNumber);
                    });
                })
                ->orderByDesc('id')
                ->first();

            if (!$existing) {
                Log::channel('checkout')->critical('Duplicate payment callback but existing payment_event not found (unique conflict mismatch)', [
                    'reference_number' => $referenceNumber,
                    'transaction_id'   => $txId,
                    'flow'             => $flow,
                ]);

                // Важно: НЕ продолжаем обработку, чтобы не было двойной финализации.
                return view('thank-you', [
                    'messages' => ['Callback already received.'],
                    'data' => $this->formatResultData($request),
                ]);
            }

            Log::channel('checkout')->warning('Duplicate payment callback detected (idempotent gate)', [
                'reference_number'       => $referenceNumber,
                'transaction_id'         => $txId,
                'flow'                   => $flow,
                'existing_id'            => $existing->id ?? null,
                'existing_transaction_id'=> $existing->transaction_id ?? null,
                'existing_processed_at'  => $existing->processed_at ?? null,
                'existing_status'        => $existing->process_status ?? null,
            ]);

            $status = $existing->process_status ?? null;

            if ($status === 'ok') {
                // Уже успешно обработали — повтор не нужен
                return view('thank-you', [
                    'messages' => ['Callback already processed.'],
                    'data' => $this->formatResultData($request),
                ]);
            }

            if ($status === 'skipped') {
                // Уже решено, что не обрабатываем (например, DECLINE) — повтор не нужен
                return view('cancelled', [
                    'data' => $this->formatResultData($request),
                    'errorsOut' => ['Callback already processed (previously skipped).'],
                ]);
            }

            // status === 'error' OR NULL → разрешаем retry (например, прошлый раз упали по DB/коду)
            $shouldProcess = true;

        }

        // 3) Load pending order context: Cache first, DB fallback (pending_orders).
        $pendingKey = "pending_payment:{$referenceNumber}";
        $pending = Cache::get($pendingKey);

        if (!$pending) {
            $row = DB::table('pending_orders')->where('reference_number', $referenceNumber)->first();

            if ($row) {
                $decodedPayloads = [];
                if (!empty($row->payloads)) {
                    $decodedPayloads = json_decode((string)$row->payloads, true);
                    if (!is_array($decodedPayloads)) {
                        $decodedPayloads = [];
                    }
                }

                $pending = [
                    'reference_number' => (string)$row->reference_number,
                    'user_id' => (int)$row->user_id,
                    'intent' => (string)$row->intent,
                    'payloads' => $decodedPayloads,
                    'items' => array_keys($decodedPayloads),
                    'total' => (string)$row->total,
                    // email/billing fields are not required for finalize; keep null-safe
                    'email' => null,
                ];

                Log::channel('checkout')->info('Pending order restored from DB', [
                    'reference_number' => $referenceNumber,
                    'user_id' => $pending['user_id'] ?? null,
                    'intent' => $pending['intent'] ?? null,
                ]);
            }
        }

        if (!$pending) {
            Log::channel('checkout')->error('Pending order not found in cache nor DB', [
                'reference_number' => $referenceNumber,
                'transaction_id' => $txId,
            ]);

            // Update payment_events processing status for forensic visibility.
            DB::table('payment_events')
                ->where('provider', $provider)
                ->where('transaction_id', $txId)
                ->update([
                    'process_status' => 'error',
                    'process_error' => 'Pending order context not found (cache/DB).',
                    'processed_at' => now(),
                    'updated_at' => now(),
                ]);

            return view('cancelled', [
                'data' => $this->formatResultData($request),
                'errorsOut' => ['Payment was accepted, but order context was not found. Contact support.'],
            ]);
        }

        // 4) Determine flow reliably.
        $intent = (string)($pending['intent'] ?? 'purchase');
        $isTokenFlow = ($intent === 'trial') || ($txType === 'create_payment_token');

        // 5) Validate gateway success rules.
        $isAccepted = ($decision === 'ACCEPT');
        $isReasonOk = ($reasonCode === '' || $reasonCode === '100');

        // For tokenization flow, do not require auth_response.
        // For real charge flows, auth_response should usually be "00".
        $isAuthorized = ($authResponse === '' || $authResponse === '00');

        $isOk = $isTokenFlow
            ? ($isAccepted && $isReasonOk)
            : ($isAccepted && $isReasonOk && $isAuthorized);

        if (!hash_equals((string)($pending['reference_number'] ?? ''), $referenceNumber)) {
            Log::channel('checkout')->warning('Reference number mismatch', [
                'pending' => $pending['reference_number'] ?? null,
                'incoming' => $referenceNumber,
            ]);

            DB::table('payment_events')
                ->where('provider', $provider)
                ->where('transaction_id', $txId)
                ->update([
                    'process_status' => 'error',
                    'process_error' => 'Reference number mismatch (pending vs incoming).',
                    'processed_at' => now(),
                    'updated_at' => now(),
                ]);

            return view('cancelled', [
                'data' => $this->formatResultData($request),
                'errorsOut' => ['Payment reference mismatch.'],
            ]);
        }

        if (!$isOk) {
            Log::channel('checkout')->info('Payment not approved by gateway', [
                'reference_number' => $referenceNumber,
                'decision' => $decision,
                'reason_code' => $reasonCode,
                'auth_response' => $authResponse,
                'tx_type' => $txType,
                'is_token_flow' => $isTokenFlow,
            ]);

            DB::table('payment_events')
                ->where('provider', $provider)
                ->where('transaction_id', $txId)
                ->update([
                    'process_status' => 'skipped',
                    'process_error' => 'Gateway decision not approved.',
                    'processed_at' => now(),
                    'updated_at' => now(),
                ]);

            return view('cancelled', [
                'data' => $this->formatResultData($request),
                'errorsOut' => ['Payment was not approved.'],
            ]);
        }

        if (!$shouldProcess) {
            // Safety fallback (should not normally happen).
            return view('thank-you', [
                'messages' => ['Callback received.'],
                'data' => $this->formatResultData($request),
            ]);
        }

        // 6) Build paymentMeta for BillingService.
        $data = $this->formatResultData($request);

        $paymentMeta = [
            'type' => 'boa',
            'flow' => $isTokenFlow ? 'token_create' : 'pay',

            'total' => (string)($request->get('auth_amount') ?? $request->get('req_amount') ?? ($pending['total'] ?? '')),
            'reference_number' => $referenceNumber,
            'transaction_id' => $txId,

            'request_token' => (string)$request->get('request_token'),

            // Tokenization identifiers (future charges / stored card)
            'payment_token' => (string)$request->get('payment_token'),
            'payment_token_customer_id' => (string)$request->get('payment_token_customer_id'),
            'payment_token_payment_instrument_id' => (string)$request->get('payment_token_payment_instrument_id'),
            'payment_token_instrument_identifier_id' => (string)$request->get('payment_token_instrument_identifier_id'),
            'payment_account_reference' => (string)$request->get('payment_account_reference'),

            // Status fields
            'decision' => $decision,
            'reason_code' => $reasonCode,
            'auth_response' => $authResponse,

            // Card meta (do not log/store PAN; req_card_number is masked)
            'card_type_name' => (string)$request->get('card_type_name'),
            'req_card_number' => (string)$request->get('req_card_number'),
            'req_card_expiry_date' => (string)$request->get('req_card_expiry_date'),
        ];

        // 7) Run business logic (Step 4 later will wrap everything into one transaction).
        try {
            $response = $this->finalizeBillingAndRespond($pending, $paymentMeta, $data);

            // Mark event processed successfully.
            DB::table('payment_events')
                ->where('provider', $provider)
                ->where('transaction_id', $txId)
                ->update([
                    'process_status' => 'ok',
                    'process_error' => null,
                    'processed_at' => now(),
                    'updated_at' => now(),
                ]);

            // Cleanup cache after success (DB remains the source of truth).
            Cache::forget($pendingKey);

            return $response;
        } catch (\Throwable $e) {
            Log::channel('checkout')->error('Finalize billing failed', [
                'reference_number' => $referenceNumber,
                'transaction_id' => $txId,
                'error' => $e->getMessage(),
            ]);

            // Mark event processing error for later retry/inspection.
            DB::table('payment_events')
                ->where('provider', $provider)
                ->where('transaction_id', $txId)
                ->update([
                    'process_status' => 'error',
                    'process_error' => $e->getMessage(),
                    'processed_at' => now(),
                    'updated_at' => now(),
                ]);

            return view('cancelled', [
                'data' => $this->formatResultData($request),
                'errorsOut' => ['Payment was accepted, but internal processing failed. Contact support.'],
            ]);
        }
    }

    // =========================================================
    // Helpers: Cart / Validation / User
    // =========================================================

    private function calculateCartTotalFromSession(): array
    {
        $cartItems = [
            'fpds_query_trial',
            'fpds_query_subscription',
            'fpds_report_subscription',
            'single_elementary_report',
            'single_composite_report',
            'elementary_report_package',
            'composite_report_package',
        ];

        $itemsPresent = collect($cartItems)->filter(fn ($k) => session()->has($k))->values()->all();

        $total = 0.00;

        if (session()->has('fpds_query_trial')) {
            $total += (float) session('fpds_query_trial.subscription_price', 0);
        }
        if (session()->has('fpds_query_subscription')) {
            $total += (float) session('fpds_query_subscription.subscription_price', 0);
        }
        if (session()->has('fpds_report_subscription')) {
            $total += (float) session('fpds_report_subscription.subscription_price', 0);
        }
        if (session()->has('single_elementary_report')) {
            $total += (float) session('single_elementary_report.report_price', 0);
        }
        if (session()->has('single_composite_report')) {
            $total += (float) session('single_composite_report.report_price', 0);
        }
        if (session()->has('elementary_report_package')) {
            $total += (float) session('elementary_report_package.package_price', 0);
        }
        if (session()->has('composite_report_package')) {
            $total += (float) session('composite_report_package.package_price', 0);
        }

        return [$itemsPresent, number_format((float)$total, 2, '.', '')];
    }

    private function detectIntentFromCart(array $itemsPresent): string
    {
        if (in_array('fpds_query_trial', $itemsPresent, true)) {
            return 'trial';
        }

        return 'purchase';
    }

    private function normalizeRequest(Request $request): void
    {
        $request->merge([
            'card_number' => preg_replace('/\D+/', '', (string) $request->input('card_number')),
            'card_cvn' => preg_replace('/\D+/', '', (string) $request->input('card_cvn')),
            'bill_country' => strtoupper(trim((string) $request->input('bill_country', 'US'))),
            'bill_state' => trim((string) $request->input('bill_state')),
            'zip' => trim((string) $request->input('zip')),
            'card_expiry_date' => trim((string) $request->input('card_expiry_date')),
            'card_type' => trim((string) $request->input('card_type', '001')),
        ]);
    }

    private function validateCheckout(Request $request, bool $requiresPayment): array
    {
        $baseRules = [
            'name' => ['required','string','max:255','regex:/^[\pL\s\-]+$/u'],
            'surname' => ['required','string','max:255','regex:/^[\pL\s\-]+$/u'],

            'city' => ['required','string','max:255'],
            'address1' => ['required','string','max:255'],
            'address2' => ['nullable','string','max:255'],

            'zip' => ['required','regex:/^\d{5}(-\d{4})?$/'],

            'bill_country' => ['required','in:US'],
            'bill_state' => ['required','string','min:2','max:50'],
            'card_type' => ['required', 'in:001,002,003,004'],
        ];

        $cardRules = [
            'card_number' => ['required','digits_between:13,19', function ($attr, $value, $fail) {
                if (!$this->luhnCheck((string)$value)) $fail('Card number is invalid.');
            }],
            'card_expiry_date' => ['required','regex:/^\d{2}-\d{4}$/', function ($attr, $value, $fail) {
                [$mm, $yyyy] = explode('-', $value);
                $mm = (int) $mm; $yyyy = (int) $yyyy;

                if ($mm < 1 || $mm > 12) return $fail('Expiry month is invalid.');

                $nowY = (int) date('Y');
                $nowM = (int) date('n');

                if ($yyyy < $nowY || ($yyyy === $nowY && $mm < $nowM)) return $fail('Card is expired.');
                if ($yyyy > $nowY + 30) return $fail('Expiry year is invalid.');
            }],
            'card_cvn' => ['required','digits_between:3,4'],
        ];

        $messages = [
            'name.required' => 'First name is required.',
            'name.regex' => 'First name may only contain letters, spaces, and hyphens.',
            'surname.required' => 'Last name is required.',
            'surname.regex' => 'Last name may only contain letters, spaces, and hyphens.',
            'zip.regex' => 'ZIP code must be 5 digits (or 5+4).',
            'card_expiry_date.regex' => 'Expiry date must be in MM-YYYY format.',
            'bill_country.in' => 'Country must be US for now.',
        ];

        $guestRules = [
            'email' => ['required','string','email','max:255','unique:users,email'],
            'confirm_email' => ['required','email','same:email'],
            'password' => [
                'required','string','min:8','confirmed',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/',
            ],
            'password_confirmation' => ['required'],
        ];

        $guestMessages = $messages + [
            'email.required' => 'Email is required.',
            'email.email' => 'Please enter a valid email address.',
            'email.unique' => 'A user with this email already exists.',
            'confirm_email.required' => 'Please confirm your email address.',
            'confirm_email.same' => 'The email confirmation does not match the email.',
            'password.required' => 'Password is required.',
            'password.min' => 'Password must be at least 8 characters long.',
            'password.confirmed' => 'The passwords do not match.',
            'password.regex' => 'Password must contain: uppercase letter, lowercase letter, number, and special character.',
            'password_confirmation.required' => 'Please confirm your password.',
        ];

        $rules = $baseRules;

        if (!Auth::check()) {
            $rules = $rules + $guestRules;
            $messages = $guestMessages;
        }
        if ($requiresPayment) {
            $rules = $rules + $cardRules;
        }

        $validated = Validator::make($request->all(), $rules, $messages)->validate();

        $stateCode = $this->usStateToCode((string)$validated['bill_state']);

        return [$validated, $stateCode];
    }

    private function ensureUserAndGetEmail(array $validated): string
    {
        $email = Auth::check() ? Auth::user()->email : (string) $validated['email'];

        if (!Auth::check()) {
            $user = User::where('email', $email)->first();

            if (!$user) {
                $registerController = new \App\Http\Controllers\RegisterController();
                $user = $registerController->registerThruOrder($validated);
            }

            Auth::login($user, true);
        }

        return $email;
    }

    private function secureAcceptanceEnabled(): bool
    {
        return (bool) env('SECURE_ACCEPTANCE_ACCESS_KEY')
            && (bool) env('SECURE_ACCEPTANCE_PROFILE_ID')
            && (bool) env('SECURE_ACCEPTANCE_SECRET_KEY')
            && (bool) env('SECURE_ACCEPTANCE_API_URL');
    }

    private function isStubMode(): bool
    {
        return env('BOA_SA_MODE', 'live') === 'stub';
    }

    private function createPendingOrderContext(
        array $itemsPresent,
        string $total,
        string $email,
        array $validated,
        string $stateCode
    ): array {
        // Checkout must be tied to an authenticated user.
        // Otherwise we cannot reliably finalize subscriptions/packages on callback.
        $userId = Auth::id();
        if (!$userId) {
            abort(403, 'User must be authenticated to start checkout.');
        }

        $referenceNumber = 'ORDER-' . now()->format('YmdHis') . '-' . Str::random(6);

        // Collect cart payloads from session (subscription/package contexts).
        // IMPORTANT: Keep payloads minimal and serializable (arrays/scalars only).
        $payloads = [];
        foreach ($itemsPresent as $k) {
            $payloads[$k] = session()->get($k);
        }

        $pending = [
            'reference_number' => $referenceNumber,
            'items'            => $itemsPresent,
            'payloads'          => $payloads,
            'total'            => $total,
            'email'            => $email,

            'intent'           => $this->detectIntentFromCart($itemsPresent),
            'user_id'          => $userId,

            'bill_to_forename' => (string)($validated['name'] ?? ''),
            'bill_to_surname'  => (string)($validated['surname'] ?? ''),
            'bill_to_city'     => (string)($validated['city'] ?? ''),
            'bill_to_state'    => (string)$stateCode,
            'bill_to_zip'      => (string)($validated['zip'] ?? ''),
        ];

        // Persist pending order in DB to survive cache eviction / restarts.
        // This guarantees we can finalize billing even if:
        // - the user is logged out
        // - the session is lost
        // - the callback arrives later (minutes/hours)
        $payloadsJson = json_encode(
            $pending['payloads'] ?? [],
            JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES
        );

        if ($payloadsJson === false) {
            Log::channel('checkout')->error('Failed to JSON-encode pending payloads', [
                'reference_number' => $referenceNumber,
                'json_error' => json_last_error_msg(),
            ]);
            abort(500, 'Internal error: unable to prepare checkout payload.');
        }

        // Safety guard: do not allow huge payloads to break DB writes.
        // If you hit this, reduce what you store in session payloads.
        $maxBytes = 500000; // 500 KB
        if (strlen($payloadsJson) > $maxBytes) {
            Log::channel('checkout')->warning('Pending payloads too large; storing minimal marker', [
                'reference_number' => $referenceNumber,
                'bytes' => strlen($payloadsJson),
                'max_bytes' => $maxBytes,
            ]);
            $payloadsJson = json_encode(
                ['_error' => 'payloads_too_large'],
                JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES
            );
        }

        // Use insert-first strategy to preserve original created_at.
        try {
            DB::table('pending_orders')->insert([
                'reference_number' => $referenceNumber,
                'user_id'          => (int)$userId,
                'intent'           => (string)($pending['intent'] ?? 'purchase'),
                'payloads'         => $payloadsJson,
                'total'            => (string)($pending['total'] ?? '0.00'),
                'currency'         => 'USD',
                'status'           => 'pending',
                'created_at'       => now(),
                'updated_at'       => now(),
            ]);
        } catch (\Throwable $e) {
            // Only swallow duplicate key errors; everything else should surface.
            // SQLSTATE 23000 = Integrity constraint violation (duplicate key, etc).
            $sqlState = (string)($e->getCode() ?? '');
            if ($sqlState !== '23000') {
                Log::channel('checkout')->error('Failed to persist pending order', [
                    'reference_number' => $referenceNumber,
                    'user_id' => $userId,
                    'error' => $e->getMessage(),
                ]);
                throw $e;
            }

            DB::table('pending_orders')
                ->where('reference_number', $referenceNumber)
                ->update([
                    'user_id'    => (int)$userId,
                    'intent'     => (string)($pending['intent'] ?? 'purchase'),
                    'payloads'   => $payloadsJson,
                    'total'      => (string)($pending['total'] ?? '0.00'),
                    'currency'   => 'USD',
                    'status'     => 'pending',
                    'updated_at' => now(),
                ]);
        }

        Log::channel('checkout')->info('Pending order persisted in DB', [
            'reference_number' => $referenceNumber,
            'user_id'          => $userId,
            'intent'           => $pending['intent'] ?? null,
            'items'            => $itemsPresent,
        ]);

        return $pending;
    }


    private function buildPayFields(array $order, array $validated, string $email, string $stateCode): array
    {
        $amount = $order['total'];

        $fields = [
            'access_key'        => env('SECURE_ACCEPTANCE_ACCESS_KEY'),
            'profile_id'        => env('SECURE_ACCEPTANCE_PROFILE_ID'),
            'transaction_uuid'  => (string) Str::uuid(),
            'signed_date_time'  => gmdate("Y-m-d\\TH:i:s\\Z"),
            'locale'            => 'en',

            'transaction_type'  => 'sale',
            'reference_number'  => (string) $order['reference_number'],
            'amount'            => (string) $amount,
            'currency'          => 'USD',
            'payment_method'    => 'card',

            'merchant_defined_data1' => (string) ($order['intent'] ?? 'purchase'),
            'merchant_defined_data2' => (string) ($order['user_id'] ?? ''),

            'bill_to_forename'            => (string) $validated['name'],
            'bill_to_surname'             => (string) $validated['surname'],
            'bill_to_email'               => (string) $email,
            'bill_to_address_line1'       => (string) $validated['address1'],
            'bill_to_address_line2'       => (string) ($validated['address2'] ?? ''),
            'bill_to_address_city'        => (string) $validated['city'],
            'bill_to_address_postal_code' => (string) $validated['zip'],
            'bill_to_address_state'       => (string) $stateCode,
            'bill_to_address_country'     => (string) $validated['bill_country'],
            'card_type'         => (string) ($validated['card_type'] ?? '001'),
        ];

        $fields['unsigned_field_names'] = 'card_number,card_expiry_date,card_cvn';

        $fields['signed_field_names'] = implode(',', [
            'access_key',
            'profile_id',
            'transaction_uuid',
            'signed_date_time',
            'locale',
            'transaction_type',
            'reference_number',
            'amount',
            'currency',
            'payment_method',
            'merchant_defined_data1',
            'merchant_defined_data2',
            'bill_to_forename',
            'bill_to_surname',
            'bill_to_email',
            'bill_to_address_line1',
            'bill_to_address_line2',
            'bill_to_address_city',
            'bill_to_address_postal_code',
            'bill_to_address_state',
            'bill_to_address_country',
            'card_type',
            'signed_field_names',
            'unsigned_field_names',
        ]);

        return $fields;
    }

    private function signSecureAcceptance(array $fields, string $secretKey): string
    {
        $signed = explode(',', (string)($fields['signed_field_names'] ?? ''));
        $dataToSign = collect($signed)
            ->map(fn ($name) => $name . '=' . ($fields[$name] ?? ''))
            ->implode(',');

        return base64_encode(hash_hmac('sha256', $dataToSign, $secretKey, true));
    }

    private function finalizeBillingAndRespond(array $pending = [], array $paymentMeta = [], array $dataForView = [])
    {
        $billingService = new BillingService();
        $flow = (string)($paymentMeta['flow'] ?? 'pay');

        // Context for logs (same keys everywhere)
        $ctx = [
            'flow' => $flow,
            'user_id' => $pending['user_id'] ?? null,
            'reference_number' => $pending['reference_number'] ?? ($paymentMeta['reference_number'] ?? null),
            'transaction_id' => $paymentMeta['transaction_id'] ?? null,
            'intent' => $pending['intent'] ?? null,
        ];

        $referenceNumber = (string)($ctx['reference_number'] ?? '');

        try {
            $result = DB::transaction(function () use ($billingService, $pending, $paymentMeta, $flow, $ctx, $referenceNumber) {

                Log::channel('billing')->info('Billing finalize: begin', $ctx);

                // =========================
                // TOKENIZATION FLOW
                // =========================
                if ($flow === 'token_create') {

                    Log::channel('billing')->info('Tokenization: processing payment method', $ctx);
                    $pmResult = $billingService->processTrialTokenization($pending, $paymentMeta);
                    if (!($pmResult['success'] ?? false)) {
                        Log::channel('billing')->error('Tokenization: payment method failed', $ctx + [
                            'errors' => $pmResult['messages'] ?? []
                        ]);
                        throw new \RuntimeException('Tokenization payment method failed.');
                    }

                    Log::channel('billing')->info('Tokenization: creating TRIAL subscription (no billing record)', $ctx);
                    $subResult = $billingService->processTrialSubscriptions($pending, $paymentMeta);
                    if (!($subResult['success'] ?? false)) {
                        Log::channel('billing')->error('Tokenization: trial subscription failed', $ctx + [
                            'errors' => $subResult['messages'] ?? []
                        ]);
                        throw new \RuntimeException('Tokenization subscription failed.');
                    }


                    $messagesOut = array_merge($pmResult['messages'] ?? [], $subResult['messages'] ?? []);
                }

                // =========================
                // PAY FLOW (subscription OPTIONAL)
                // =========================
                else {

                    // 1) Subscriptions (optional)
                    Log::channel('billing')->info('Payment: creating subscriptions (optional)', $ctx);
                    $subscriptionResult = $billingService->processSubscriptions($pending, $paymentMeta);

                    $subOk   = (bool)($subscriptionResult['success'] ?? false);
                    $subMsgs = is_array($subscriptionResult['messages'] ?? null) ? $subscriptionResult['messages'] : [];

                    // Если просто нет подписки в корзине — это НЕ ошибка
                    $noSubPayload = (!$subOk && in_array('No subscription payloads found in pending context.', $subMsgs, true));

                    // Любая другая ошибка подписок — это ошибка и должна откатывать транзакцию
                    if (!$subOk && !$noSubPayload) {
                        Log::channel('billing')->error('Payment: subscriptions failed', $ctx + ['errors' => $subMsgs]);
                        throw new \RuntimeException('Subscriptions failed.');
                    }

                    // 2) Packages / Reports (optional, но если есть payload — должны обработаться)
                    Log::channel('billing')->info('Payment: creating packages/reports (optional)', $ctx);
                    $packageResult = $billingService->processReportPackage($pending, $paymentMeta);

                    $pkgOk   = (bool)($packageResult['success'] ?? false);
                    $pkgMsgs = is_array($packageResult['messages'] ?? null) ? $packageResult['messages'] : [];

                    // Аналогично: если нет package/report payload — это НЕ ошибка
                    $noPkgPayload = (!$pkgOk && in_array('No report package payload found in pending context.', $pkgMsgs, true));

                    if (!$pkgOk && !$noPkgPayload) {
                        Log::channel('billing')->error('Payment: packages/reports failed', $ctx + ['errors' => $pkgMsgs]);
                        throw new \RuntimeException('Packages/reports failed.');
                    }

                    // 3) Safety: нельзя допускать ситуацию "оплата пришла, но корзина пустая"
                    // Т.е. если ни подписки, ни пакета/отчета не было — это ошибка.
                    if ($noSubPayload && $noPkgPayload) {
                        Log::channel('billing')->error('Payment: nothing to process (empty pending context)', $ctx);
                        throw new \RuntimeException('Nothing to process.');
                    }

                    $messagesOut = array_merge(
                        $noSubPayload ? [] : $subMsgs,
                        $noPkgPayload ? [] : $pkgMsgs
                    );
                }

                // ✅ STEP 6: mark pending order as processed atomically with writes
                if ($referenceNumber !== '') {
                    DB::table('pending_orders')
                        ->where('reference_number', $referenceNumber)
                        ->update([
                            'status' => 'processed',
                            'processed_at' => now(),
                            'last_error' => null,
                            'updated_at' => now(),
                        ]);
                } else {
                    Log::channel('billing')->warning('Billing finalize: reference_number missing; pending_orders not updated', $ctx);
                }

                Log::channel('billing')->info('Billing finalize: commit', $ctx);

                return ['success' => true, 'messagesOut' => $messagesOut];
            });

            return view('thank-you', [
                'messages' => $result['messagesOut'],
                'data' => $dataForView,
            ]);

        } catch (Throwable $e) {

            // ✅ STEP 6: mark pending order failed OUTSIDE transaction
            if ($referenceNumber !== '') {
                try {
                    DB::table('pending_orders')
                        ->where('reference_number', $referenceNumber)
                        ->update([
                            'status' => 'failed',
                            'processed_at' => now(),
                            'last_error' => mb_substr($e->getMessage(), 0, 2000),
                            'updated_at' => now(),
                        ]);
                } catch (Throwable $inner) {
                    Log::channel('checkout_error')->error('Pending order status update failed', $ctx + [
                        'inner_exception' => get_class($inner),
                        'inner_message' => $inner->getMessage(),
                    ]);
                }
            }

            Log::channel('checkout_error')->error('Billing finalize: rollback', $ctx + [
                'exception' => get_class($e),
                'message' => $e->getMessage(),
            ]);

            return view('cancelled', [
                'errorsOut' => ['Billing failed. Please contact support.'],
                'data' => $dataForView,
            ]);
        }
    }


    private function formatResultData(Request $request): array
    {
        $forename = (string) $request->get('req_bill_to_forename');
        $surname  = (string) $request->get('req_bill_to_surname');
        $name = trim($forename . ' ' . $surname);

        $city = (string) $request->get('req_bill_to_address_city');
        $state = (string) ($request->get('req_bill_to_address_state') ?: $request->get('score_ip_state'));
        $zip = (string) $request->get('req_bill_to_address_postal_code');

        $reasonCode = (string) $request->get('reason_code');
        $decisionMsg = (string) $request->get('decision_rmsg');
        $message = (string) $request->get('message');

        $statusMessage = trim(implode(' — ', array_filter([
        $reasonCode ? "Reason code: {$reasonCode}" : null,
        $decisionMsg ?: null,
        $message ?: null,
        ])));

        $decision = (string) $request->get('decision');

        // ✅ decline_reason только если не ACCEPT
        $declineReason = ($decision === 'ACCEPT') ? '' : $statusMessage;


        return [
            'decision' => (string) $request->get('decision'),
            'amount' => (string) ($request->get('auth_amount') ?? $request->get('req_amount') ?? ''),
            'currency' => (string) ($request->get('req_currency') ?? ''),
            'card_type' => (string) ($request->get('card_type_name') ?? ''),
            'card_last4' => (string) ($request->get('req_card_number') ?? ''),
            'name' => $name,
            'location' => trim($city . ($state ? ", {$state}" : '') . ($zip ? " {$zip}" : '')),
            'order_number' => (string) ($request->get('req_reference_number') ?? ''),
            'transaction_id' => (string) ($request->get('transaction_id') ?? ''),
            'auth_code' => (string) ($request->get('auth_code') ?? ''),
            'auth_time' => (string) ($request->get('auth_time') ?? $request->get('signed_date_time') ?? ''),
            'status_message' => $statusMessage,
            'decline_reason' => $declineReason,
        ];
    }

    private function luhnCheck(string $number): bool
    {
        $sum = 0;
        $alt = false;

        for ($i = strlen($number) - 1; $i >= 0; $i--) {
            $n = (int) $number[$i];
            if ($alt) {
                $n *= 2;
                if ($n > 9) $n -= 9;
            }
            $sum += $n;
            $alt = !$alt;
        }
        return ($sum % 10) === 0;
    }

    private function usStateToCode(string $state): ?string
    {
        $state = trim($state);
        if ($state === '') return null;

        $map = [
            'ALABAMA' => 'AL','ALASKA' => 'AK','ARIZONA' => 'AZ','ARKANSAS' => 'AR','CALIFORNIA' => 'CA',
            'COLORADO' => 'CO','CONNECTICUT' => 'CT','DELAWARE' => 'DE','FLORIDA' => 'FL','GEORGIA' => 'GA',
            'HAWAII' => 'HI','IDAHO' => 'ID','ILLINOIS' => 'IL','INDIANA' => 'IN','IOWA' => 'IA',
            'KANSAS' => 'KS','KENTUCKY' => 'KY','LOUISIANA' => 'LA','MAINE' => 'ME','MARYLAND' => 'MD',
            'MASSACHUSETTS' => 'MA','MICHIGAN' => 'MI','MINNESOTA' => 'MN','MISSISSIPPI' => 'MS','MISSOURI' => 'MO',
            'MONTANA' => 'MT','NEBRASKA' => 'NE','NEVADA' => 'NV','NEW HAMPSHIRE' => 'NH','NEW JERSEY' => 'NJ',
            'NEW MEXICO' => 'NM','NEW YORK' => 'NY','NORTH CAROLINA' => 'NC','NORTH DAKOTA' => 'ND','OHIO' => 'OH',
            'OKLAHOMA' => 'OK','OREGON' => 'OR','PENNSYLVANIA' => 'PA','RHODE ISLAND' => 'RI','SOUTH CAROLINA' => 'SC',
            'SOUTH DAKOTA' => 'SD','TENNESSEE' => 'TN','TEXAS' => 'TX','UTAH' => 'UT','VERMONT' => 'VT',
            'VIRGINIA' => 'VA','WASHINGTON' => 'WA','WEST VIRGINIA' => 'WV','WISCONSIN' => 'WI','WYOMING' => 'WY',
            'DISTRICT OF COLUMBIA' => 'DC',
        ];

        $upper = strtoupper($state);

        if (preg_match('/^[A-Z]{2}$/', $upper)) {
            return array_search($upper, $map, true) !== false || $upper === 'DC' ? $upper : null;
        }

        return $map[$upper] ?? null;
    }

    private function verifySecureAcceptanceResponse(array $payload): bool
    {
        $secretKey = (string) env('SECURE_ACCEPTANCE_SECRET_KEY');
        $signedNames = (string) ($payload['signed_field_names'] ?? '');
        $incomingSig = (string) ($payload['signature'] ?? '');

        if ($secretKey === '' || $signedNames === '' || $incomingSig === '') {
            return false;
        }

        $signed = explode(',', $signedNames);

        $dataToSign = collect($signed)
            ->map(function ($name) use ($payload) {
                return $name . '=' . ($payload[$name] ?? '');
            })
            ->implode(',');

        $computed = base64_encode(hash_hmac('sha256', $dataToSign, $secretKey, true));

        return hash_equals($computed, $incomingSig);
    }

    public function removeItem(Request $request)
    {
        $itemKey = $request->input('item_key');

        if (empty($itemKey)) {
            return response()->json([
                'success' => false,
                'error' => 'Missing item key'
            ], 400);
        }

        if (!Session::has($itemKey)) {
            return response()->json([
                'success' => false,
                'error' => 'Item not found in session'
            ], 404);
        }

        Session::forget($itemKey);

        return response()->json([
            'success' => true,
            'message' => 'Item removed successfully'
        ]);
    }

    public function thankYou(Request $request)
    {
        return view('thank-you', [
            'data' => $this->formatResultData($request),
            'messages' => [],
        ]);
    }

    public function cancelled(Request $request)
    {
        Log::channel('checkout')->info("🔔 /cancelled — Method: " . $request->method());
        Log::channel('checkout')->info("🔔 /cancelled — Payload:", $request->all());

        return view('cancelled', [
            'data' => $this->formatResultData($request),
            'errorsOut' => ['Payment was not approved.'],
        ]);
    }

    private function buildTokenCreateFields(array $order, array $validated, string $email, string $stateCode): array
    {
        $fields = [
            'access_key'       => env('SECURE_ACCEPTANCE_ACCESS_KEY'),
            'profile_id'       => env('SECURE_ACCEPTANCE_PROFILE_ID'),
            'transaction_uuid' => (string) Str::uuid(),
            'signed_date_time' => gmdate("Y-m-d\\TH:i:s\\Z"),
            'locale'           => 'en',

            'transaction_type' => 'create_payment_token',
            'payment_method'   => 'card',

            // 'amount'   => '0.00',
            'currency' => 'USD',

            'reference_number' => (string) $order['reference_number'],

            'override_custom_receipt_page' => url('/payment/result'),
            'override_custom_cancel_page'  => url('/cancelled'),

            'merchant_defined_data1' => (string) ($order['intent'] ?? 'trial'),
            'merchant_defined_data2' => (string) ($order['user_id'] ?? ''),

            'bill_to_forename'            => (string) $validated['name'],
            'bill_to_surname'             => (string) $validated['surname'],
            'bill_to_email'               => (string) $email,
            'bill_to_address_line1'       => (string) $validated['address1'],
            'bill_to_address_line2'       => (string) ($validated['address2'] ?? ''),
            'bill_to_address_city'        => (string) $validated['city'],
            'bill_to_address_state'       => (string) $stateCode,
            'bill_to_address_country'     => 'US',
            'bill_to_address_postal_code' => (string) $validated['zip'],

            'card_type' => (string) ($validated['card_type'] ?? '001'),
        ];

        $fields['unsigned_field_names'] = 'card_number,card_expiry_date,card_cvn';

        $fields['signed_field_names'] = implode(',', [
            'access_key',
            'profile_id',
            'transaction_uuid',
            'signed_date_time',
            'locale',
            'transaction_type',
            'payment_method',
            'reference_number',
            // 'amount',
            'currency',
            'override_custom_receipt_page',
            'override_custom_cancel_page',
            'merchant_defined_data1',
            'merchant_defined_data2',
            'bill_to_forename',
            'bill_to_surname',
            'bill_to_email',
            'bill_to_address_line1',
            'bill_to_address_line2',
            'bill_to_address_city',
            'bill_to_address_state',
            'bill_to_address_country',
            'bill_to_address_postal_code',
            'card_type',
            'signed_field_names',
            'unsigned_field_names',
        ]);

        return $fields;
    }
}
