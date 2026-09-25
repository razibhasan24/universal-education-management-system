<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Notice extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'institution_id', 'title', 'title_bn', 'content', 'content_bn',
        'attachment', 'audience', 'class_id', 'publish_date', 'expire_date',
        'is_published', 'is_pinned', 'created_by',
    ];

    protected $casts = [
        'publish_date' => 'date',
        'expire_date' => 'date',
        'is_published' => 'boolean',
        'is_pinned' => 'boolean',
    ];

    public function institution() { return $this->belongsTo(Institution::class); }
    public function schoolClass() { return $this->belongsTo(SchoolClass::class, 'class_id'); }
    public function createdBy() { return $this->belongsTo(User::class, 'created_by'); }
}