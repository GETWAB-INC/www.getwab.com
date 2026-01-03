<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReportParameter extends Model
{
    protected $table = 'report_parameters';

    protected $fillable = [
        'report_id',
        'parameter_key',
        'parameter_value'
    ];

    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected $casts = [
        'report_id' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public $timestamps = true;

}
