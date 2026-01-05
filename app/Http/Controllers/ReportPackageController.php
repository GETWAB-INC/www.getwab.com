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

    private function addPackageToSession($type, $count)
    {
        $prices = $this->getPackagePrices($type);
        if (!isset($prices[$count])) {
            return; // пропускаем, если количество невалидно
        }
        $totalPrice = $prices[$count];
        $orderData = [
            'package_type' => $type,
            'reports_count' => $count,
            'package_price' => $totalPrice,
        ];
        $sessionKey = $type . '_report_package';
        Session::put($sessionKey, $orderData);
    }


    public function orderPackage(Request $request)
    {
        // 1. Получаем входные данные
        $packageType = $request->input('package_type');
        $reportsCount = (int)$request->input('reports_count', 1); // по умолчанию 1

        // 2. Проверяем, является ли пакет комбинированным
        if ($packageType === 'elementary_composite') {
            // Обрабатываем два пакета: elementary и composite
            $this->addPackageToSession('elementary', $reportsCount);
            $this->addPackageToSession('composite', $reportsCount);
        } else {
            // Обычная логика для одиночного пакета
            $prices = $this->getPackagePrices($packageType);
            if (!isset($prices[$reportsCount])) {
                return redirect()->back()->withErrors(['reports_count' => 'Incorrect number of reports']);
            }
            $totalPrice = $prices[$reportsCount];
            $orderData = [
                'package_type' => $packageType,
                'reports_count' => $reportsCount,
                'package_price' => $totalPrice,
            ];
            $sessionKey = $packageType . '_report_package';
            Session::put($sessionKey, $orderData);
        }
        // 3. Перенаправляем на страницу checkout
        return redirect()->route('checkout');
    }
}
