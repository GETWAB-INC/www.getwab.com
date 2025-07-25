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

// checkout page
Route::get('checkout', function () {
    return view('checkout');
});
// account page
Route::get('account', function () {
    return view('account');
});

