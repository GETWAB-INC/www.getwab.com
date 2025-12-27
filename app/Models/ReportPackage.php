<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportPackage extends Model
{
    use HasFactory;

    // Явно указываем имя таблицы в БД
    protected $table = 'report_packages';

    // Первичный ключ (по умолчанию 'id', но для ясности)
    protected $primaryKey = 'id';

    // Отключаем авто-управление timestamps, если нужно ручное управление
    // public $timestamps = false;

    // Разрешённые для массового заполнения поля
    protected $fillable = [
        'user_id',
        'package_type',
        'remaining_reports',
        // При необходимости можно добавить 'created_at', 'updated_at'
    ];

    // Поля, которые НЕ будут включены в массив/JSON при выводе
    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    // Типы данных для корректной работы с БД и API
    protected $casts = [
        'id'                  => 'integer',
        'user_id'           => 'integer',
        'package_type'      => 'string',
        'remaining_reports' => 'integer',
        'created_at'        => 'datetime',
        'updated_at'        => 'datetime',
    ];

    /**
     * Связь с пакетами отчётов (один пользователь — много пакетов)
     */
    public function reportPackages()
    {
        return $this->hasMany(ReportPackage::class, 'user_id', 'id');
    }

    // Можно добавить мутаторы для дополнительной обработки (опционально)
    // protected function createdAt(): Attribute { ... }
}
