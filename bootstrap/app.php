<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Регистрация middleware для аутентификации
        $middleware->alias([
            'auth' => Authenticate::class,
        ]);

        // ❗ CSRF: отключаем проверку для /checkout/callback
        $middleware->validateCsrfTokens(except: [
            '/checkout/callback',
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
