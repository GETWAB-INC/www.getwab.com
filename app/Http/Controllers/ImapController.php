<?php

namespace App\Http\Controllers;

use Webklex\IMAP\Facades\Client;

class ImapController extends Controller
{
    public function fetchEmails()
{
    try {
        $client = Client::account('default');
        $client->connect();

        $folder = $client->getFolder('INBOX');

        $messages = $folder->query()->all()->get();

        $emailList = [];

        foreach ($messages as $message) {
            $rawHeaders = $message->getHeader()->raw ?? '';
            $emailList[] = [
                'from' => $this->extractHeaderField($rawHeaders, 'From'),
                'to' => $this->extractHeaderField($rawHeaders, 'To'),
                'subject' => $this->extractHeaderField($rawHeaders, 'Subject'),
                'failed_recipient' => $this->extractHeaderField($rawHeaders, 'X-Failed-Recipients'),
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
* Извлекает указанное значение поля из заголовков. 
* 
* @param строка $headers 
* @param строка $поле 
* @return string|ноль 
*/
private function extractHeaderField($headers, $field)
{
    if (preg_match('/^' . preg_quote($field, '/') . ': (.+)$/mi', $headers, $matches)) {
        return trim($matches[1]);
    }
    return null;
}
}
