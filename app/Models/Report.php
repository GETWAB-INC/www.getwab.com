<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Report model
 *
 * Table: reports
 *
 * Columns:
 * - id: primary key (BIGINT UNSIGNED AUTO_INCREMENT)
 * - user_id: user ID (BIGINT UNSIGNED, indexed)
 * - report_id: unique report identifier (VARCHAR(255), NULL, UNIQUE)
 * - report_code: report type code (VARCHAR(255), NOT NULL, UNIQUE, indexed)
 * - title: report title (VARCHAR(255), NOT NULL)
 * - status: report status (VARCHAR(255), NOT NULL, default: 'draft')
 * - created_at: creation timestamp (TIMESTAMP, NULL)
 * - updated_at: update timestamp (TIMESTAMP, NULL)
 */
class Report extends Model
{
    /**
     * The database table associated with the model.
     *
     * @var string
     */
    protected $table = 'reports';

    /**
     * The attributes that are mass assignable.
     *
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
     * The attributes that are NOT mass assignable.
     * An alternative to $fillable (more secure).
     *
     * @var array
     */
    protected $guarded = ['id', 'created_at', 'updated_at'];

    /**
     * Attribute casting definitions.
     *
     * @var array
     */
    protected $casts = [
        'user_id' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Indicates whether the model should manage timestamps (created_at, updated_at).
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * Attributes that should be hidden when the model is serialized to JSON.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * Accessors to append to the model's array and JSON form.
     *
     * @var array
     */
    protected $appends = [];

    /**
     * Relationship: report parameters.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function parameters()
    {
        return $this->hasMany(ReportParameter::class, 'report_id', 'id');
    }

    /**
     * Get report parameters as a formatted string.
     *
     * @return string
     */
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
