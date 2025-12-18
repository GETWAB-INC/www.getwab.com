<?php
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AccountController;
// -------------------- Static Pages --------------------

// Home page
Route::get('/', function () { return view('index'); })->name('/');

// login page
Route::get('/login', function () {
    if (auth()->check()) {
        return redirect()->route('account');
    }
    return view('login');
})->name('login');

// Login Process
Route::post('/login-process', [LoginController::class, 'login'])->name('login-process');
// Logout
Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('login');
})->name('logout');

// register page
Route::get('/register', function () {
    if (auth()->check()) {
        return redirect()->route('account');
    }
    return view('register');
})->name('register');
Route::post('/register-process', [RegisterController::class, 'register'])->name('register-process');


// forgot
Route::get('/forgot', function () { return view('forgot'); })->name('forgot');

// article page
Route::get('/article', function () { return view('article'); })->name('article')->middleware('auth');

// account page
Route::get('/account', [AccountController::class, 'account'])->name('account')->middleware('auth');
Route::post('/account-process', [AccountController::class, 'accountProcess'])->name('account.process');
Route::post('/account/upload-avatar', [AccountController::class, 'uploadAvatar'])->name('upload.avatar');
Route::delete('/account/remove-avatar', [AccountController::class, 'removeAvatar'])->name('remove.avatar');

// contact page
Route::get('/contact-us', function () {return view('contact-us');})->name('contact-us');

// reports page
Route::get('/reports', function () { return view('reports'); })->name('reports');

// reports/SFPR-GEO-EL-1 page
Route::get('/reports/SFPR-GEO-EL-1', function () { return view('reports.SFPR-GEO-EL-1'); })->name('report');

// Products
Route::get('/products/fpds-query', function () { return view('products.fpds-query'); })->name('products.fpds-query');
Route::get('/products/fpds-reports', function () { return view('products.fpds-reports'); })->name('products.fpds-reports');
Route::get('/products/fpds-charts', function () { return view('products.fpds-charts'); });

// Products Overview
Route::get('/products/fpds-query/overview', function () { return view('products.fpds-query-overview'); })->name('products.fpds-query-overview');
Route::get('/products/fpds-reports/overview', function () { return view('products.fpds-reports-overview'); })->name('products.fpds-reports-overview');
Route::get('/products/fpds-charts/overview', function () { return view('products.fpds-charts-overview'); });

// Services
Route::get('/services/consulting-advisory', function () { return view('services.consulting-advisory'); })->name('services.consulting-advisory');
Route::get('/services/custom-analytics', function () { return view('services.custom-analytics'); })->name('services.custom-analytics');
Route::get('/services/data-automation', function () { return view('services.data-automation'); })->name('services.data-automation');
Route::get('/services/gov-contracting', function () { return view('services.gov-contracting'); })->name('services.gov-contracting');

// Terms & Conditions
Route::get('/user-terms-conditions', function () { return view('user-terms-conditions'); })->name('user-terms-conditions');
Route::get('/privacy-policy', function () { return view('privacy-policy'); })->name('privacy-policy');
Route::get('/company', function () { return view('company'); })->name('company');
Route::get('/mission', function () { return view('mission'); })->name('mission');

// checkout page
Route::get('/checkout', function () { return view('checkout'); })->name('checkout')->middleware('auth');
// thank-you page
Route::get('/thank-you', function () { return view('thank-you'); })->middleware('auth');
// cancelled page
Route::get('/cancelled', function () { return view('cancelled'); })->middleware('auth');
