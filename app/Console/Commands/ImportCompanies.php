<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\CompaniesImport;  // Создадим этот класс ниже

class ImportCompanies extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:companies';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import companies from an Excel file into the database';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // Путь к вашему Excel файлу
        $filePath = storage_path('app/2024_10_09_03_24_00.xlsx');

        // Импорт данных из Excel
        Excel::import(new CompaniesImport, $filePath);

        $this->info('Companies have been imported successfully.');
        return 0;
    }
}
