<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\LastEmail; // Мейлер для последнего письма
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SendLastEmail extends Command
{
    protected $signature = 'send:lastemail';
    protected $description = 'Sends a follow-up last email every 7 days after the again email, if the user is still subscribed, excluding Fridays, Saturdays, and Sundays.';

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

        // Получаем одну компанию, которая получила again_email, но еще не отписалась, и прошло 7 дней с момента отправки again_email
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
            $againEmailDate = Carbon::parse($company->again_email);

            // Проверяем, прошло ли 7 дней с момента отправки again_email
            if ($now->diffInDays($againEmailDate) >= 7) {
                // Отправляем последнее письмо
                Mail::to($company->recipient_email)->send(new LastEmail($company));

                // Обновляем запись в базе данных, чтобы отметить отправку последнего письма
                DB::table('email_companies')
                    ->where('id', $company->id)
                    ->update(['last_email_at' => now()]);

                $this->info('Last email sent to ' . $company->recipient_email);
            } else {
                $this->info('It has not been 7 days since the again email.');
            }
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
