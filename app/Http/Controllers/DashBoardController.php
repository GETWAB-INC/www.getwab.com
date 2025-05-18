<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class DashBoardController extends Controller
{
    public function index()
    {
        // Получаем контракты из таблицы email_companies
        $contracts = DB::table('email_companies')
            ->where('subscribe', '=', 0)
            ->orderBy('id', 'desc')
            ->paginate(20);

        // Получаем компании из таблицы empstateweb_emails
        $companies = DB::table('empstateweb_emails')
            ->orderBy('id', 'desc')
            ->paginate(20);

        // Передаём обе переменные в представление
        return view('dashboard', [
            'contracts' => $contracts,
            'companies' => $companies
        ]);
    }
}
