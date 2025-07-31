<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\EmailCompanyController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ImapController;
use App\Http\Controllers\DashBoardController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\CheckoutController;
use Illuminate\Http\Request;



// -------------------- CheckoutController --------------------
// routes/web.php


Route::get('/checkout', [CheckoutController::class, 'showCheckout']);  // форма
Route::post('/checkout/pay', [CheckoutController::class, 'processPayment']); // отправка формы
Route::match(['get', 'post'], '/checkout/callback', [CheckoutController::class, 'handleCallback']); // от FIS

Route::match(['get', 'post'], '/payment/result', function (Request $request) {
    // 📋 Логируем метод запроса
    $method = $request->method();
    Log::info("🔔 /payment/result — Method: {$method}");

    // 📋 Логируем все входящие данные
    Log::info('🔔 /payment/result — Payload:', $request->all());

    $decision = $request->get('decision');

    if ($decision === 'ACCEPT') {
        return view('checkout.result', [
            'status' => 'success',
            'message' => '✅ Payment was successful!',
        ]);
    } elseif ($decision === 'REJECT') {
        return view('checkout.result', [
            'status' => 'failed',
            'message' => '❌ Payment was declined. Please try another card.',
        ]);
    } else {
        return view('checkout.result', [
            'status' => 'unknown',
            'message' => '⚠️ Unable to determine payment result.',
        ]);
    }
});

Route::get('/checkout/test', [CheckoutController::class, 'test'])->name('checkout.test');

Route::get('/checkout/button', function () {

    return view('checkout.test');
})->name('checkout.button');

// -------------------- CheckoutController --------------------









// -------------------- Static Pages --------------------

// Home page
Route::get('/', function () {
    return view('index');
});

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
    return view('privacy-policy');
});

// Cookie Policy page
Route::get('cookie-policy', function () {
    return view('cookie-policy');
});

// Terms of Use page
Route::get('terms-of-use', function () {
    return view('terms-of-use');
});

// Route::get('/register', [RegisterController::class, 'index'])->name('register');
// Route::post('/register/store', [RegisterController::class, 'store']);

// -------------------- End Static Pages --------------------



// -------------------- Login Functionality --------------------

// Logout
Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('login');
})->name('logout');

// Login Process
Route::post('login-process', [LoginController::class, 'login'])->name('login-process');

// Show login form (redirects to dashboard if already logged in)
Route::get('login', function () {
    if (Auth::check()) {
        return redirect('dashboard');
    }

    return view('login');
})->name('login');

// -------------------- End Login Functionality --------------------



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

// -------------------- End Authenticated Routes --------------------



// -------------------- Unsubscribe Functionality --------------------

// Unsubscribe route
// Маршрут для перехода с email (GET-запрос)
Route::get('/unsubscribe', [EmailCompanyController::class, 'showUnsubscribePage'])->name('unsubscribe');

// Маршрут для обработки POST-запроса (реальная отписка)
Route::post('/unsubscribe', [EmailCompanyController::class, 'unsubscribe'])->name('unsubscribe.post');
Route::get('/unsubscribe/{company_id}', [EmailCompanyController::class, 'showUnsubscribeDetails'])->name('unsubscribe.details');

// -------------------- End Unsubscribe Functionality --------------------
