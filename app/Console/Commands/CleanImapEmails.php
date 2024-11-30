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
        try {
            $this->info('Подключение к почтовому серверу...');
            $client = Client::account('default'); // Используем настройки IMAP из config/imap.php
            $client->connect();

            $this->info('Открытие папки INBOX...');
            $folder = $client->getFolder('INBOX'); // Открываем папку "Входящие"
            $messages = $folder->query()->since(now()->subDays(7))->get(); // Берём письма за последние 7 дней

            $this->info('Обработка писем...');
            foreach ($messages as $message) {
                $subject = $message->getSubject();
                $body = $message->getTextBody();

                // Проверяем, содержит ли письмо ошибку доставки
                if (str_contains($subject, 'Mail delivery failed') || str_contains($body, 'This message was created automatically by mail delivery software')) {
                    $failedEmail = $this->extractEmail($body);

                    if ($failedEmail) {
                        // Обновляем запись в базе данных
                        $updated = DB::table('email_companies')
                            ->where('recipient_email', $failedEmail)
                            ->update(['subscribe' => 2]);

                        if ($updated) {
                            $this->info("БД обновлена: $failedEmail");
                        } else {
                            $this->warn("Email не найден в базе данных: $failedEmail");
                        }

                        // Удаляем письмо с сервера
                        $message->delete();
                        $this->info("Письмо удалено: $subject");
                    } else {
                        $this->warn("Не удалось извлечь email из письма: $subject");
                    }
                }
            }

            $client->expunge(); // Подтверждаем удаление писем
            $this->info('Очистка завершена!');
        } catch (\Exception $e) {
            $this->error('Произошла ошибка: ' . $e->getMessage());
        }
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
