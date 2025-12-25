<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Library;

class LibraryController extends Controller
{
    public function index(Request $request)
    {
        $reports = config('library');

        return view('library.index', compact('reports'));
    }

    
    public function show(Request $request, string $report_code)
    {
        // Загружаем все отчёты из файла
        $reports = config('library');

        // Ищем отчёт с нужным report_code
        $report = null;
        foreach ($reports as $item) {
            if ($item['report_code'] === $report_code) {
                $report = $item;
                break;
            }
        }

        // Если отчёт не найден — 404
        if (!$report) {
            abort(404, 'Report not found');
        }

        // Передаём найденный отчёт в представление
        return view('library.show', compact('report'));
    }
}
