<?php

use Illuminate\Support\Facades\Route;

// -------------------- Static Pages --------------------

// Home page
Route::get('/', function () {
    return view('index');
});

// login page
Route::get('checkout', function () {
    return view('checkout');
});
