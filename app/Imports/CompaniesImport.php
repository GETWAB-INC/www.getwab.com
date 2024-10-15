<?php

namespace App\Imports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Collection;
use Carbon\Carbon;

class CompaniesImport implements ToCollection, WithHeadingRow
{
    /**
     * @param Collection $rows
     */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            // Преобразование дат в нужный формат
            $contractStartDate = $this->formatDate($row['current_option_period_end_date']);
            $contractEndDate = $this->formatDate($row['ultimate_contract_end_date']);

            // Проверяем наличие email, чтобы не вставлять пустые значения
            if (isset($row['email']) && !empty($row['email'])) {
                DB::table('email_companies')->insert([
                    'recipient_name' => null,  // Если нет значения, используем 'Unknown'
                    'recipient_email' => $row['email'],  // Используем email
                    'company_name' => $row['vendor'] ?? 'Unknown',  // Название компании
                    'contract_id' => $row['sam_uei'] ?? null,  // Идентификатор контракта
                    'contract_topic' => $row['category'] ?? null,  // Тема контракта
                    'contract_description' => null,  // Описание
                    'additional_details' => $row['socio_economic_indicators_only_relative_codes_will_appear_for_a_contract'] ?? null,  // Дополнительные детали
                    'contract_start_date' => $contractStartDate,  // Преобразованная дата
                    'contract_end_date' => $contractEndDate,  // Преобразованная дата
                    'subscribe' => 0,  // По умолчанию 0
                    'hello_email' => null,
                    'hello_email_again' => null,
                    'last_email_at' => null,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
            }
        }
    }

    /**
     * Метод для преобразования даты в формат Y-m-d
     */
    private function formatDate($dateString)
    {
        try {
            // Преобразование в формат Y-m-d
            return Carbon::parse($dateString)->format('Y-m-d');
        } catch (\Exception $e) {
            // Если формат даты некорректный, возвращаем null
            return null;
        }
    }
}
