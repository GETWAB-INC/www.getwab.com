<?php
use App\Http\Controllers\MainController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\LibraryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ReportPackageController;
use App\Http\Controllers\SubscriptionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmailCompanyController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ImapController;
use App\Http\Controllers\DashBoardController;
use App\Http\Controllers\FpdsSsoController;

// -------------------- Static Pages --------------------

// Home page
Route::get('/', [MainController::class, 'index']);

// Home page
Route::get('/', function () {
    return view('index-old');
});

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

// -------------------- Login Functionality - OLD --------------------

// Logout
// Route::post('/logout', function () {
//     Auth::logout();
//     request()->session()->invalidate();
//     request()->session()->regenerateToken();
//     return redirect('login');
// })->name('logout');

// // Login Process
// Route::post('login-process', [LoginController::class, 'login'])->name('login-process');

// Show login form (redirects to dashboard if already logged in)
Route::get('login', function () {
    if (Auth::check()) {
        return redirect('dashboard');
    }

    return view('login-old');
})->name('login');

// forgot
Route::get('/password/reset', [LoginController::class, 'showLinkRequestForm'])->name('forgot')->middleware('auth');
Route::post('/password/email', [LoginController::class, 'sendResetLinkEmail'])->name('password.email')->middleware('auth');
Route::get('/password/reset/{token}', [LoginController::class, 'showResetForm'])->name('password.reset')->middleware('auth');
Route::post('/password/reset', [LoginController::class, 'reset'])->name('password.update')->middleware('auth');

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

Route::post('/register-process', [RegisterController::class, 'register'])->name('register-process')->middleware('auth');
Route::get('/verify/{user}', [RegisterController::class, 'verify'])->name('verification.verify')->middleware('auth');
Route::post('/send-message', [RegisterController::class, 'sendMessage'])->name('send.message')->middleware('auth');

// article page
Route::get('/article', function () { return view('article'); })->name('article')->middleware('auth');

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
Route::get('/contact-us', function () {return view('contact-us');})->name('contact-us')->middleware('auth');

// library
Route::get('/library', [LibraryController::class, 'index'])->name('library')->middleware('auth');

// library/SFPR-GEO-EL-1 page
Route::get('/library/{report_code}', [LibraryController::class, 'show'])->name('report.show')->middleware('auth');

// Generate
Route::post('/report/generate', [ReportController::class, 'generate'])->name('report.generate')->middleware('auth');

// Products
Route::get('/products/fpds-query', function () { return view('products.fpds-query'); })->name('products.fpds-query')->middleware('auth');
Route::get('/products/fpds-reports', function () { return view('products.fpds-reports'); })->name('products.fpds-reports')->middleware('auth');
Route::get('/products/fpds-charts', function () { return view('products.fpds-charts'); })->middleware('auth');

// Products Overview
Route::get('/products/fpds-query/overview', function () { return view('products.fpds-query-overview'); })->name('products.fpds-query-overview')->middleware('auth');
Route::get('/products/fpds-reports/overview', function () { return view('products.fpds-reports-overview'); })->name('products.fpds-reports-overview')->middleware('auth');
Route::get('/products/fpds-charts/overview', function () { return view('products.fpds-charts-overview'); })->middleware('auth');

// Services
Route::get('/services/gov', function () { return view('services.gov'); })->name('services.gov')->middleware('auth');
Route::get('/services/biz', function () { return view('services.biz'); })->name('services.biz')->middleware('auth');

// Terms & Conditions
Route::get('/user-terms-conditions', function () { return view('user-terms-conditions'); })->name('user-terms-conditions')->middleware('auth');
Route::get('/privacy-policy', function () { return view('privacy-policy'); })->name('privacy-policy')->middleware('auth');
Route::get('/company', function () { return view('company'); })->name('company')->middleware('auth');

// checkout page
Route::get('/checkout', function () { return view('checkout'); })->name('checkout')->middleware('auth');
Route::post('/checkout/remove-item', [CheckoutController::class, 'removeItem'])->name('checkout.remove-item');
Route::post('/checkout/process', [CheckoutController::class, 'process'])->name('checkout.process');

// thank-you page
Route::get('/thank-you', function () { return view('thank-you'); })->middleware('auth');
// cancelled page
Route::get('/cancelled', function () { return view('cancelled'); })->middleware('auth');

// -------------------- CheckoutController --------------------
// routes/web.php
 

// Route::middleware('auth')->group(function () {
//     Route::get('/checkout', [CheckoutController::class, 'showCheckout']); // форма
//     Route::post('/checkout/pay', [CheckoutController::class, 'processPayment']); // отправка формы
//     Route::match(['get', 'post'], '/checkout/callback', [CheckoutController::class, 'handleCallback']); // от FIS
//     Route::match(['get', 'post'], '/payment/result', [CheckoutController::class, 'paymentResult']);
// });


// -------------------- ClickHouse --------------------

Route::middleware('auth')->get('/fpds/sso', [FpdsSsoController::class, 'redirect']);
Route::get('/__auth/fpds-query', [LoginController::class, 'fpdsQueryGate'])
    ->middleware(['web', 'fpds.auth', 'fpds.subscription'])
    ->name('auth.fpds-query');

// -------------------- Static Pages --------------------



// About page
Route::get('about', function () {
    return view('about');
});

// Services page
Route::get('services', function () {
    return view('services');
});

// Contact page
Route::get('contact', function () {
    return view('contact');
});

// Privacy Policy page
Route::get('privacy-policy', function () {
    return view('privacy-policy-old');
})->name('privacy-policy');

// Cookie Policy page
Route::get('cookie-policy', function () {
    return view('cookie-policy');
});

// Terms of Use page
Route::get('terms-of-use', function () {
    return view('terms-of-use');
});

// -------------------- Authenticated Routes --------------------

// Группа маршрутов, требующих аутентификацию
Route::middleware('auth')->group(function () {
    // Dashboard route
    Route::get('/dashboard', [DashBoardController::class, 'index'])->name('dashboard');
    // Add company form
    Route::get('/add-company', [EmailCompanyController::class, 'create'])->name('add-company');
    // Store new contract
    Route::post('/add-contract', [EmailCompanyController::class, 'storeContract'])->name('store-contract');
    // Store new company
    Route::post('/add-company', [EmailCompanyController::class, 'storeCompany'])->name('store-company');

    Route::get('/view-hello-email/{id}', [EmailCompanyController::class, 'viewHelloEmail'])->name('view-hello-email');
    Route::get('/view-again-email/{id}', [EmailCompanyController::class, 'viewAgainEmail'])->name('view-again-email');
    
    Route::get('/bussines/view-hello-email/{id}', [EmailCompanyController::class, 'bussinesViewHelloEmail'])->name('bussines-view-hello-email');
    Route::get('/bussines/view-again-email/{id}', [EmailCompanyController::class, 'bussinesViewAgainEmail'])->name('bussines-view-again-email');

    Route::get('/edit-contract/{id}', [EmailCompanyController::class, 'edit'])->name('edit-contract');
    Route::put('/update-contract/{id}', [EmailCompanyController::class, 'update'])->name('update-contract');
    Route::delete('/delete-contract/{id}', [EmailCompanyController::class, 'destroy'])->name('delete-contract');

    Route::get('/edit-company/{id}', [EmailCompanyController::class, 'editCompany'])->name('edit-company');
    Route::put('/update-company/{id}', [EmailCompanyController::class, 'updateCompany'])->name('update-company');
    Route::delete('/delete-company/{id}', [EmailCompanyController::class, 'destroyCompany'])->name('delete-company');

    Route::get('/edit-bussines/{id}', [EmailCompanyController::class, 'editBussines'])->name('edit-bussines');
    Route::put('/update-bussines/{id}', [EmailCompanyController::class, 'updateBussines'])->name('update-bussines');
    Route::delete('/delete-bussines/{id}', [EmailCompanyController::class, 'destroyBussines'])->name('delete-bussines');

    Route::get('/file-annual-report', function () {
    return view('file-annual-report');})->name('file.annual.report');

    Route::get('/imap/emails', [ImapController::class, 'fetchEmails'])->name('imap');

    // Logs
    Route::get('/logs', [EmailCompanyController::class, 'logs'])->name('logs');
    Route::get('/logs-hello-email', [EmailCompanyController::class, 'showHelloEmailLogs'])->name('show-hello-email-logs');
    Route::get('/logs-again-email', [EmailCompanyController::class, 'showAgainEmailLogs'])->name('show-again-email-logs');
    Route::get('/logs-last-email', [EmailCompanyController::class, 'showLastEmailLogs'])->name('show-last-email-logs');


    Route::any('/_me/adminer', [DashBoardController::class, 'adminer'])
    ->name('adminer');
    // -------------------- Email Views for Sending --------------------

    // Hello Email view
    Route::get('/hello-email', function () {
        $company = new stdClass();
        $company->recipient_name = 'Name';
        $company->recipient_email = 'email@example.com';
        $company->company_name = 'Your Company';
        $company->contract_topic = 'Contract';
        $company->contract_id = '12345';
        $company->contract_start_date = '2024-01-01';
        $company->contract_end_date = '2024-12-31';
        $company->subscribe = 'Yes';
        $company->hello_email = '2024-01-02';
        $company->hello_email_again = '2024-06-01';
        $company->last_email_at = '2024-06-01';
        $company->created_at = '2024-01-01';

        return view('mail.hello_email', ['company' => $company]);
    })->name('hello-email');

    // Hello Again Email view
    Route::get('/hello-again', function () {
        $company = new stdClass();
        $company->recipient_name = 'Name';
        $company->recipient_email = 'email@example.com';
        $company->company_name = 'Your Company';
        $company->contract_topic = 'Contract';
        $company->contract_id = '12345';
        $company->contract_start_date = '2024-01-01';
        $company->contract_end_date = '2024-12-31';
        $company->subscribe = 'Yes';
        $company->hello_email = '2024-01-02';
        $company->hello_email_again = '2024-06-01';
        $company->last_email_at = '2024-06-01';
        $company->created_at = '2024-01-01';

        return view('mail.hello_again', ['company' => $company]);
    })->name('hello-again');

    // Last Email view
    Route::get('/last-email', function () {
        $company = new stdClass();
        $company->recipient_name = 'Name';
        $company->recipient_email = 'email@example.com';
        $company->company_name = 'Your Company';
        $company->contract_topic = 'Contract';
        $company->contract_id = '12345';
        $company->contract_start_date = '2024-01-01';
        $company->contract_end_date = '2024-12-31';
        $company->subscribe = 'Yes';
        $company->hello_email = '2024-01-02';
        $company->hello_email_again = '2024-06-01';
        $company->last_email_at = '2024-06-01';
        $company->created_at = '2024-01-01';

        return view('mail.last_email', ['company' => $company]);
    })->name('last-email');

    // -------------------- End Email Views for Sending --------------------
});

// -------------------- Unsubscribe Functionality --------------------

// Unsubscribe route
// Маршрут для перехода с email (GET-запрос)
Route::get('/unsubscribe', [EmailCompanyController::class, 'showUnsubscribePage'])->name('unsubscribe')->middleware('auth');;

// Маршрут для обработки POST-запроса (реальная отписка)
Route::post('/unsubscribe', [EmailCompanyController::class, 'unsubscribe'])->name('unsubscribe.post')->middleware('auth');;
Route::get('/unsubscribe/{company_id}', [EmailCompanyController::class, 'showUnsubscribeDetails'])->name('unsubscribe.details')->middleware('auth');;