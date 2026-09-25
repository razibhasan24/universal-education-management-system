<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SchoolClass extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'classes';

    protected $fillable = [
        'institution_id', 'name', 'name_bn', 'numeric_value',
        'level', 'group', 'order', 'is_active',
    ];

    protected $casts = ['is_active' => 'boolean'];

    public function institution() { return $this->belongsTo(Institution::class); }
    public function sections() { return $this->hasMany(Section::class, 'class_id'); }
    public function subjects() { return $this->belongsToMany(Subject::class, 'class_subjects', 'class_id', 'subject_id'); }
    public function classSubjects() { return $this->hasMany(ClassSubject::class, 'class_id'); }
    public function studentAcademics() { return $this->hasMany(StudentAcademic::class, 'class_id'); }
}