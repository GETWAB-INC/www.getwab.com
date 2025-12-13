<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    public function account(Request $request)
    {
        $user = Auth::user();

        return view('account', compact('user'));
    }

    public function accountProcess(Request $request)
    {
        dd($request->all());
    }
}
