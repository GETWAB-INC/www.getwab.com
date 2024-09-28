<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\HelloEmail;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SendHelloEmail extends Command
{
    protected $signature = 'send:helloemail';
    protected $description = 'Sends a hello email to the company who have not received one, excluding Fridays, Saturdays, and Sundays.';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $now = Carbon::now();

        // Проверяем, что сегодня не пятница, суббота или воскресенье
        if ($this->isWeekend($now)) {
            $this->info('Today is a weekend. No emails will be sent.');
            return;
        }

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

            $this->info('Hello email sent to ' . $company->recipient_email);
        } else {
            $this->info('No eligible emails to send.');
        }
    }

    /**
     * Проверка на выходные (пятница, суббота, воскресенье)
     */
    private function isWeekend($date)
    {
        // Пятница = 5, Суббота = 6, Воскресенье = 0
        $dayOfWeek = $date->dayOfWeek;
        return $dayOfWeek === 5 || $dayOfWeek === 6 || $dayOfWeek === 0;
    }
}
