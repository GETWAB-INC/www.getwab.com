<?php

return [
    // Feature flag
    'enabled' => env('BOA_SA_ENABLED', false),

    // prod|test
    'env' => env('BOA_SA_ENV', 'prod'),

    // live|stub (stub = не делаем POST в BoA, только отладка)
    'mode' => env('BOA_SA_MODE', 'live'),

    // Credentials (ты уже используешь эти ключи)
    'profile_id' => env('SECURE_ACCEPTANCE_PROFILE_ID'),
    'access_key' => env('SECURE_ACCEPTANCE_ACCESS_KEY'),
    'secret_key' => env('SECURE_ACCEPTANCE_SECRET_KEY'),

    // Endpoints (как у тебя в .env)
    'endpoints' => [
        'pay' => env('SECURE_ACCEPTANCE_API_URL'),
        'token_create' => env('SECURE_ACCEPTANCE_SILENT_TOKEN_CREATE'),
        'token_update' => env('SECURE_ACCEPTANCE_SILENT_TOKEN_UPDATE'),
    ],

    // Defaults
    'currency' => env('SECURE_ACCEPTANCE_CURRENCY', 'USD'),
    'locale' => env('SECURE_ACCEPTANCE_LOCALE', 'en'),
];
