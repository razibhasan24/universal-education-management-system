<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Exam extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'institution_id', 'academic_year_id', 'exam_type_id', 'class_id',
        'name', 'start_date', 'end_date', 'status', 'description', 'created_by',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    public function institution() { return $this->belongsTo(Institution::class); }
    public function academicYear() { return $this->belongsTo(AcademicYear::class); }
    public function examType() { return $this->belongsTo(ExamType::class); }
    public function schoolClass() { return $this->belongsTo(SchoolClass::class, 'class_id'); }
    public function marks() { return $this->hasMany(ExamMark::class); }
}