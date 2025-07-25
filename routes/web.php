<?php

// -------------------- Static Pages --------------------

// Home page
Route::get('/', function () {
    return view('index');
});

// checkout page
Route::get('checkout', function () {
    return view('checkout');
});
// account page
Route::get('account', function () {
    return view('account');
});

