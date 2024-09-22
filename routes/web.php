<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\EmailCampaignController;
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

// Add Campaigns page
Route::get('/add-campaign', function () {
    if (!Auth::check()) {
        return redirect('/login');
    }
    return app(EmailCampaignController::class)->create();
})->name('add-campaign');

Route::post('/add-campaign', function () {
    if (!Auth::check()) {
        return redirect('/login');
    }
    return app(EmailCampaignController::class)->store(request());
})->name('store-campaign');

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

    // Извлекаем данные из таблицы 'companies'
    $companies = DB::table('email_companies')->get();

    // Передаем данные в представление 'dashboard'
    return view('dashboard', ['companies' => $companies]);
})->name('dashboard');
