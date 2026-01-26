<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redis;

class FpdsSsoController extends Controller
{
    public function redirect()
    {
        $user = auth()->user();

        $ticket = bin2hex(random_bytes(32));

        Redis::setex("fpds:ticket:$ticket", 600, json_encode([
            'user_id' => $user->id,
            'plan' => 'pro',
            'email' => $user->email,
        ]));

        // куда вернуться после выдачи cookie
        $redirect = '/query';

        return redirect()->away("https://fpds.getwab.com/auth/exchange.php?ticket={$ticket}&redirect={$redirect}");
    }
}
