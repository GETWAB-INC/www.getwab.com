<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Webklex\IMAP\Facades\Client;
use Illuminate\Support\Facades\DB;

class CleanImapEmails extends Command
{
    protected $signature = 'mail:clean-imap-emails';
    protected $description = 'Удаляет письма с ошибкой доставки и обновляет базу данных';

    public function handle()
    {
        $client = Client::account('default'); // Используем настройки IMAP из config/imap.php
        $client->connect();

        $folder = $client->getFolder('INBOX'); // Открываем папку "Входящие"
        $messages = $folder->query()->since(now()->subDays(7))->get(); // Берём письма за последние 7 дней

        foreach ($messages as $message) {
            $subject = $message->getSubject();

            // Ищем письма с ошибками доставки
            if (str_contains($subject, 'Mail delivery failed')) {
                $body = $message->getTextBody();
                $failedEmail = $this->extractEmail($body);

                if ($failedEmail) {
                    // Обновляем запись в базе данных
                    DB::table('email_companies')
                        ->where('recipient_email', $failedEmail)
                        ->update(['subscribe' => 2]);

                    $this->info("Обновлено в БД: $failedEmail");

                    // Удаляем письмо с сервера
                    $message->delete();
                    $this->info("Письмо удалено: $subject");
                }
            }
        }

        $client->expunge(); // Подтверждаем удаление писем
        $this->info('Очистка завершена!');
    }

    /**
     * Извлечение email из текста письма.
     *
     * @param string $body
     * @return string|null
     */
    private function extractEmail(string $body): ?string
    {
        if (preg_match('/Final-Recipient: rfc822;(.*?@[\w.]+)/', $body, $matches)) {
            return trim($matches[1]);
        }

        return null;
    }
}
