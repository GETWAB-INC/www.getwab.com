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
                'headers' => $message->getRawHeaders(), // Получаем сырые заголовки письма
                'subject' => $message->getSubject(),   // Тема
                'from' => $message->getFrom(),         // От кого
                'to' => $message->getTo(),             // Кому
                'date' => $message->getDate(),         // Дата
                'text' => $message->getTextBody(),     // Текстовое тело
                'html' => $message->getHTMLBody(),     // HTML тело
                'attachments' => $message->getAttachments() // Вложения
            ];
        }

        return response()->json($emailList, 200, [], JSON_PRETTY_PRINT);
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
}
}
