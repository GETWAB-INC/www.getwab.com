<?php

// -------------------- Static Pages --------------------

// Home page
Route::get('/', function () {
    return view('index');
})->name('/');

Route::get('/company', function () {
    return view('company');
})->name('company');

Route::get('/mission', function () {
    return view('mission');
})->name('mission');

// login page
Route::get('login', function () {
    return view('login');
})->name('login');

// register page
Route::get('register', function () {
    return view('register');
})->name('register');

// article page
Route::get('article', function () {
    return view('article');
})->name('article');

// account page
Route::get('account', function () {
    return view('account');
})->name('account');

// contact page
Route::get('contact-us', function () {return view('contact-us');})->name('contact-us');

// reports page
Route::get('reports', function () {
    return view('reports');
})->name('reports');

// reports/SFPR-GEO-EL-1 page
Route::get('/reports/SFPR-GEO-EL-1', function () {
    return view('reports.SFPR-GEO-EL-1');
})->name('report');

// Продукты: базовые страницы
Route::get('/products/fpds-query', function () {
    return view('products.fpds-query');
})->name('products.fpds-query');

Route::get('/products/fpds-reports', function () {
    return view('products.fpds-reports');
})->name('products.fpds-reports');

Route::get('/products/fpds-charts', function () {
    return view('products.fpds-charts');
});

// Продукты: страницы обзора
Route::get('/products/fpds-query/overview', function () {
    return view('products.fpds-query-overview');
})->name('products.fpds-query-overview');

Route::get('/products/fpds-reports/overview', function () {
    return view('products.fpds-reports-overview');
})->name('products.fpds-reports-overview');

Route::get('/products/fpds-charts/overview', function () {
    return view('products.fpds-charts-overview');
});

// Services


Route::get('/services/consulting-advisory', function () {
    return view('services.consulting-advisory');
})->name('services.consulting-advisory');

Route::get('/services/custom-analytics', function () {
    return view('services.custom-analytics');
})->name('services.custom-analytics');

Route::get('/services/data-automation', function () {
    return view('services.data-automation');
})->name('services.data-automation');

Route::get('/services/gov-contracting', function () {
    return view('services.gov-contracting');
})->name('services.gov-contracting');

// checkout page
Route::get('checkout', function () {
    return view('checkout');
})->name('checkout');

// thank-you page
Route::get('thank-you', function () {
    return view('thank-you');
});
// cancelled page
Route::get('cancelled', function () {
    return view('cancelled');
});
