<?php

namespace App\Console\Commands;

use App\Models\Report;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GenerateReports extends Command
{
    protected $signature = 'app:generate-reports';
    protected $description = 'Find draft reports (status=draft, report_id=NULL) and send to Python generator';


    public function handle()
    {
        $draftReports = Report::where('status', 'draft')
            ->whereNull('report_id')
            ->get();


        if ($draftReports->isEmpty()) {
            $this->info('No draft reports found.');
            return 0;
        }

        $this->info('Found ' . $draftReports->count() . ' draft reports. Processing...');

        foreach ($draftReports as $report) {
            try {
                $this->sendToPython($report);
                $report->update(['status' => 'pending']);
                $this->info('Report ID ' . $report->id . ' sent to generator and marked as pending.');
            } catch (\Exception $e) {
                $this->error('Failed to process report ID ' . $report->id . ': ' . $e->getMessage());
            }
        }

        $this->info('Processing completed.');
        return 0;
    }

    protected function sendToPython(Report $report)
    {
        // 1. Собираем параметры
        $parameters = [];
        foreach ($report->parameters as $param) {
            $parameters[$param->parameter_key] = $param->parameter_value;
        }

        // 2. Формируем данные для отправки
        $payload = [
            'report_code' => $report->report_code,
            'report_parameters' => $parameters,
        ];

        // 3. Выводим в консоль для отладки
        $this->line('');
        $this->warn('Sending report ID: ' . $report->id);
        $this->info('Report code: ' . $report->report_code);
        $this->info('Parameters:');
        foreach ($parameters as $key => $value) {
            $this->line('  ' . $key . ' => ' . $value);
        }
        $this->line('');

        // 4. Логируем в файл (опционально)
        Log::info('Sending report to Python', [
            'report_id' => $report->id,
            'report_code' => $report->report_code,
            'parameters' => $parameters,
        ]);

        // 5. Отправляем запрос
        try {
            $response = Http::timeout(30)
                ->post('http://localhost:8001/generate-report', $payload);

            if (!$response->successful()) {
                throw new \Exception('Python API error: ' . $response->body());
            }

            $this->info('Successfully sent report ID ' . $report->id);
        } catch (\Exception $e) {
            $this->error('Connection failed for report ID ' . $report->id . ': ' . $e->getMessage());
            throw $e; // Перебрасываем исключение для обработки в handle()
        }
    }
}
