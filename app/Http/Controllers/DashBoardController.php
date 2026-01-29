<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Subscription;


class DashBoardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $subscription = Subscription::where('user_id', $user->id)
        ->where('subscription_type', 'fpds_query')
        ->orderByDesc('created_at')
        ->first();

        return view('dashboard', [
            'subscription' => $subscription,
        ]);
    }

    public function adminer()
    {
        $user = auth()->user();

        if (!$user || $user->email !== "ilia.oborin@getwab.com") {
            abort(404);
        }

        $path = storage_path('adminer/adminer.php');

        if (!is_file($path) || !is_readable($path)) {
            abort(404, 'Adminer not found');
        }

        return response()->stream(function () use ($path) {
            require $path;
        }, 200, [
            'Content-Type' => 'text/html; charset=UTF-8',
            'X-Frame-Options' => 'SAMEORIGIN',
            'X-Content-Type-Options' => 'nosniff',
        ]);
    }

}
