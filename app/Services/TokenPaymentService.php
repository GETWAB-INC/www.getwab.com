<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class TokenPaymentService
{
    /**
     * Returns normalized result:
     * [
     *   'decision' => 'ACCEPT'|'DECLINE'|'ERROR',
     *   'transaction_id' => string|null,
     *   'reason' => string|null,
     *   'status' => int|null,
     *   'raw_payload' => string|null,
     *   'parsed_payload' => array|null,
     *   'request' => array (sanitized),
     * ]
     */
    public function chargeByToken(array $payload): array
    {
        $url = rtrim((string)env('REST_API_URL', ''), '/');
        $merchantId = (string)env('MERCHANT_ID', '');
        $keyId = (string)env('REST_API_SHARED_KEY', '');
        $secretB64 = (string)env('REST_API_SHARED_SECRET', '');

        if ($url === '' || $merchantId === '' || $keyId === '' || $secretB64 === '') {
            return $this->normalizedError('Missing REST API env (REST_API_URL/MERCHANT_ID/REST_API_SHARED_KEY/REST_API_SHARED_SECRET)');
        }

        $host = (string)parse_url($url, PHP_URL_HOST);
        $path = (string)(parse_url($url, PHP_URL_PATH) ?: '/pts/v2/payments');

        $paymentInstrumentId = (string)($payload['payment_instrument_id'] ?? '');
        $amount = (string)($payload['amount'] ?? '');
        $currency = (string)($payload['currency'] ?? 'USD');
        $reference = (string)($payload['reference'] ?? '');
        $commerceIndicator = (string)($payload['commerce_indicator'] ?? 'recurring');

        if ($paymentInstrumentId === '' || $amount === '' || $reference === '') {
            return $this->normalizedError('Missing payment_instrument_id / amount / reference');
        }

        $body = [
            'clientReferenceInformation' => ['code' => $reference],
            'processingInformation' => ['commerceIndicator' => $commerceIndicator],
            'orderInformation' => [
                'amountDetails' => [
                    'totalAmount' => $amount,
                    'currency' => $currency,
                ],
            ],
            'paymentInformation' => [
                'paymentInstrument' => ['id' => $paymentInstrumentId],
            ],
        ];

        $json = json_encode($body, JSON_UNESCAPED_SLASHES);
        if ($json === false) {
            return $this->normalizedError('Failed to json_encode request body');
        }

        $vDate = gmdate('D, d M Y H:i:s') . ' GMT';
        $digest = 'SHA-256=' . base64_encode(hash('sha256', $json, true));
        $requestTarget = 'post ' . $path;

        $signatureString =
            "host: {$host}\n" .
            "digest: {$digest}\n" .
            "v-c-date: {$vDate}\n" .
            "request-target: {$requestTarget}\n" .
            "v-c-merchant-id: {$merchantId}";

        $secret = base64_decode($secretB64, true);
        if ($secret === false) {
            return $this->normalizedError('REST_API_SHARED_SECRET is not valid base64');
        }

        $sig = base64_encode(hash_hmac('sha256', $signatureString, $secret, true));

        $signatureHeader =
            'keyid="' . $keyId . '", ' .
            'algorithm="HmacSHA256", ' .
            'headers="host digest v-c-date request-target v-c-merchant-id", ' .
            'signature="' . $sig . '"';

        $logCtx = [
            'reference' => $reference,
            'amount' => $amount,
            'currency' => $currency,
            'commerce_indicator' => $commerceIndicator,
            'payment_instrument_id_last8' => substr($paymentInstrumentId, -8),
            'url' => $url,
            'path' => $path,
            'host' => $host,
        ];

        Log::channel('boa_token')->info('chargeByToken: request', $logCtx);

        try {
            $resp = Http::timeout(30)
                ->withHeaders([
                    'Content-Type' => 'application/json',
                    'Host' => $host,
                    'v-c-date' => $vDate,
                    'v-c-merchant-id' => $merchantId,
                    'Digest' => $digest,
                    'Signature' => $signatureHeader,
                ])
                ->withBody($json, 'application/json')
                ->post($url);
        } catch (\Throwable $e) {
            Log::channel('boa_token')->error('chargeByToken: http exception', $logCtx + ['error' => $e->getMessage()]);
            return $this->normalizedError('HTTP request failed: ' . $e->getMessage());
        }

        $status = $resp->status();
        $raw = $resp->body();
        $parsed = $resp->json();

        // Debug raw отдельно (может быть большой)
        Log::channel('boa_token_http')->debug('chargeByToken: response', [
            'reference' => $reference,
            'status' => $status,
            'raw' => $raw,
        ]);

        // Нормализация
        $decision = null;
        $reason = null;
        $txId = null;

        if (is_array($parsed)) {
            $decision = strtoupper((string)($parsed['status'] ?? $parsed['decision'] ?? ''));
            // У CyberSource чаще status = "AUTHORIZED"/"DECLINED"/etc. Приведем:
            if ($decision === 'AUTHORIZED' || $decision === 'AUTHORIZED_PENDING_REVIEW' || $decision === 'SUCCEEDED') {
                $decision = 'ACCEPT';
            } elseif ($decision === 'DECLINED' || $decision === 'REJECTED') {
                $decision = 'DECLINE';
            } elseif ($decision === '') {
                // бывает, что decision лежит глубже
                $decision = strtoupper((string)($parsed['errorInformation']['reason'] ?? ''));
            }

            $txId = (string)($parsed['id'] ?? $parsed['transactionId'] ?? '');
            $reason = (string)(
                $parsed['errorInformation']['message']
                ?? $parsed['errorInformation']['reason']
                ?? $parsed['status']
                ?? ''
            );
        }

        // HTTP 2xx но нет понятного статуса — считаем error, чтобы не продлевать подписку
        if ($resp->successful()) {
            if ($decision !== 'ACCEPT' && $decision !== 'DECLINE') {
                $decision = 'ERROR';
                $reason = $reason ?: 'Successful HTTP but unknown gateway decision';
            }
        } else {
            $decision = 'ERROR';
            $reason = $reason ?: ('HTTP ' . $status);
        }

        $out = [
            'decision' => $decision,
            'transaction_id' => $txId !== '' ? $txId : null,
            'reason' => $reason !== '' ? $reason : null,
            'status' => $status,
            'raw_payload' => $raw,
            'parsed_payload' => is_array($parsed) ? $parsed : null,
            'request' => [
                'reference' => $reference,
                'amount' => $amount,
                'currency' => $currency,
                'commerce_indicator' => $commerceIndicator,
                'payment_instrument_id_last8' => substr($paymentInstrumentId, -8),
            ],
        ];

        Log::channel('boa_token')->info('chargeByToken: normalized', [
            'reference' => $reference,
            'decision' => $decision,
            'transaction_id' => $out['transaction_id'],
            'reason' => $out['reason'],
            'status' => $status,
        ]);

        return $out;
    }

    private function normalizedError(string $msg): array
    {
        return [
            'decision' => 'ERROR',
            'transaction_id' => null,
            'reason' => $msg,
            'status' => null,
            'raw_payload' => null,
            'parsed_payload' => null,
            'request' => null,
        ];
    }
}
