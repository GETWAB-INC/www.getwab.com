<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{
    public function showCheckout()
    {
        // Получаем данные из сессии
        $checkoutData = Session::get('checkout_report');

        if (!$checkoutData) {
            abort(404, 'Данные заказа не найдены в сессии');
        }

        // Формируем список товаров
        $items = $this->buildOrderItems($checkoutData);


        // Рассчитываем суммы
        $subtotal = array_sum(array_column($items, 'price'));
        $tax = round($subtotal * 0.085, 2); // 8.5% налог
        $total = $subtotal + $tax;

        return view('checkout', compact('items', 'subtotal', 'tax', 'total'));
    }

    private function buildOrderItems($data)
    {
        $items = [];

        switch ($data['report_type']) {
            case 'EL':
                $items[] = [
                    'name' => 'Экологический отчёт (GEO-EL)',
                    'type' => 'Отчёт',
                    'frequency' => 'Однократно',
                    'price' => 149.00,
                    'code' => $data['report_code']
                ];
                break;

            case 'GEO':
                $items[] = [
                    'name' => 'Геопространственный анализ',
                    'type' => 'Подписка',
                    'frequency' => 'Ежемесячно',
                    'price' => 199.00,
                    'code' => $data['report_code']
                ];
                break;

            case 'FPDS':
                $items[] = [
                    'name' => 'FPDS Query',
                    'type' => 'Подписка',
                    'frequency' => 'Ежемесячно',
                    'price' => 199.00,
                    'code' => $data['report_code']
                ];
                $items[] = [
                    'name' => 'FPDS Reports',
                    'type' => 'Подписка',
                    'frequency' => 'Годово',
                    'price' => 499.00,
                    'code' => $data['report_code']
                ];
                $items[] = [
                    'name' => 'FPDS Charts',
                    'type' => 'Подписка',
                    'frequency' => 'Годово',
                    'price' => 299.00,
                    'code' => $data['report_code']
                ];
                break;

            default:
                $items[] = [
                    'name' => 'Базовый отчёт',
                    'type' => 'Отчёт',
                    'frequency' => 'Однократно',
                    'price' => 99.00,
                    'code' => $data['report_code']
                ];
        }

        return $items;
    }
}
