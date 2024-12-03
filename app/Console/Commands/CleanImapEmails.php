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
        $this->info("Подключение к почтовому серверу...");
        $client = Client::account('default'); // Используем настройки IMAP из config/imap.php
        $client->connect();

        $this->info("Открытие папки INBOX...");
        $folder = $client->getFolder('INBOX'); // Открываем папку "Входящие"

        $this->info("Обработка писем...");
        $messages = $folder->query()->all()->get(); // Берём все письма

        foreach ($messages as $message) {
            $rawHeaders = $message->getHeader()->raw ?? '';
            $failedRecipient = $this->extractHeaderField($rawHeaders, 'X-Failed-Recipients');

            if ($failedRecipient) {
                // Обновляем запись в базе данных
                // НЕ СТАВИТСЯ 2 НУЖНО ИСПРАВИТЬ!!!
                DB::table('email_companies')
                    ->where('recipient_email', '=', $failedRecipient)
                    ->update(['subscribe' => 2]);

                $this->info("Обновлено в БД: $failedRecipient");

                // Удаляем письмо с сервера
                // $message->delete();
                $this->info("Письмо удалено: {$message->getSubject()}");
            } else {
                $this->info("Не удалось извлечь failed_recipient из письма: {$message->getSubject()}");
            }
        }

        $client->expunge(); // Подтверждаем удаление писем
        $this->info('Очистка завершена!');
    }

    /**
     * Извлекает значение указанного поля из заголовков.
     *
     * @param string $headers
     * @param string $field
     * @return string|null
     */
    private function extractHeaderField($headers, $field)
    {
        if (preg_match('/^' . preg_quote($field, '/') . ': (.+)$/mi', $headers, $matches)) {
            return trim($matches[1]);
        }
        return null;
    }
}
