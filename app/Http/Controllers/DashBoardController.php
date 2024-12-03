<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashBoardController extends Controller
{
    public function index()
    {
        // Получаем компании, сортируя их по id в порядке убывания
        $companies = DB::table('email_companies')->where('subscribe', '=', 0)->orderBy('id', 'desc')->get();

        return view('dashboard', ['companies' => $companies]);
    }
}
