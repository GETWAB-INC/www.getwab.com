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
            $body = $message->getTextBody() ?? '';

            // Сначала ищем стандартный заголовок X-Failed-Recipients
            $failedRecipient = $this->extractHeaderField($rawHeaders, 'X-Failed-Recipients');

            // Если заголовок отсутствует, ищем в теле письма
            if (!$failedRecipient) {
                $failedRecipient = $this->extractFromBodyPatterns($body);
            }

            if ($failedRecipient) {
                // Обновляем запись в базе данных
                DB::table('email_companies')
                    ->where('recipient_email', '=', $failedRecipient)
                    ->update(['subscribe' => 2]);

                $this->info("Обновлено в БД: $failedRecipient");

                // Удаляем письмо с сервера
                $message->delete();
                $this->info("Письмо удалено: {$message->getSubject()}");
            } else {
                $this->info("Не удалось извлечь email из письма: {$message->getSubject()}");
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

/**
 * Проверяет тело письма по различным паттернам для извлечения email.
 *
 * @param string $body
 * @return string|null
 */
private function extractFromBodyPatterns($body)
{
    $patterns = [
        // Паттерн 1: для писем с фразой "The address to which the message has not yet been delivered is:"
        '/The address to which the message has not yet been delivered is:\s+([^\s]+)/i',

        // Паттерн 2: Для сообщений от Microsoft с текстом "Your message to ... couldn't be delivered."
        '/Your message to ([^\s]+) couldn\'t be delivered\./i',

        // Паттерн 3: Для других типов сообщений (SMTP error)
        '/SMTP error from remote mail server after RCPT TO:<([^>]+)>/i',

        // Добавьте дополнительные паттерны при необходимости
    ];

    foreach ($patterns as $pattern) {
        if (preg_match($pattern, $body, $matches)) {
            return trim($matches[1]);
        }
    }

    return null;
}
}
