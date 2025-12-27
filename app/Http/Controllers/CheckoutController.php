<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{
    /**
     * Удаляет элемент из сессии по ключу
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function removeItem(Request $request)
    {
        // Получаем ключ элемента из запроса
        $itemKey = $request->input('item_key');

        // Проверяем, передан ли ключ
        if (empty($itemKey)) {
            return response()->json([
                'success' => false,
                'error' => 'Missing item key'
            ], 400);
        }

        // Проверяем, существует ли элемент в сессии
        if (!Session::has($itemKey)) {
            return response()->json([
                'success' => false,
                'error' => 'Item not found in session'
            ], 404);
        }

        // Удаляем элемент из сессии
        Session::forget($itemKey);

        // Возвращаем успешный ответ
        return response()->json([
            'success' => true,
            'message' => 'Item removed successfully'
        ]);
    }

    public function process(Request $request) {
        dd($request->all());
    }
}
