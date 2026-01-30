<?php

namespace App\Http\Controllers;

class MainController extends Controller
{
    public function index()
    {
        return view('index-old');
    }

    public function about()
    {
        return view('about');
    }

    public function services()
    {
        return view('services');
    }

    public function privacyPolicy()
    {
        return view('privacy-policy-old');
    }

    public function cookiePolicy()
    {
        return view('cookie-policy');
    }

    public function termsOfUse()
    {
        return view('terms-of-use');
    }

    public function article()
    {
        return view('article');
    }

    public function mail()
    {
        $user = (object) [
            'id'   => 123,
            'name' => 'John Doe',
            
        ];

        $token = 'fake-verification-token-123456';
        $url = 'https://www.getwab.com/';

        return view('emails.reset-password', compact('user', 'token', 'url'));
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
