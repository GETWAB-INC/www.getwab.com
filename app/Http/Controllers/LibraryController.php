<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\Yaml\Yaml;

class LibraryController extends Controller
{
    private const CACHE_KEY = 'library:reports_catalog:json';

    private function catalogFilePath(): string
    {
        $basePath = config('library.reports_catalog_path');
        if (!$basePath) {
            abort(500, 'REPORTS_CATALOG_PATH is not configured');
        }

        $file = rtrim($basePath, '/') . '/library.yaml';
        if (!is_readable($file)) {
            abort(500, "Catalog file not readable: {$file}");
        }

        return $file;
    }

    private function loadReports(): array
    {
        // 1) Try cache (JSON string)
        $json = Cache::get(self::CACHE_KEY);
        if (is_string($json) && $json !== '') {
            $decoded = json_decode($json, true);
            if (is_array($decoded)) {
                return $decoded;
            }
            // Corrupted cache, drop it
            Cache::forget(self::CACHE_KEY);
        }

        // 2) Build cache from YAML
        $file = $this->catalogFilePath();

        try {
            $data = Yaml::parseFile($file);
        } catch (\Throwable $e) {
            abort(500, 'YAML parse error: ' . $e->getMessage());
        }

        if (!isset($data['reports']) || !is_array($data['reports'])) {
            abort(500, 'Invalid library.yaml format: reports not found');
        }

        $reports = $data['reports'];

        $json = json_encode(
            $reports,
            JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES
        );

        if ($json === false) {
            abort(500, 'JSON encode error: ' . json_last_error_msg());
        }

        Cache::forever(self::CACHE_KEY, $json);

        return $reports;
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

    // Debug view: pretty JSON in browser
    public function libraryReportsCatalogJSON()
    {
        $reports = $this->loadReports();

        return response()->json(
            $reports,
            200,
            [],
            JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES
        );
    }

    public function resetCatalogCache(Request $request)
    {
        if (!auth()->check() || auth()->user()->id !== 1) {
            abort(403);
        }

        Cache::forget(self::CACHE_KEY);

        return redirect()
            ->back()
            ->with('status', 'Library cache reset: OK');
    }

}
