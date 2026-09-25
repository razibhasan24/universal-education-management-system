<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClassSubject extends Model
{
    protected $fillable = ['class_id', 'subject_id', 'group', 'is_mandatory'];
    protected $casts = ['is_mandatory' => 'boolean'];

    public function schoolClass() { return $this->belongsTo(SchoolClass::class, 'class_id'); }
    public function subject() { return $this->belongsTo(Subject::class); }
}