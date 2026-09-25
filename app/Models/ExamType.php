<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExamType extends Model
{
    protected $fillable = ['institution_id', 'name', 'name_bn', 'weight_percentage', 'order', 'is_active'];
    protected $casts = ['is_active' => 'boolean'];

    public function exams() { return $this->hasMany(Exam::class); }
}