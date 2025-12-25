<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Library;

class LibraryController extends Controller
{
    public function index(Request $request)
    {
        $reports = Library::whereNotNull('report_title')
            ->where('report_title', '!=', '')
            ->get();

        return view('library.index', compact('reports'));
    }

    public function show(Request $request, string $report_code)
    {
        // Ищем отчёт по коду
        $report = Library::where('report_code', $report_code)->firstOrFail();

        // Передаём отчёт в представление
        return view('library.show', compact('report'));
    }
}
