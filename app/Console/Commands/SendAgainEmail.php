<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\AgainEmail; // Мейлер для повторного письма
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;

class SendAgainEmail extends Command
{
    protected $signature = 'send:againemail';
    protected $description = 'Sends a follow-up email one week after the hello email.';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        // Путь к лог файлу
        $logPath = storage_path('logs/againemail.log');

        // Лог текущей даты и времени
        Log::channel('againemail')->info('Command started at: ' . Carbon::now());

        // Получаем одну компанию, которая получила hello_email неделю назад и еще не получила again_email
        $company = DB::table('email_companies')
                    ->whereNotNull('hello_email')
                    ->whereNull('hello_email_again')
                    ->where('subscribe', 0) // Дополнительная проверка на подписку
                    ->first();

        if ($company) {
            // Лог данных компании
            Log::channel('againemail')->info('Company data:', (array) $company);

            $helloEmailDate = Carbon::parse($company->hello_email);
            $now = Carbon::now();

            // Лог дат для сравнения
            Log::channel('againemail')->info('Hello email date: ' . $helloEmailDate);
            Log::channel('againemail')->info('Current date: ' . $now);
            Log::channel('againemail')->info('Days difference: ' . $now->diffInDays($helloEmailDate));

            // Проверяем, прошла ли неделя с момента отправки hello_email
            if ($now->diffInDays($helloEmailDate) >= 7) {
                try {
                    // Отправляем повторное письмо
                    Mail::to($company->recipient_email)->send(new AgainEmail($company));

                    // Обновляем запись в базе данных, чтобы отметить отправку повторного письма
                    DB::table('email_companies')
                        ->where('id', $company->id)
                        ->update(['hello_email_again' => now()]);

                    $message = 'Follow-up email sent to ' . $company->recipient_email;
                    $this->info($message);
                    Log::channel('againemail')->info($message);
                } catch (\Exception $e) {
                    $this->error('Error sending email: ' . $e->getMessage());
                    Log::channel('againemail')->error('Error sending email: ' . $e->getMessage());
                }
            } else {
                $this->info('Not enough days passed since hello_email.');
                Log::channel('againemail')->info('Not enough days passed since hello_email.');
            }
        } else {
            $this->updateNoEmailLog($logPath);
        }
    }

    /**
     * Метод для обновления лога, если нет писем для отправки
     */
    private function updateNoEmailLog($logPath)
    {
        $logMessage = "No eligible emails to send yet.";

        if (File::exists($logPath)) {
            $logContents = File::get($logPath);

            // Если строка уже существует, заменяем её
            if (strpos($logContents, $logMessage) !== false) {
                $logContents = preg_replace("/\[\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}\] production.INFO: $logMessage/", '[' . now() . "] production.INFO: $logMessage", $logContents);
                File::put($logPath, $logContents);
            } else {
                // Если строки нет, добавляем её
                Log::channel('againemail')->info($logMessage);
            }
        } else {
            // Если файл не существует, создаем и записываем строку
            Log::channel('againemail')->info($logMessage);
        }

        $this->info('No eligible emails to send yet. Log updated.');
    }
}
