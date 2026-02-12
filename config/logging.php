<?php

use Monolog\Handler\NullHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\SyslogUdpHandler;
use Monolog\Processor\PsrLogMessageProcessor;

return [

    /*
    |--------------------------------------------------------------------------
    | Default Log Channel
    |--------------------------------------------------------------------------
    |
    | Default channel used when you call Log::info()/error() without specifying
    | a channel. "stack" is common for combining multiple channels.
    |
    */

    'default' => env('LOG_CHANNEL', 'stack'),

    /*
    |--------------------------------------------------------------------------
    | Deprecations Log Channel
    |--------------------------------------------------------------------------
    */

    'deprecations' => [
        'channel' => env('LOG_DEPRECATIONS_CHANNEL', 'null'),
        'trace'   => env('LOG_DEPRECATIONS_TRACE', false),
    ],

    /*
    |--------------------------------------------------------------------------
    | Log Channels
    |--------------------------------------------------------------------------
    |
    | For billing we want:
    | - separate files by process branch (gateway/webhook/cron/security)
    | - daily rotation
    | - JSON formatting (easy to search and parse)
    | - sane retention (30-60 days)
    |
    */

    'channels' => [

        /*
        |--------------------------------------------------------------------------
        | Legacy / existing checkout logs (kept as-is)
        |--------------------------------------------------------------------------
        */

        'checkout' => [
            'driver' => 'single',
            'path'   => storage_path('logs/checkout.log'),
            'level'  => 'info',
        ],

        'checkout_error' => [
            'driver' => 'single',
            'path'   => storage_path('logs/checkout_error.log'),
            'level'  => 'error',
        ],

        /*
        |--------------------------------------------------------------------------
        | Billing / Payments: structured, branch-separated logs
        |--------------------------------------------------------------------------
        */

        // Main billing lifecycle: subscription activation/renewal/expiry decisions.
        'billing' => [
            'driver'  => 'daily',
            'path'    => storage_path('logs/billing/billing.log'),
            'level'   => env('LOG_LEVEL_BILLING', 'info'),
            'days'    => env('LOG_DAYS_BILLING', 30),
            'replace_placeholders' => true,
        ],

        // Raw-ish gateway interaction logs (requests/responses metadata, masked).
        // Use this to debug provider-specific fields without polluting main billing.log.
        'billing_gateway' => [
            'driver'  => 'daily',
            'path'    => storage_path('logs/billing/gateway.log'),
            'level'   => env('LOG_LEVEL_BILLING_GATEWAY', 'info'),
            'days'    => env('LOG_DAYS_BILLING_GATEWAY', 30),
            'replace_placeholders' => true,
        ],

        // Incoming callbacks/webhooks: always log "received/validated/deduped/processed".
        // This is the first place to look when "user says paid but no subscription".
        'billing_webhook' => [
            'driver'  => 'daily',
            'path'    => storage_path('logs/billing/webhook.log'),
            'level'   => env('LOG_LEVEL_BILLING_WEBHOOK', 'info'),
            'days'    => env('LOG_DAYS_BILLING_WEBHOOK', 30),
            'replace_placeholders' => true,
        ],

        // Scheduled jobs (expire trials, mark subscriptions expired, renewal automation, etc.)
        'billing_cron' => [
            'driver'  => 'daily',
            'path'    => storage_path('logs/billing/cron.log'),
            'level'   => env('LOG_LEVEL_BILLING_CRON', 'info'),
            'days'    => env('LOG_DAYS_BILLING_CRON', 30),
            'replace_placeholders' => true,
        ],

        // Security-sensitive events: invalid signatures, replay attempts, missing required fields, etc.
        // Keep longer retention and higher minimum level.
        'security' => [
            'driver'  => 'daily',
            'path'    => storage_path('logs/security/security.log'),
            'level'   => env('LOG_LEVEL_SECURITY', 'warning'),
            'days'    => env('LOG_DAYS_SECURITY', 60),
            'replace_placeholders' => true,
        ],

        // Optional: high-level business events only (good for quick dashboards/grep).
        // Example: "trial_started", "subscription_activated", "payment_failed".
        'billing_audit' => [
            'driver'  => 'daily',
            'path'    => storage_path('logs/billing/audit.log'),
            'level'   => env('LOG_LEVEL_BILLING_AUDIT', 'info'),
            'days'    => env('LOG_DAYS_BILLING_AUDIT', 60),
            'replace_placeholders' => true,
        ],

        /*
        |--------------------------------------------------------------------------
        | Stack: combine channels for convenience
        |--------------------------------------------------------------------------
        |
        | Tip: Set LOG_CHANNEL=stack and LOG_STACK=billing,billing_webhook,security
        | in .env to get the most useful default behavior.
        |
        */

        'stack' => [
            'driver' => 'stack',
            'channels' => explode(',', env('LOG_STACK', 'single')),
            'ignore_exceptions' => false,
        ],

        /*
        |--------------------------------------------------------------------------
        | Default Laravel channels (unchanged)
        |--------------------------------------------------------------------------
        */

        'single' => [
            'driver' => 'single',
            'path' => storage_path('logs/laravel.log'),
            'level' => env('LOG_LEVEL', 'debug'),
            'replace_placeholders' => true,
        ],

        'daily' => [
            'driver' => 'daily',
            'path' => storage_path('logs/laravel.log'),
            'level' => env('LOG_LEVEL', 'debug'),
            'days' => env('LOG_DAILY_DAYS', 14),
            'replace_placeholders' => true,
        ],

        'slack' => [
            'driver' => 'slack',
            'url' => env('LOG_SLACK_WEBHOOK_URL'),
            'username' => env('LOG_SLACK_USERNAME', 'Laravel Log'),
            'emoji' => env('LOG_SLACK_EMOJI', ':boom:'),
            'level' => env('LOG_LEVEL', 'critical'),
            'replace_placeholders' => true,
        ],

        'papertrail' => [
            'driver' => 'monolog',
            'level' => env('LOG_LEVEL', 'debug'),
            'handler' => env('LOG_PAPERTRAIL_HANDLER', SyslogUdpHandler::class),
            'handler_with' => [
                'host' => env('PAPERTRAIL_URL'),
                'port' => env('PAPERTRAIL_PORT'),
                'connectionString' => 'tls://'.env('PAPERTRAIL_URL').':'.env('PAPERTRAIL_PORT'),
            ],
            'processors' => [PsrLogMessageProcessor::class],
        ],

        'stderr' => [
            'driver' => 'monolog',
            'level' => env('LOG_LEVEL', 'debug'),
            'handler' => StreamHandler::class,
            'formatter' => env('LOG_STDERR_FORMATTER'),
            'with' => [
                'stream' => 'php://stderr',
            ],
            'processors' => [PsrLogMessageProcessor::class],
        ],

        'syslog' => [
            'driver' => 'syslog',
            'level' => env('LOG_LEVEL', 'debug'),
            'facility' => env('LOG_SYSLOG_FACILITY', LOG_USER),
            'replace_placeholders' => true,
        ],

        'errorlog' => [
            'driver' => 'errorlog',
            'level' => env('LOG_LEVEL', 'debug'),
            'replace_placeholders' => true,
        ],

        'null' => [
            'driver' => 'monolog',
            'handler' => NullHandler::class,
        ],

        'emergency' => [
            'path' => storage_path('logs/laravel.log'),
        ],

    ],

];
