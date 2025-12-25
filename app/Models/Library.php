<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Library extends Model
{
    /**
     * Укажите имя таблицы, связанной с моделью.
     *
     * @var string
     */
    protected $table = 'library';

    /**
     * Укажите, следует ли модели автоматически управлять временными метками.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * Атрибуты, которые можно массово заполнять.
     *
     * @var array
     */
    protected $fillable = [
        'report_code',
        'report_type',
        'report_category',
        'report_title',
        'report_description',
        'report_methodology',
        'report_usage',
        'vars',
        'unit',
        'price',
    ];

    /**
     * Атрибуты, которые должны быть приведены к определённому типу.
     *
     * @var array
     */
    protected $casts = [
        'price' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Укажите первичный ключ модели.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Определите, является ли первичный ключ автоинкрементным.
     *
     * @var bool
     */
    public $incrementing = true;

    /**
     * Тип первичного ключа.
     *
     * @var string
     */
    protected $keyType = 'int';
}
