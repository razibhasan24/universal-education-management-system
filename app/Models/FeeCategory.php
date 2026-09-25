<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FeeCategory extends Model
{
    protected $fillable = ['institution_id', 'name', 'name_bn', 'code', 'frequency', 'is_refundable', 'is_active'];
    protected $casts = ['is_refundable' => 'boolean', 'is_active' => 'boolean'];

    public function feeStructures() { return $this->hasMany(FeeStructure::class); }
    public function payments() { return $this->hasMany(FeePayment::class); }
}