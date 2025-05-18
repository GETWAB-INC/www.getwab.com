<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\LastEmail; // Мейлер для последнего письма
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;

class SendLastEmail extends Command
{
    protected $signature = 'send:lastemail';
    protected $description = 'Sends a follow-up last email every 7 days after the again email, if the user is still subscribed.';

    public function __construct()
    {
        parent::__construct();
    }

  public function handle()
{
    // Путь к лог файлу
    $logPath = storage_path('logs/lastemail.log');

    // Получаем компанию, которая соответствует условиям
    $company = DB::table('email_companies')
                ->whereNotNull('hello_email_again')
                ->where('subscribe', 0) // Убедимся, что пользователь не отписался
                ->where(function($query) {
                    $query->whereNull('last_email_at')
                          ->orWhere('last_email_at', '<=', Carbon::now()->subDays(7));
                })
                ->where('hello_email_again', '<=', Carbon::now()->subDays(7)) // Проверяем 7 дней для hello_email_again
                ->first();

    if ($company) {
        // Отправляем последнее письмо
        Mail::to($company->recipient_email)->send(new LastEmail($company));

        // Обновляем запись в базе данных
        DB::table('email_companies')
            ->where('id', $company->id)
            ->update(['last_email_at' => now()]);

        $message = 'Last email sent to ' . $company->recipient_email;
        $this->info($message);
        Log::channel('lastemail')->info($message);  // Логируем отправку письма
    } else {
        $this->updateNoEmailLog($logPath);  // Обновляем лог "No eligible emails to send."
    }
}

    /**
     * Метод для обновления лога, если нет писем для отправки
     */
    private function updateNoEmailLog($logPath)
    {
        $logMessage = "No eligible emails to send.";

        if (File::exists($logPath)) {
            $logContents = File::get($logPath);

            // Если строка уже существует, заменяем её
            if (strpos($logContents, $logMessage) !== false) {
                $logContents = preg_replace("/\[\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}\] production.INFO: $logMessage/", '[' . now() . "] production.INFO: $logMessage", $logContents);
                File::put($logPath, $logContents);
            } else {
                // Если строки нет, добавляем её
                Log::channel('lastemail')->info($logMessage);
            }
        } else {
            // Если файл не существует, создаем и записываем строку
            Log::channel('lastemail')->info($logMessage);
        }

        $this->info('No eligible emails to send. Log updated.');
    }
}
