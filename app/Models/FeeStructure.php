<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FeeStructure extends Model
{
    protected $fillable = [
        'institution_id', 'academic_year_id', 'class_id',
        'fee_category_id', 'group', 'amount', 'due_day', 'is_active',
    ];

    protected $casts = ['is_active' => 'boolean'];

    public function institution() { return $this->belongsTo(Institution::class); }
    public function academicYear() { return $this->belongsTo(AcademicYear::class); }
    public function schoolClass() { return $this->belongsTo(SchoolClass::class, 'class_id'); }
    public function feeCategory() { return $this->belongsTo(FeeCategory::class); }
}