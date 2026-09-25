<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentAttendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'institution_id', 'student_id', 'academic_year_id', 'class_id',
        'section_id', 'date', 'status', 'check_in_time', 'check_out_time',
        'remarks', 'marked_by',
    ];

    protected $casts = ['date' => 'date'];

    public function student() { return $this->belongsTo(Student::class); }
    public function schoolClass() { return $this->belongsTo(SchoolClass::class, 'class_id'); }
    public function section() { return $this->belongsTo(Section::class); }
    public function markedBy() { return $this->belongsTo(User::class, 'marked_by'); }
}