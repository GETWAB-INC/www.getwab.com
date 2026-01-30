<?php

namespace App\Http\Controllers;

class MainController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function mail()
    {
        $user = (object) [
            'id'   => 123,
            'name' => 'John Doe',
        ];

        $token = 'fake-verification-token-123456';

        return view('emails.verify-email', compact('user', 'token'));
    }
}
