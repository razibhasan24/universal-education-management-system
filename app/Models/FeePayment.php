<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FeePayment extends Model
{
    protected $fillable = [
        'institution_id', 'academic_year_id', 'student_id', 'fee_category_id',
        'receipt_no', 'payment_date', 'month', 'amount', 'discount',
        'fine', 'total_paid', 'due_amount', 'payment_method',
        'transaction_id', 'cheque_no', 'remarks', 'collected_by',
    ];

    protected $casts = ['payment_date' => 'date'];

    public function student() { return $this->belongsTo(Student::class); }
    public function feeCategory() { return $this->belongsTo(FeeCategory::class); }
    public function collector() { return $this->belongsTo(User::class, 'collected_by'); }

    public static function generateReceiptNo($institutionId)
    {
        $year = now()->year;
        $prefix = "RCP-{$year}-";
        $last = static::where('institution_id', $institutionId)
            ->where('receipt_no', 'like', $prefix . '%')
            ->orderBy('id', 'desc')
            ->first();

        $number = $last ? ((int) substr($last->receipt_no, -5)) + 1 : 1;
        return $prefix . str_pad($number, 5, '0', STR_PAD_LEFT);
    }
}