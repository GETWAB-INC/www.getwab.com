<?php

namespace App\Http\Controllers;

use Webklex\IMAP\Facades\Client;
use Illuminate\Support\Facades\DB;

class ImapController extends Controller
{
    public function fetchEmails()
    {
        try {
            // Подключаемся к IMAP
            $client = Client::account('default');
            $client->connect();

            // Открываем папку INBOX
            $folder = $client->getFolder('INBOX');

            // Получаем письма
            $messages = $folder->query()->all()->get();

            $emailList = [];

            foreach ($messages as $message) {
                $rawHeaders = $message->getHeader()->raw ?? ''; // Получаем сырые заголовки
                $failedRecipient = $this->extractHeaderField($rawHeaders, 'X-Failed-Recipients');

                if ($failedRecipient) {
                    // Обновляем запись в базе данных
                    DB::table('email_companies')
                        ->where('recipient_email', $failedRecipient)
                        ->update(['subscribe' => 2]);

                    // Удаляем письмо из почтового ящика
                    $message->delete();
                }

                // Добавляем данные письма в массив
                $emailList[] = [
                    'from' => $this->extractHeaderField($rawHeaders, 'From'),
                    'to' => $this->extractHeaderField($rawHeaders, 'To'),
                    'subject' => $this->extractHeaderField($rawHeaders, 'Subject'),
                    'failed_recipient' => $failedRecipient,
                    'date' => $this->extractHeaderField($rawHeaders, 'Date'),
                    'text' => $message->getTextBody() ?? 'No Text Content',
                ];
            }

            return response()->json($emailList, 200, [], JSON_PRETTY_PRINT);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
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
