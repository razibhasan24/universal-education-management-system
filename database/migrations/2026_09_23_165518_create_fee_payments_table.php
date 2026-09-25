<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('fee_payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('institution_id')->constrained()->onDelete('cascade');
            $table->foreignId('academic_year_id')->constrained()->onDelete('cascade');
            $table->foreignId('student_id')->constrained()->onDelete('cascade');
            $table->foreignId('fee_category_id')->constrained('fee_categories')->onDelete('restrict');
            $table->string('receipt_no', 30)->unique();
            $table->date('payment_date');
            $table->string('month', 20)->nullable(); // January-2025
            $table->decimal('amount', 10, 2);
            $table->decimal('discount', 10, 2)->default(0);
            $table->decimal('fine', 10, 2)->default(0);
            $table->decimal('total_paid', 10, 2);
            $table->decimal('due_amount', 10, 2)->default(0);
            $table->enum('payment_method', ['cash', 'bank', 'bkash', 'nagad', 'rocket', 'cheque', 'online'])->default('cash');
            $table->string('transaction_id')->nullable();
            $table->string('cheque_no')->nullable();
            $table->text('remarks')->nullable();
            $table->foreignId('collected_by')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamps();

            $table->index(['institution_id', 'payment_date']);
            $table->index(['student_id', 'academic_year_id'], 'student_year_fee_idx');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('fee_payments');
    }
};