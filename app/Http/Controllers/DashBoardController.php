<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class DashBoardController extends Controller
{
    public function index()
    {
        // Используем paginate вместо simplePaginate
        $companies = DB::table('email_companies')
                       ->where('subscribe', '=', 0)
                       ->orderBy('id', 'desc')
                       ->paginate(20);

        return view('dashboard', ['companies' => $companies]);
    }
}
