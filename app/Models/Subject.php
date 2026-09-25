<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subject extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'institution_id', 'name', 'name_bn', 'code', 'type',
        'is_optional', 'full_marks', 'pass_marks', 'credit_hours',
        'description', 'is_active',
    ];

    protected $casts = [
        'is_optional' => 'boolean',
        'is_active' => 'boolean',
    ];

    public function institution() { return $this->belongsTo(Institution::class); }
    public function classes() { return $this->belongsToMany(SchoolClass::class, 'class_subjects', 'subject_id', 'class_id'); }
    public function examMarks() { return $this->hasMany(ExamMark::class); }
}