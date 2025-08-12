<?php

// -------------------- Static Pages --------------------

// Home page
Route::get('/', function () {
    return view('index');
})->name('/');

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
});

Route::get('/products/fpds-reports/overview', function () {
    return view('products.fpds-reports-overview');
});

Route::get('/products/fpds-charts/overview', function () {
    return view('products.fpds-charts-overview');
});

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
