<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class DashBoardController extends Controller
{
    public function index()
    {
        // Передаём обе переменные в представление
        return view('dashboard');
    }

    public function adminer()
    {
        $user = auth()->user();

        // Только ты + подтверждённый email
        if (
            !$user ||
            $user->email !== 'ilia.oborin@getwab.com' ||
            !$user->email_verified_at
        ) {
            abort(404); // можно 403, но 404 лучше скрывает
        }

        $path = storage_path('app/adminer/adminer.php'); // ВНЕ public

        if (!is_file($path)) {
            abort(404, 'Adminer not found');
        }

        // ВАЖНО: запускаем PHP-файл, а не “скачиваем”
        return response()->stream(function () use ($path) {
            require $path;
        }, 200, [
            'Content-Type' => 'text/html; charset=UTF-8',
            'X-Frame-Options' => 'SAMEORIGIN',
            'X-Content-Type-Options' => 'nosniff',
        ]);
    }
}
