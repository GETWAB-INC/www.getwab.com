<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

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
        $reportType = $request->input('report_code');

        // Проверяем, поддерживается ли тип отчёта
        $rules = $this->getReportRules($reportType);
        if (empty($rules)) {
            return back()->withErrors([
                'report_code' => 'Unsupported report type: ' . $reportType
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

        // Если валидация прошла — сохраняем данные в сессию для чекаута
        Session::put('checkout_report', [
            'report_code' => $reportType,
            'report_type' => $request->input('report_type'),
            'start_year'  => $request->input('start_year'),
            'end_year'    => $request->input('end_year'),
            // При необходимости добавьте другие поля из $request
        ]);

        dd(Session::get('checkout_report'));


        // Перенаправляем на чекаут
        return redirect()->route('checkout')->with([
            'success' => 'Report data saved. Please proceed to checkout to generate the report.'
        ]);
    }
}
