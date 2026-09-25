<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;

    protected $fillable = ['class_id', 'name', 'name_bn', 'capacity', 'order', 'is_active'];
    protected $casts = ['is_active' => 'boolean'];

    public function schoolClass() { return $this->belongsTo(SchoolClass::class, 'class_id'); }
    public function studentAcademics() { return $this->hasMany(StudentAcademic::class); }
}