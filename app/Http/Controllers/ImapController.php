<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Webklex\IMAP\Facades\Client;

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
                $emailList[] = [
                    'subject' => $message->getSubject(),
                    'from' => $message->getFrom(),
                    'date' => $message->getDate(),
                    'text' => $message->getTextBody(),
                ];
            }

            return response()->json($emailList);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
