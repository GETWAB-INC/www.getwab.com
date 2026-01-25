<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use App\Http\Middleware\FpdsAccess; // 👈 ДОБАВИЛИ

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {

        // === ALIAS'Ы MIDDLEWARE ===
        $middleware->alias([
            'auth'        => Authenticate::class,
            'fpds.access' => FpdsAccess::class, // 👈 ВОТ ОН
        ]);

        // === CSRF исключения ===
        $middleware->validateCsrfTokens(except: [
            '/checkout/callback',
            '/payment/result',
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
