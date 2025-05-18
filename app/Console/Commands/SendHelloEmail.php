<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\HelloEmail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;

class SendHelloEmail extends Command
{
    protected $signature = 'send:helloemail';
    protected $description = 'Sends a hello email to the company who have not received one.';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        // Путь к лог файлу
        $logPath = storage_path('logs/helloemail.log');

        // Получаем компанию, которая еще не получила hello_email
        $company = DB::table('email_companies')
                    ->whereNull('hello_email')
                    ->where('subscribe', 0)
                    ->first();

        if ($company) {
            // Отправляем письмо
            Mail::to($company->recipient_email)->send(new HelloEmail($company));

            // Обновляем запись в базе данных, чтобы отметить отправку письма
            DB::table('email_companies')
              ->where('id', $company->id)
              ->update(['hello_email' => now()]);

            $message = 'Hello email sent to ' . $company->recipient_email;
            $this->info($message);
            $this->appendToLog($logPath, $message);  // Логируем отправку
        } else {
            $this->updateNoEmailLog($logPath);  // Обновляем лог с "No eligible emails"
        }
    }

    /**
     * Метод для добавления записи в лог
     */
    private function appendToLog($logPath, $message)
    {
        $timestamp = '[' . now() . '] production.INFO: ';

        if (File::exists($logPath)) {
            $logContents = File::get($logPath);

            // Убираем запись "No eligible emails" если она последняя
            if (strpos($logContents, "No eligible emails to send.") !== false) {
                $lines = explode(PHP_EOL, trim($logContents));
                if (!empty($lines) && strpos(end($lines), "No eligible emails to send.") !== false) {
                    array_pop($lines);
                }
                $logContents = implode(PHP_EOL, $lines);
            }

            // Добавляем новую запись
            $logContents .= PHP_EOL . $timestamp . $message;
            File::put($logPath, $logContents);
        } else {
            // Если файл не существует, создаем и записываем строку
            File::put($logPath, $timestamp . $message);
        }

        Log::channel('helloemail')->info($message);
    }

    /**
     * Метод для обновления лога, если нет писем для отправки
     */
    private function updateNoEmailLog($logPath)
    {
        $logMessage = 'No eligible emails to send.';
        $timestamp = '[' . now() . '] production.INFO: ';

        if (File::exists($logPath)) {
            $logContents = File::get($logPath);

            // Если строка уже существует, заменяем её только если она последняя
            $lines = explode(PHP_EOL, trim($logContents));
            if (!empty($lines) && strpos(end($lines), $logMessage) !== false) {
                $lines[count($lines) - 1] = $timestamp . $logMessage;
                $logContents = implode(PHP_EOL, $lines);
            } else {
                // Если строки нет или она не последняя, добавляем её
                $logContents .= PHP_EOL . $timestamp . $logMessage;
            }
            File::put($logPath, $logContents);
        } else {
            // Если файл не существует, создаем и записываем строку
            File::put($logPath, $timestamp . $logMessage);
        }

        Log::channel('helloemail')->info($logMessage);
    }
}
