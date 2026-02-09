<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use App\Services\BillingService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{

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

    public function showCheckout()
    {
        $accessKey = env('SECURE_ACCEPTANCE_ACCESS_KEY');
        $profileId = env('SECURE_ACCEPTANCE_PROFILE_ID');
        $secretKey = env('SECURE_ACCEPTANCE_SECRET_KEY');
        $apiUrl = env('SECURE_ACCEPTANCE_API_URL');

        return view('checkout.form', [
            'access_key' => $accessKey,
            'profile_id' => $profileId,
            'secret_key' => $secretKey,
            'apiUrl' => $apiUrl,
        ]);
    }

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

    // public function paymentResult(Request $request)
    // {
    //     // Log payment result endpoint call
    //     Log::channel('checkout')->info("🔔 /payment/result — Method: " . $request->method());
    //     Log::channel('checkout')->info('🔔 /payment/result — Payload:', $request->all());

    //     $data = [
    //         'status' => $request->get('decision'),
    //         'amount' => $request->get('auth_amount'),
    //         'currency' => $request->get('req_currency'),
    //         'card_type' => $request->get('card_type_name'),
    //         'name' => trim($request->get('req_bill_to_forename') . ' ' . $request->get('req_bill_to_surname')),
    //         'city' => $request->get('req_bill_to_address_city'),
    //         'state' => $request->get('req_bill_to_address_state'),
    //         'zip' => $request->get('req_bill_to_address_postal_code'),
    //         'transaction_id' => $request->get('transaction_id'),
    //         'order_number' => $request->get('req_reference_number'),
    //         'auth_code' => $request->get('auth_code'),
    //         'auth_time' => $request->get('auth_time'),
    //     ];

    //     return view('checkout.result', compact('data'));
    // }

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

    /**
     * 1) Принимаем данные с твоей дизайнерской формы
     * 2) Проверяем корзину (server-truth)
     * 3) Валидируем billing (+ card если нужно платить)
     * 4) Для guest — создаём/логиним пользователя
     * 5) Если $total == 0: сразу запускаем BillingService (free trial)
     * 6) Если $total > 0: готовим Secure Acceptance fields + signature и отдаём checkout_post.blade.php
     */
    public function prepare(Request $request)
    {
        // ----------------------------
        // A) Cart truth
        // ----------------------------
        [$itemsPresent, $total] = $this->calculateCartTotalFromSession();
        if (empty($itemsPresent)) {
            return back()
                ->withErrors(['cart' => 'No items in your cart. Please add products before proceeding.'])
                ->withInput();
        }

        $requiresPayment = ((float)$total) > 0.0;

        // ----------------------------
        // B) Normalize inputs (card + billing)
        // ----------------------------
        $this->normalizeRequest($request);

        // ----------------------------
        // C) Validate (billing always, card only if requiresPayment)
        // ----------------------------
        [$validated, $stateCode] = $this->validateCheckout($request, $requiresPayment);
        if ($stateCode === null) {
            return back()->withErrors(['bill_state' => 'Invalid US state.'])->withInput();
        }

        // ----------------------------
        // D) Ensure user (guest register/login)
        // ----------------------------
        $email = $this->ensureUserAndGetEmail($validated);

        // ----------------------------
        // E) FREE FLOW: total == 0 => без шлюза, можно сразу биллинг
        // ----------------------------
        if (!$requiresPayment) {
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
            // STUB mode: не ходим в BoA, как будто платёж прошёл
            // Важно: для реала держи live и убери это из прода.
            return $this->finalizeBillingAndRespond([
                'type' => 'stub',
                'total' => number_format((float)$total, 2, '.', ''),
            ]);
        }

        // Создаём контекст "ожидаем оплату"
        $order = $this->createPendingOrderContext($itemsPresent, $total, $email, $validated, $stateCode);

        // Собираем поля + подпись для pay
        $apiUrl = env('SECURE_ACCEPTANCE_API_URL');
        $fields = $this->buildPayFields($order, $validated, $email, $stateCode);
        $signature = $this->signSecureAcceptance($fields, env('SECURE_ACCEPTANCE_SECRET_KEY'));

        // Отдаём прокладку, которая POST'ит в BoA
        return view('checkout_post', [
            'apiUrl' => $apiUrl,
            'fields' => $fields,
            'signature' => $signature,

            // UNSIGNED поля карты — добавятся hidden в форме
            'card_number' => (string) $validated['card_number'],
            'card_expiry_date' => (string) $validated['card_expiry_date'],
            'card_cvn' => (string) $validated['card_cvn'],
        ]);
    }

    /**
     * Callback/Return URL от BoA (silent post).
     * Здесь и только здесь запускаем BillingService для paid.
     */
    public function paymentResult(Request $request)
    {
        Log::channel('checkout')->info("🔔 /payment/result — Method: " . $request->method());
        Log::channel('checkout')->info('🔔 /payment/result — Payload:', $request->all());

        // TODO (очень желательно): verify signature от BoA на входящем ответе
        // TODO: verify that req_reference_number matches our pending order

        $decision = (string) $request->get('decision');
        $authResponse = (string) $request->get('auth_response'); // "00" часто = ok
        $referenceNumber = (string) $request->get('req_reference_number');

        $pending = session()->get('pending_payment');

        $isAccepted = ($decision === 'ACCEPT');
        // Некоторые интеграции ориентируются на decision=ACCEPT, некоторые также на auth_response=00
        // Я бы проверял оба.
        $isAuthorized = ($authResponse === '' || $authResponse === '00'); // если поле не приходит — не ломаем

        if (!$pending) {
            // Нет контекста — не можем безопасно применять биллинг
            Log::channel('checkout')->warning('No pending_payment in session; cannot finalize billing safely.');
            return view('cancelled')->with('errors', ['Payment context is missing.']);
        }

        if (!hash_equals((string)$pending['reference_number'], $referenceNumber)) {
            Log::channel('checkout')->warning('Reference number mismatch.', [
                'pending' => $pending['reference_number'],
                'incoming' => $referenceNumber,
            ]);
            return view('cancelled')->with('errors', ['Payment reference mismatch.']);
        }

        if (!($isAccepted && $isAuthorized)) {
            // Платёж не прошёл — биллинг НЕ делаем
            $data = $this->formatResultData($request);
            return view('checkout.result', [
                'data' => $data,
            ]);
        }

        // OK: Платёж прошёл — делаем биллинг
        // TODO: сохрани transaction_id, auth_code, token (если есть) в БД (order/payments table)
        $response = $this->finalizeBillingAndRespond([
            'type' => 'boa',
            'total' => (string) ($request->get('auth_amount') ?? $pending['total']),
            'reference_number' => $referenceNumber,
            'transaction_id' => (string) $request->get('transaction_id'),
        ]);

        // очищаем pending контекст
        session()->forget('pending_payment');

        // TODO: очистить корзину (session keys)
        // $this->clearCartSession();

        return $response;
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

    private function normalizeRequest(Request $request): void
    {
        $request->merge([
            'card_number' => preg_replace('/\D+/', '', (string) $request->input('card_number')),
            'card_cvn' => preg_replace('/\D+/', '', (string) $request->input('card_cvn')),
            'bill_country' => strtoupper(trim((string) $request->input('bill_country', 'US'))),
            'bill_state' => trim((string) $request->input('bill_state')),
            'zip' => trim((string) $request->input('zip')),
            'card_expiry_date' => trim((string) $request->input('card_expiry_date')),
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

    // =========================================================
    // Helpers: Secure Acceptance build/sign
    // =========================================================

    private function secureAcceptanceEnabled(): bool
    {
        // простая проверка, чтобы не падать тихо
        return (bool) env('SECURE_ACCEPTANCE_ACCESS_KEY')
            && (bool) env('SECURE_ACCEPTANCE_PROFILE_ID')
            && (bool) env('SECURE_ACCEPTANCE_SECRET_KEY')
            && (bool) env('SECURE_ACCEPTANCE_API_URL');
    }

    private function isStubMode(): bool
    {
        return env('BOA_SA_MODE', 'live') === 'stub';
    }

    /**
     * Pending order context хранится в сессии — минимально, без БД.
     * TODO: заменить на Order/Payment таблицы (recommended).
     */
    private function createPendingOrderContext(array $itemsPresent, string $total, string $email, array $validated, string $stateCode): array
    {
        $referenceNumber = 'ORDER-' . now()->format('YmdHis') . '-' . Str::random(6);

        $pending = [
            'reference_number' => $referenceNumber,
            'items' => $itemsPresent,
            'total' => $total,
            'email' => $email,

            // можно сохранить минимум billing, если надо
            'bill_to_forename' => (string) $validated['name'],
            'bill_to_surname' => (string) $validated['surname'],
            'bill_to_city' => (string) $validated['city'],
            'bill_to_state' => (string) $stateCode,
            'bill_to_zip' => (string) $validated['zip'],
        ];

        session()->put('pending_payment', $pending);

        return $pending;
    }

    /**
     * Build fields for /silent/pay
     * card fields НЕ включаем в $fields (они unsigned и пойдут отдельными hidden input)
     */
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

            // Billing
            'bill_to_forename'            => (string) $validated['name'],
            'bill_to_surname'             => (string) $validated['surname'],
            'bill_to_email'               => (string) $email,
            'bill_to_address_line1'       => (string) $validated['address1'],
            'bill_to_address_line2'       => (string) ($validated['address2'] ?? ''),
            'bill_to_address_city'        => (string) $validated['city'],
            'bill_to_address_postal_code' => (string) $validated['zip'],
            'bill_to_address_state'       => (string) $stateCode,
            'bill_to_address_country'     => (string) $validated['bill_country'],
        ];

        // UNSIGNED: card fields
        $fields['unsigned_field_names'] = 'card_number,card_expiry_date,card_cvn';

        // SIGNED: список должен включать self-references signed_field_names/unsigned_field_names
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
            'bill_to_forename',
            'bill_to_surname',
            'bill_to_email',
            'bill_to_address_line1',
            'bill_to_address_line2',
            'bill_to_address_city',
            'bill_to_address_postal_code',
            'bill_to_address_state',
            'bill_to_address_country',
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

    // =========================================================
    // Helpers: Billing finalization
    // =========================================================

    private function finalizeBillingAndRespond(array $paymentMeta)
    {
        $billingService = new BillingService();

        $subscriptionResult = $billingService->processSubscriptions();
        $packageResult = $billingService->processReportPackage();

        $success = $subscriptionResult['success'] && $packageResult['success'];
        $messagesOut = array_merge($subscriptionResult['messages'], $packageResult['messages']);

        if ($success) {
            return view('thank-you')->with('messages', $messagesOut);
        }

        return view('cancelled')->with('errors', $messagesOut);
    }

    private function formatResultData(Request $request): array
    {
        return [
            'status' => $request->get('decision'),
            'amount' => $request->get('auth_amount'),
            'currency' => $request->get('req_currency'),
            'card_type' => $request->get('card_type_name'),
            'name' => trim($request->get('req_bill_to_forename') . ' ' . $request->get('req_bill_to_surname')),
            'city' => $request->get('req_bill_to_address_city'),
            'state' => $request->get('req_bill_to_address_state'),
            'zip' => $request->get('req_bill_to_address_postal_code'),
            'transaction_id' => $request->get('transaction_id'),
            'order_number' => $request->get('req_reference_number'),
            'auth_code' => $request->get('auth_code'),
            'auth_time' => $request->get('auth_time'),
        ];
    }

    // =========================================================
    // Existing helpers (твои)
    // =========================================================

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


    /**
     * Remove an item from the session by its key
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function removeItem(Request $request)
    {
        // Get item key from request
        $itemKey = $request->input('item_key');

        // Validate that item key is provided
        if (empty($itemKey)) {
            return response()->json([
                'success' => false,
                'error' => 'Missing item key'
            ], 400);
        }

        // Check if the item exists in the session
        if (!Session::has($itemKey)) {
            return response()->json([
                'success' => false,
                'error' => 'Item not found in session'
            ], 404);
        }

        // Remove item from session
        Session::forget($itemKey);

        // Return success response
        return response()->json([
            'success' => true,
            'message' => 'Item removed successfully'
        ]);
    }

    public function process(Request $request)
    {
        $hasItemsInCart = false;

        // List of supported cart item session keys
        $cartItems = [
            'fpds_query_trial',
            'fpds_query_subscription',
            'fpds_report_subscription',
            'single_elementary_report',
            'single_composite_report',
            'elementary_report_package',
            'composite_report_package'
        ];

        // Check if at least one item exists in the cart
        foreach ($cartItems as $itemKey) {
            if (session()->has($itemKey)) {
                $hasItemsInCart = true;
                break;
            }
        }

        // Stop checkout if cart is empty
        if (!$hasItemsInCart) {
            return back()
                ->withErrors(['cart' => 'No items in your cart. Please add products before proceeding.'])
                ->withInput();
        }

        if (Auth::check()) {
            // Authenticated user: validate required billing fields only (no password/email)
            $validated = $request->validate([
                'name' => [
                    'required',
                    'string',
                    'max:255',
                    'regex:/^[\pL\s\-]+$/u',
                ],
                'surname' => [
                    'required',
                    'string',
                    'max:255',
                    'regex:/^[\pL\s\-]*$/u',
                ],
                'city' => [
                    'required',
                    'nullable',
                    'string',
                    'max:255',
                ],
                'address1' => [
                    'required',
                    'nullable',
                    'string',
                    'max:255',
                ],
                'address2' => [
                    'nullable',
                    'string',
                    'max:255',
                ],
                'zip' => [
                    'required',
                    'nullable',
                    'string',
                    'max:20',
                ],
            ], [
                'name.required' => 'First name is required.',
                'name.regex' => 'First name may only contain letters, spaces, and hyphens.',
                'surname.required' => 'Last name is required.',
                'surname.regex' => 'Last name may only contain letters, spaces, and hyphens.',
            ]);
        } else {
            // Guest user: full validation including email and password
            $validated = $request->validate([
                'name' => [
                    'required',
                    'string',
                    'max:255',
                    'regex:/^[\pL\s\-]+$/u',
                ],
                'surname' => [
                    'required',
                    'string',
                    'max:255',
                    'regex:/^[\pL\s\-]*$/u',
                ],
                'email' => [
                    'required',
                    'string',
                    'email',
                    'max:255',
                    'unique:users,email',
                ],
                'confirm_email' => [
                    'required',
                    'email',
                    'same:email',
                ],
                'password' => [
                    'required',
                    'string',
                    'min:8',
                    'confirmed',
                    'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/',
                ],
                'password_confirmation' => [
                    'required',
                ],
                'city' => [
                    'required',
                    'nullable',
                    'string',
                    'max:255',
                ],
                'address1' => [
                    'required',
                    'nullable',
                    'string',
                    'max:255',
                ],
                'address2' => [
                    'nullable',
                    'string',
                    'max:255',
                ],
                'zip' => [
                    'required',
                    'nullable',
                    'string',
                    'max:20',
                ],
            ], [
                'name.required' => 'First name is required.',
                'name.regex' => 'First name may only contain letters, spaces, and hyphens.',
                'surname.required' => 'Last name is required.',
                'surname.regex' => 'Last name may only contain letters, spaces, and hyphens.',
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
            ]);
        }

        // Determine user email
        $email = Auth::check() ? Auth::user()->email : $validated['email'];

        if (!Auth::check()) {
            // Create or fetch user and log them in
            $user = User::where('email', $email)->first();

            if (!$user) {
                $registerController = new \App\Http\Controllers\RegisterController();
                $user = $registerController->registerThruOrder($validated);
            }

            Auth::login($user, true);
        }

        // Test mode switch (disable for real payment processing)
        $testMode = true;

        if (!$testMode) {
            // Real payment gateway integration will be implemented here
            $paymentSuccessful = false; // Placeholder
        } else {
            $paymentSuccessful = true;
        }

        if ($paymentSuccessful) {
            $billingService = new BillingService();

            // 1. Process subscriptions
            $subscriptionResult = $billingService->processSubscriptions();

            // 2. Process report packages
            $packageResult = $billingService->processReportPackage();

            // 3. Combine results
            $success = $subscriptionResult['success'] && $packageResult['success'];
            $messages = array_merge($subscriptionResult['messages'], $packageResult['messages']);

            if ($success) {
                return view('thank-you')->with('messages', $messages);
            } else {
                return view('cancelled')->with('errors', $messages);
            }
        }

        return view('cancelled')->with('errors', ['Payment failed']);
    }

    public function thankYou()
    {
        return view('thank-you');
    }

    public function cancelled()
    {
        return view('cancelled');
    }
}


// 3) TODO список (чтобы дальше довести до “правильно”)
// Подтверждение ответа банка (verify response signature)
// Сейчас ты доверяешь входящему POST. Это нельзя оставлять на проде.
// Сохранение order/payment в БД
// Сессия может потеряться (мобильные/другие браузеры). Надо таблицы:
// orders (reference_number, user_id, status)
// payments (order_id, transaction_id, decision, auth_response, amount)
// Tokenization для trial
// У тебя отдельные endpoints:
// /silent/token/create
// /silent/token/update
// Для “trial + запомнить карту” нужно отдельный builder buildTokenCreateFields() и отдельный return handler, который сохранит token.
// Очистка корзины после успеха
// Сейчас TODO.