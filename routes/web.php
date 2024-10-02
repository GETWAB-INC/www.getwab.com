<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\EmailCompanyController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

Route::get('/', function () {
    return view('index');
});

Route::get('about', function () {
    return view('about');
});

Route::get('services', function () {
    return view('services');
});

Route::get('contact', function () {
    return view('contact');
});

Route::get('privacy-policy', function () {
    return view('privacy-policy');
});

Route::get('cookie-policy', function () {
    return view('cookie-policy');
});

Route::get('terms-of-use', function () {
    return view('terms-of-use');
});

Route::get('login', function () {
    if (Auth::check()) {
        return redirect('dashboard');
    }

    return view('login');
});

Route::get('/add-company', function () {
    if (!Auth::check()) {
        return redirect('/login');
    }
    return app(EmailCompanyController::class)->create();
})->name('add-company');

Route::post('/add-company', function () {
    if (!Auth::check()) {
        return redirect('/login');
    }
    return app(EmailCompanyController::class)->store(request());
})->name('store-company');

Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('login');
})->name('logout');

Route::post('login-process', [LoginController::class, 'login'])->name('login-process');


Route::get('dashboard', function () {
    if (!Auth::check()) {
        return redirect('/login');
    }

    $companies = DB::table('email_companies')->get();

    return view('dashboard', ['companies' => $companies]);
})->name('dashboard');

// Route::get('/hello-email', function () {
//     $company = new stdClass();
//     $company->recipient_name = 'Name';
//     $company->recipient_email = 'email@example.com';
//     $company->company_name = 'Your Company';
//     $company->contract_topic = 'Contract';
//     $company->contract_id = '12345';
//     $company->contract_start_date = '2024-01-01';
//     $company->contract_end_date = '2024-12-31';
//     $company->subscribe = 'Yes';
//     $company->hello_email = '2024-01-02';
//     $company->hello_email_again = '2024-06-01';
//     $company->last_email_at = '2024-06-01';
//     $company->created_at = '2024-01-01';

//     return view('mail.hello_email', ['company' => $company]);
// });

// Route::get('/hello-again', function () {
//     $company = new stdClass();
//     $company->recipient_name = 'Name';
//     $company->recipient_email = 'email@example.com';
//     $company->company_name = 'Your Company';
//     $company->contract_topic = 'Contract';
//     $company->contract_id = '12345';
//     $company->contract_start_date = '2024-01-01';
//     $company->contract_end_date = '2024-12-31';
//     $company->subscribe = 'Yes';
//     $company->hello_email = '2024-01-02';
//     $company->hello_email_again = '2024-06-01';
//     $company->last_email_at = '2024-06-01';
//     $company->created_at = '2024-01-01';

//     return view('mail.hello_again', ['company' => $company]);
// });

// Route::get('/last-email', function () {
//     $company = new stdClass();
//     $company->recipient_name = 'Name';
//     $company->recipient_email = 'email@example.com';
//     $company->company_name = 'Your Company';
//     $company->contract_topic = 'Contract';
//     $company->contract_id = '12345';
//     $company->contract_start_date = '2024-01-01';
//     $company->contract_end_date = '2024-12-31';
//     $company->subscribe = 'Yes';
//     $company->hello_email = '2024-01-02';
//     $company->hello_email_again = '2024-06-01';
//     $company->last_email_at = '2024-06-01';
//     $company->created_at = '2024-01-01';

//     return view('mail.last_email', ['company' => $company]);
// });

Route::get('/unsubscribe', [EmailCompanyController::class, 'unsubscribe'])->name('unsubscribe');
Route::get('/dkim', function () {
    if (!Auth::check()) {
        return redirect('/login');
    }

    // Вызываем метод контроллера
    return app(EmailCompanyController::class)->getDkim();
})->name('dkim');
