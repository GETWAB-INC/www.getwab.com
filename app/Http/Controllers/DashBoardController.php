<?php

namespace App\Http\Controllers;

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

    

}
