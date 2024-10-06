<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\HelloEmail;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

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
            Log::channel('helloemail')->info($message);  // Логируем в отдельный файл
        } else {
            $message = 'No eligible emails to send.';
            $this->info($message);
            Log::channel('helloemail')->info($message);  // Логируем в отдельный файл
        }
    }
}
