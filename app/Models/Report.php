<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Модель отчёта
 *
 * Таблица: reports
 *
 * Поля:
 * - id: первичный ключ (BIGINT UNSIGNED AUTO_INCREMENT)
 * - user_id: ID пользователя (BIGINT UNSIGNED, индекс)
 * - report_id: уникальный идентификатор отчёта (VARCHAR(255), NULL, UNIQUE)
 * - report_code: код типа отчёта (VARCHAR(255), NOT NULL, UNIQUE, индекс)
 * - title: название отчёта (VARCHAR(255), NOT NULL)
 * - status: статус отчёта (VARCHAR(255), NOT NULL, по умолчанию 'draft')
 * - created_at: дата создания (TIMESTAMP, NULL)
 * - updated_at: дата обновления (TIMESTAMP, NULL)
 */
class Report extends Model
{
    /**
     * Имя таблицы в БД
     * @var string
     */
    protected $table = 'reports';

    /**
     * Поля, доступные для массового присваивания
     * @var array
     */
    protected $fillable = [
        'user_id',
        'report_code',
        'title',
        'status',
        'report_id',
    ];

    /**
     * Поля, которые НЕЛЬЗЯ массово присваивать
     * (альтернатива $fillable — более безопасно)
     * @var array
     */
    protected $guarded = ['id', 'created_at', 'updated_at'];

    /**
     * Типы данных для атрибутов
     * @var array
     */
    protected $casts = [
        'user_id' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Указывает, что модель использует временные метки (created_at, updated_at)
     * @var bool
     */
    public $timestamps = true;

    /**
     * Атрибуты, которые должны быть скрыты при сериализации в JSON
     * @var array
     */
    protected $hidden = [];

    /**
     * Атрибуты, которые всегда должны быть в массиве при сериализации
     * @var array
     */
    protected $appends = [];

    public function parameters()
    {
        return $this->hasMany(ReportParameter::class, 'report_id', 'id');
    }

    public function getParametersString()
    {
        if ($this->parameters->isEmpty()) {
            return '';
        }

        $pairs = [];
        foreach ($this->parameters as $param) {
            $pairs[] = "{$param->parameter_key}: {$param->parameter_value}";
        }
        return implode(', ', $pairs);
    }
}