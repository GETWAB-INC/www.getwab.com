<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\Yaml\Yaml;

class LibraryController extends Controller
{
    /**
     * Load reports catalog from YAML with caching.
     *
     * Cache strategy:
     * - cache key includes filemtime() so any file change auto-invalidates
     * - optional reset toggle via env('LIBRARY_CACHE_RESET')
     */
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

        // Versioned cache key: changes automatically when file changes
        $version = @filemtime($file) ?: 0;
        $cacheKey = "library:reports_catalog:v{$version}";

        // Toggle reset via .env / config. Set true to force rebuild cache.
        // Put in .env: LIBRARY_CACHE_RESET=true
        $reset = filter_var(env('LIBRARY_CACHE_RESET', false), FILTER_VALIDATE_BOOLEAN);

        // If reset enabled, drop all old catalog keys and rebuild fresh for this version
        if ($reset) {
            // Best effort cleanup: remove any previous versions
            // NOTE: This uses Cache store; for redis it will be fast.
            // If you want to avoid scanning in prod, leave this on dev only.
            try {
                foreach (Cache::getRedis()->keys('library:reports_catalog:*') as $key) {
                    // phpredis returns raw keys; delete them
                    Cache::getRedis()->del($key);
                }
            } catch (\Throwable $e) {
                // If cache store is not redis or keys() is unavailable, just forget current key
                Cache::forget($cacheKey);
            }

            // Also forget current version key explicitly
            Cache::forget($cacheKey);
        }

        return Cache::rememberForever($cacheKey, function () use ($file) {
            try {
                $data = Yaml::parseFile($file);
            } catch (\Throwable $e) {
                abort(500, "YAML parse error: " . $e->getMessage());
            }

            if (!isset($data['reports']) || !is_array($data['reports'])) {
                abort(500, 'Invalid library.yaml format: reports not found');
            }

            return $data['reports'];
        });
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
