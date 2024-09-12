<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::get('about.html', function () {
    return view('about');
});

Route::get('services.html', function () {
    return view('services');
});

Route::get('contact.html', function () {
    return view('contact');
});

Route::get('privacy-policy.html', function () {
    return view('privacy-policy');
});

Route::get('cookie-policy.html', function () {
    return view('cookie-policy');
});

Route::get('terms-of-use.html', function () {
    return view('terms-of-use');
});
