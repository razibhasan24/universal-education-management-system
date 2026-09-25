<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherAttendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'institution_id', 'teacher_id', 'date', 'status',
        'check_in_time', 'check_out_time', 'remarks', 'marked_by',
    ];

    protected $casts = ['date' => 'date'];

    public function teacher() { return $this->belongsTo(Teacher::class); }
    public function markedBy() { return $this->belongsTo(User::class, 'marked_by'); }
}