<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExamMark extends Model
{
    protected $fillable = [
        'exam_id', 'student_id', 'subject_id',
        'written_marks', 'mcq_marks', 'practical_marks',
        'total_marks', 'full_marks', 'pass_marks',
        'grade', 'gpa', 'is_absent', 'remarks', 'entered_by',
    ];

    protected $casts = ['is_absent' => 'boolean'];

    public function exam() { return $this->belongsTo(Exam::class); }
    public function student() { return $this->belongsTo(Student::class); }
    public function subject() { return $this->belongsTo(Subject::class); }
}