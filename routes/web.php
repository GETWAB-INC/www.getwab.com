<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\LibraryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ReportPackageController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\EmailCompanyController;

// Home page
Route::get('/', [MainController::class, 'index'])->name('index');
Route::get('/about', [MainController::class, 'about'])->name('about');
Route::get('/services', [MainController::class, 'services'])->name('services');
Route::get('/privacy-policy', [MainController::class, 'privacyPolicy'])->name('privacy-policy');
Route::get('/cookie-policy', [MainController::class, 'cookiePolicy'])->name('cookie-policy');
Route::get('/terms-of-use', [MainController::class, 'termsOfUse'])->name('terms-of-use');

// Unsubscribe route
Route::get('/unsubscribe', [EmailCompanyController::class, 'showUnsubscribePage'])->name('unsubscribe');
Route::post('/unsubscribe', [EmailCompanyController::class, 'unsubscribe'])->name('unsubscribe.post');
Route::get('/unsubscribe/{company_id}', [EmailCompanyController::class, 'showUnsubscribeDetails'])->name('unsubscribe.details');

// login 
Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post('/login-process', [LoginController::class, 'loginProcess'])->name('login-process');
Route::post('/fpds/query', [LoginController::class, 'fpdsQuery'])->name('fpds.query');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// register page
Route::get('/register', [RegisterController::class, 'register'])->name('register');
Route::post('/register-process', [RegisterController::class, 'registerProcess'])->name('register-process');
Route::get('/verify/{user}', [RegisterController::class, 'verify'])->name('verification.verify');
Route::post('/send-message', [RegisterController::class, 'sendMessage'])->name('send.message');

// forgot
Route::get('/password/reset', [LoginController::class, 'showLinkRequestForm'])->name('forgot');
Route::post('/password/email', [LoginController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/password/reset/{token}', [LoginController::class, 'showResetForm'])->name('password.reset');
Route::post('/password/reset', [LoginController::class, 'reset'])->name('password.update');


// contact page
Route::get('/contact-us', function () {return view('contact-us');})->name('contact-us');



// AUTH
Route::middleware('auth')->group(function () {

Route::get('/mail', [MainController::class, 'mail']);
Route::any('/_me/adminer', [MainController::class, 'adminer'])->name('adminer');

// article page
Route::get('/article', function () { return view('article'); })->name('article');

// account page
Route::get('/account', [AccountController::class, 'account'])->name('account');
Route::get('/account/reports', [AccountController::class, 'reports'])->name('account.reports');
Route::get('/account/packages', [AccountController::class, 'packages'])->name('account.packages');
Route::get('/account/subscription', [AccountController::class, 'subscription'])->name('account.subscription');
Route::get('/account/billing', [AccountController::class, 'billing'])->name('account.billing');
Route::get('/account/profile', [AccountController::class, 'profile'])->name('account.profile');
Route::post('/update-profile', [AccountController::class, 'updateProfile'])->name('update.profile');
Route::get('/email/change/verify', [AccountController::class, 'verifyNewEmail'])->name('email.change.verify');
Route::post('/account/upload-avatar', [AccountController::class, 'uploadAvatar'])->name('upload.avatar');
Route::delete('/account/remove-avatar', [AccountController::class, 'removeAvatar'])->name('remove.avatar');
Route::post('/order/package', action: [ReportPackageController::class, 'orderPackage'])->name('order.package');
Route::post('/order/subscription', action: [SubscriptionController::class, 'orderSubscription'])->name('order.subscription');
Route::post('/cancel/subscription', action: [SubscriptionController::class, 'cancelSubscription'])->name('cancel.subscription');
Route::post('/restore/subscription', action: [SubscriptionController::class, 'restoreSubscription'])->name('restore.subscription');
Route::post('/renew/subscription', [SubscriptionController::class, 'renewSubscription'])->name('renew.subscription');

// library
Route::get('/library', [LibraryController::class, 'index'])->name('library');

// library/SFPR-GEO-EL-1 page
Route::get('/library/{report_code}', [LibraryController::class, 'show'])->name('report.show');

// Generate
Route::post('/report/generate', [ReportController::class, 'generate'])->name('report.generate');

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
// Route::get('/privacy-policy', function () { return view('privacy-policy'); })->name('privacy-policy');
Route::get('/company', function () { return view('company'); })->name('company');

// checkout page
Route::get('/checkout', function () { return view('checkout'); })->name('checkout');
Route::post('/checkout/remove-item', [CheckoutController::class, 'removeItem'])->name('checkout.remove-item');
Route::post('/checkout/process', [CheckoutController::class, 'process'])->name('checkout.process');

// thank-you page
Route::get('/thank-you', function () { return view('thank-you'); });
// cancelled page
Route::get('/cancelled', function () { return view('cancelled'); });

});

// -------------------- CheckoutController --------------------

// Route::middleware('auth')->group(function () {
//     Route::get('/checkout', [CheckoutController::class, 'showCheckout']); // форма
//     Route::post('/checkout/pay', [CheckoutController::class, 'processPayment']); // отправка формы
//     Route::match(['get', 'post'], '/checkout/callback', [CheckoutController::class, 'handleCallback']); // от FIS
//     Route::match(['get', 'post'], '/payment/result', [CheckoutController::class, 'paymentResult']);
// });


// -------------------- ClickHouse AUTH --------------------

// Route::middleware('auth')->get('/fpds/sso', [FpdsSsoController::class, 'redirect']);
Route::get('/__auth/fpds-query', [LoginController::class, 'fpdsQueryGate'])
    ->middleware(['web', 'fpds.auth', 'fpds.subscription'])
    ->name('auth.fpds-query');


