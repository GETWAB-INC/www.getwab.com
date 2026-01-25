<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class DashBoardController extends Controller
{
    public function index()
    {
        // Передаём обе переменные в представление
        return view('dashboard');
    }
}
