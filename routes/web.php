<?php

// -------------------- Static Pages --------------------

// Home page
Route::get('/', function () {
    return view('index');
});

// login page
Route::get('login', function () {
    return view('login');
});

// register page
Route::get('register', function () {
    return view('register');
});

// article page
Route::get('article', function () {
    return view('article');
});

// checkout page
Route::get('checkout', function () {
    return view('checkout');
});
// account page
Route::get('account', function () {
    return view('account');
});

// account page
Route::get('account', function () {
    return view('account');
});

// thank-you page
Route::get('thank-you', function () {
    return view('thank-you');
});
// cancelled page
Route::get('cancelled', function () {
    return view('cancelled');
});
