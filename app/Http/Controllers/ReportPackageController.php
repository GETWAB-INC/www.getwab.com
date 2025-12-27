<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ReportPackageController extends Controller
{

    private function getPackagePrices(string $packageType): array
    {
        return match ($packageType) {
            'elementary' => [
                1 => 49.00,
                5 => 220.00,
                10 => 400.00,
                25 => 900.00,
                50 => 1600.00,
                75 => 2250.00,
                100 => 2800.00,
            ],
            'composite' => [
                1 => 149.00,
                5 => 670.00,
                10 => 1200.00,
                25 => 2700.00,
                50 => 4800.00,
                75 => 6750.00,
                100 => 8400.00,
            ],
            default => [],
        };
    }
    public function orderPackage(Request $request)
    {
        // 1. Получаем входные данные
        $packageType = $request->input('package_type');
        $reportsCount = (int)$request->input('reports_count');


        // 2. Получаем цены для типа пакета
        $prices = $this->getPackagePrices($packageType); // или self::PACKAGE_PRICES[$packageType]

        // 3. Проверяем валидность количества отчётов
        if (!isset($prices[$reportsCount])) {
            return redirect()->back()->withErrors(['reports_count' => 'Incorrect number of reports']);
        }

        // 4. Рассчитываем итоговую сумму
        $totalPrice = $prices[$reportsCount];

        // 5. Формируем данные для сессии
        $orderData = [
            'package_type' => $packageType,
            'reports_count' => $reportsCount,
            'package_price' => $totalPrice,
        ];

        // 6. Сохраняем в сессию под ключом, зависящим от типа пакета
        $sessionKey = $packageType . '_report_package';
        Session::put($sessionKey, $orderData);

        // 7. Перенаправляем на страницу checkout
        return redirect()->route('checkout');
    }

}
