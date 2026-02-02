<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\Yaml\Yaml;

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

        $cacheKey = 'library:reports_catalog:json';

        // Ручной сброс
        $reset = filter_var(env('LIBRARY_CACHE_RESET', false), FILTER_VALIDATE_BOOLEAN);
        if ($reset) {
            Cache::forget($cacheKey);
        }

        // Пытаемся взять JSON из кеша
        $json = Cache::get($cacheKey);
        if ($json) {
            $decoded = json_decode($json, true);
            if (is_array($decoded)) {
                return $decoded;
            }
            // если вдруг битый JSON — пересобираем
            Cache::forget($cacheKey);
        }

        // Читаем YAML
        try {
            $data = Yaml::parseFile($file);
        } catch (\Throwable $e) {
            abort(500, 'YAML parse error: ' . $e->getMessage());
        }

        if (!isset($data['reports']) || !is_array($data['reports'])) {
            abort(500, 'Invalid library.yaml format: reports not found');
        }

        // Кладём в Redis как JSON
        $json = json_encode(
            $data['reports'],
            JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES
        );

        if ($json === false) {
            abort(500, 'JSON encode error: ' . json_last_error_msg());
        }

        Cache::forever($cacheKey, $json);

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

    public function libraryReportsCatalogJSON()
    {
        $json = Cache::get('library:reports_catalog:json');

        return response(
            json_encode(json_decode($json, true), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES),
            200,
            ['Content-Type' => 'application/json; charset=utf-8']
        );
    }

}
