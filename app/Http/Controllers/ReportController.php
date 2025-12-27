<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use App\Models\Report;

class ReportController extends Controller
{
    // Получаем текущий год
    private function currentYear(): int
    {
        return (int) date('Y');
    }

    // Метод для динамического получения правил валидации
    private function getReportRules(string $reportType): array
    {
        $currentYear = $this->currentYear();

        return [
            'SFPR-GEO-EL-1' => [
                'start_year' => "required|integer|between:1957,{$currentYear}",
                'end_year'   => "required|integer|between:1957,{$currentYear}|gte:start_year",
            ],
            'SFPR-GEO-EL-2' => [
                'start_year' => "required|integer|between:2000,{$currentYear}",
                'end_year'   => "required|integer|between:1957,{$currentYear}|gte:start_year",
            ],
        ][$reportType] ?? [];
    }

    protected function getReportTitle(string $reportCode): string
    {
        foreach (config('library') as $report) {
            if ($report['report_code'] === $reportCode) {
                return $report['report_title'] ?? 'Unknown Report';
            }
        }
        return 'Unknown Report';
    }

    // Метод для динамического получения сообщений об ошибках
    private function getErrorMessages(): array
    {
        $currentYear = $this->currentYear();

        return [
            'start_year.required' => 'Start year is required.',
            'start_year.integer' => 'Start year must be a number.',
            'start_year.between' => "Start year must be between 1957 and {$currentYear}.",

            'end_year.required' => 'End year is required.',
            'end_year.integer' => 'End year must be a number.',
            'end_year.between' => "End year must be between 1957 and {$currentYear}.",
            'end_year.gte' => 'End year cannot be earlier than start year.',
        ];
    }

    public function generate(Request $request)
    {
        $reportCode = $request->input('report_code');
        $reports = config('library');

        // Поиск отчёта по report_code
        $found = false;
        foreach ($reports as $report) {
            if ($report['report_code'] === $reportCode) {
                $found = true;
                break;
            }
        }

        if (!$found) {
            return back()->withErrors([
                'report_code' => 'Unsupported report type: ' . $reportCode
            ])->withInput();
        }

        // Получаем правила валидации для этого типа отчёта
        $rules = $this->getReportRules($reportCode);
        if (empty($rules)) {
            return back()->withErrors([
                'report_code' => 'No validation rules defined for report type: ' . $reportCode
            ])->withInput();
        }

        // Получаем сообщения об ошибках
        $messages = $this->getErrorMessages();

        // Валидируем данные
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        // Получаем текущего пользователя
        $user = auth()->user();


        // Ищем активный пакет отчётов с оставшимися отчётами
        $activePackage = $user->reportPackages()
            ->where('remaining_reports', '>', 0)
            ->first();

        if (!$activePackage) {
            // Нет активного пакета — сохраняем данные в сессию и перенаправляем на чекаут

            if ($request->input('report_type') === "EL") {
                Session::put('single_elementary_report', [
                    'report_code' => $reportCode,
                    'report_type' => $request->input('report_type'),
                    'start_year'  => $request->input('start_year'),
                    'end_year'    => $request->input('end_year'),
                    'report_price'    => $request->input('report_price'),
                ]);
            } else {
                Session::put('single_composite_report', [
                    'report_code' => $reportCode,
                    'report_type' => $request->input('report_type'),
                    'start_year'  => $request->input('start_year'),
                    'report_price'    => $request->input('report_price'),
                ]);
            }

            return redirect()->route('checkout');
        }

        $reportRecord = Report::create([
            'user_id' => auth()->id(),
            'report_code' => $reportCode,
            'title' => $this->getReportTitle($reportCode), // ваша логика получения названия
            'status' => 'draft', // начальный статус
            'report_id' => null, // пока нет ID генерации
        ]);

        // Уменьшаем количество оставшихся отчётов в пакете
        $activePackage->decrement('remaining_reports');

        // Перенаправляем на аккаунт с сообщением об успехе
        return redirect()->route('account')->with([
            'success' => 'Your report has been created and will be processed shortly.'
        ]);
    }
}
