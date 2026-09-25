<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcademicYear extends Model
{
    use HasFactory;

    protected $fillable = ['institution_id', 'name', 'start_date', 'end_date', 'is_current', 'is_closed'];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'is_current' => 'boolean',
        'is_closed' => 'boolean',
    ];

    public function institution() { return $this->belongsTo(Institution::class); }
    public function studentAcademics() { return $this->hasMany(StudentAcademic::class); }
    public function feeStructures() { return $this->hasMany(FeeStructure::class); }
}