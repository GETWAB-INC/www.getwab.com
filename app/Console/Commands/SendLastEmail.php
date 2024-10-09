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

        // Получаем компанию, которая получила again_email, но еще не отписалась, и прошло 7 дней с момента отправки again_email
        $company = DB::table('email_companies')
                    ->whereNotNull('hello_email_again')
                    ->where('subscribe', 0) // Убедимся, что пользователь не отписался
                    ->where(function($query) {
                        // Добавляем условие, чтобы получить компании, которые либо не получили last_email, либо прошло 7 дней с момента отправки last_email
                        $query->whereNull('last_email_at')
                              ->orWhere('last_email_at', '<=', Carbon::now()->subDays(7));
                    })
                    ->first();

        if ($company) {
            $againEmailDate = Carbon::parse($company->hello_email_again);
            $now = Carbon::now();

            // Проверяем, прошло ли 7 дней с момента отправки again_email
            if ($now->diffInDays($againEmailDate) >= 7) {
                // Отправляем последнее письмо
                Mail::to($company->recipient_email)->send(new LastEmail($company));

                // Обновляем запись в базе данных, чтобы отметить отправку последнего письма
                DB::table('email_companies')
                    ->where('id', $company->id)
                    ->update(['last_email_at' => now()]);

                $message = 'Last email sent to ' . $company->recipient_email;
                $this->info($message);
                Log::channel('lastemail')->info($message);  // Логируем отправку письма
            } else {
                $this->updateNoEmailLog($logPath);  // Обновляем лог "It has not been 7 days since the again email."
            }
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
