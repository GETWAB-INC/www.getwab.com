<?php
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\LibraryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ReportPackageController;
use App\Http\Controllers\SubscriptionController;

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
Route::get('/tables', [LoginController::class, 'showTables'])->name('showю.tables')->middleware('auth');
Route::post('/login-process', [LoginController::class, 'login'])->name('login-process');
Route::post('/fpds/query', [LoginController::class, 'fpdsQuery'])->name('fpds.query')->middleware('auth');

// forgot
Route::get('/password/reset', [LoginController::class, 'showLinkRequestForm'])->name('forgot');
Route::post('/password/email', [LoginController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/password/reset/{token}', [LoginController::class, 'showResetForm'])->name('password.reset');
Route::post('/password/reset', [LoginController::class, 'reset'])->name('password.update');

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
Route::get('/verify/{user}', [RegisterController::class, 'verify'])->name('verification.verify');
Route::post('/send-message', [RegisterController::class, 'sendMessage'])->name('send.message');

// article page
Route::get('/article', function () { return view('article'); })->name('article');

// account page
Route::get('/account', [AccountController::class, 'account'])->name('account')->middleware('auth');
Route::get('/account/reports', [AccountController::class, 'reports'])->name('account.reports')->middleware('auth');
Route::get('/account/packages', [AccountController::class, 'packages'])->name('account.packages')->middleware('auth');
Route::get('/account/subscription', [AccountController::class, 'subscription'])->name('account.subscription')->middleware('auth');
Route::get('/account/billing', [AccountController::class, 'billing'])->name('account.billing')->middleware('auth');
Route::get('/account/profile', [AccountController::class, 'profile'])->name('account.profile')->middleware('auth');
Route::post('/update-profile', [AccountController::class, 'updateProfile'])->name('update.profile')->middleware('auth');
Route::post('/account/upload-avatar', [AccountController::class, 'uploadAvatar'])->name('upload.avatar')->middleware('auth');
Route::delete('/account/remove-avatar', [AccountController::class, 'removeAvatar'])->name('remove.avatar')->middleware('auth');

Route::post('/order/package', action: [ReportPackageController::class, 'orderPackage'])->name('order.package');
Route::post('/order/subscription', action: [SubscriptionController::class, 'orderSubscription'])->name('order.subscription');
Route::post('/cancel/subscription', action: [SubscriptionController::class, 'cancelSubscription'])->name('cancel.subscription')->middleware('auth');
Route::post('/restore/subscription', action: [SubscriptionController::class, 'restoreSubscription'])->name('restore.subscription')->middleware('auth');
Route::post('/renew/subscription', [SubscriptionController::class, 'renewSubscription'])->name('renew.subscription')->middleware('auth');

// contact page
Route::get('/contact-us', function () {return view('contact-us');})->name('contact-us');

// library
Route::get('/library', [LibraryController::class, 'index'])->name('library');

// library/SFPR-GEO-EL-1 page
Route::get('/library/{report_code}', [LibraryController::class, 'show'])->name('report.show');

// Generate
Route::post('/report/generate', [ReportController::class, 'generate'])->name('report.generate')->middleware('auth');

// Products
Route::get('/products/fpds-query', function () { return view('products.fpds-query'); })->name('products.fpds-query');
Route::get('/products/fpds-reports', function () { return view('products.fpds-reports'); })->name('products.fpds-reports');
Route::get('/products/fpds-charts', function () { return view('products.fpds-charts'); });

// Products Overview
Route::get('/products/fpds-query/overview', function () { return view('products.fpds-query-overview'); })->name('products.fpds-query-overview');
Route::get('/products/fpds-reports/overview', function () { return view('products.fpds-reports-overview'); })->name('products.fpds-reports-overview');
Route::get('/products/fpds-charts/overview', function () { return view('products.fpds-charts-overview'); });

// Services
Route::get('/services/gov', function () { return view('services.gov'); })->name('services.gov');
Route::get('/services/biz', function () { return view('services.biz'); })->name('services.biz');

// Terms & Conditions
Route::get('/user-terms-conditions', function () { return view('user-terms-conditions'); })->name('user-terms-conditions');
Route::get('/privacy-policy', function () { return view('privacy-policy'); })->name('privacy-policy');
Route::get('/company', function () { return view('company'); })->name('company');

// checkout page
Route::get('/checkout', function () { return view('checkout'); })->name('checkout');
Route::post('/checkout/remove-item', [CheckoutController::class, 'removeItem'])->name('checkout.remove-item');
Route::post('/checkout/process', [CheckoutController::class, 'process'])->name('checkout.process');

// thank-you page
Route::get('/thank-you', function () { return view('thank-you'); })->middleware('auth');
// cancelled page
Route::get('/cancelled', function () { return view('cancelled'); })->middleware('auth');
