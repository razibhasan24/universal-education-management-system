<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('exams', function (Blueprint $table) {
            $table->id();
            $table->foreignId('institution_id')->constrained()->onDelete('cascade');
            $table->foreignId('academic_year_id')->constrained()->onDelete('cascade');
            $table->foreignId('exam_type_id')->constrained('exam_types')->onDelete('restrict');
            $table->foreignId('class_id')->constrained('classes')->onDelete('cascade');
            $table->string('name'); // Half Yearly 2025
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->enum('status', ['upcoming', 'ongoing', 'completed', 'published', 'cancelled'])->default('upcoming');
            $table->text('description')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users');
            $table->timestamps();
            $table->softDeletes();

            $table->index(['institution_id', 'academic_year_id', 'status'], 'exam_status_idx');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('exams');
    }
};