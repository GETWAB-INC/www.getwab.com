<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LibraryController extends Controller
{
    public function index(Request $request)
    {
        $reports = config('library');

        return view('library.index', compact('reports'));
    }

    
    public function show(Request $request, string $report_code)
    {
        $reports = config('library');

        $report = null;
        foreach ($reports as $item) {
            if ($item['report_code'] === $report_code) {
                $report = $item;
                break;
            }
        }

        if (!$report) {
            abort(404, 'Report not found');
        }

        return view('library.show', compact('report'));
    }
}