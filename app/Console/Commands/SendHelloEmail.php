<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\HelloEmail;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
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
            Log::channel('helloemail')->info($message);  // Логируем отправку
        } else {
            $this->updateNoEmailLog($logPath);  // Обновляем лог с "No eligible emails"
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
                Log::channel('helloemail')->info($logMessage);
            }
        } else {
            // Если файл не существует, создаем и записываем строку
            Log::channel('helloemail')->info($logMessage);
        }

        $this->info('No eligible emails to send. Log updated.');
    }
}
