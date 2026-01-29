<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportPackage extends Model
{
    use HasFactory;

    // Explicitly specify the database table name
    protected $table = 'report_packages';

    // Primary key (default is 'id', specified here for clarity)
    protected $primaryKey = 'id';

    // Disable automatic timestamp management if manual handling is required
    // public $timestamps = false;

    // Mass-assignable attributes
    protected $fillable = [
        'user_id',
        'package_type',
        'remaining_reports',
        // 'created_at', 'updated_at' can be added if needed
    ];

    // Attributes that should be hidden when converting to array/JSON
    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    // Attribute casting for proper database and API handling
    protected $casts = [
        'id'                => 'integer',
        'user_id'           => 'integer',
        'package_type'      => 'string',
        'remaining_reports' => 'integer',
        'created_at'        => 'datetime',
        'updated_at'        => 'datetime',
    ];

    /**
     * Relationship: a user can have multiple report packages.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function reportPackages()
    {
        return $this->hasMany(ReportPackage::class, 'user_id', 'id');
    }

    // Optional: mutators/accessors can be added for additional processing
    // protected function createdAt(): Attribute { ... }
}
