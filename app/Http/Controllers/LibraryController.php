<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\Yaml\Yaml;
use Symfony\Component\Yaml\Exception\ParseException;

class LibraryController extends Controller
{

    private function loadReports(): array
    {
        $basePath = config('library.reports_catalog_path');
        if (!$basePath) {
            abort(500, 'REPORTS_CATALOG_PATH is not configured');
        }

        $file = rtrim($basePath, '/') . '/library.yaml';
        if (!is_readable($file)) {
            abort(500, "Catalog file not readable: {$file}");
        }

        try {
            $data = Yaml::parseFile($file);
        } catch (\Throwable $e) {
            abort(500, "YAML parse error: " . $e->getMessage());
        }

        if (!isset($data['reports']) || !is_array($data['reports'])) {
            abort(500, 'Invalid library.yaml format: reports not found');
        }

        return $data['reports'];
    }

    public function index(Request $request)
    {
        $reports = $this->loadReports();
        return view('library.index', compact('reports'));
    }

    public function show(Request $request, string $report_code)
    {
        $reports = $this->loadReports();

        $report = collect($reports)->firstWhere('report_code', $report_code);

        if (!$report) {
            abort(404, 'Report not found');
        }


        return view('library.show', compact('report'));
    }
}
