<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('exam_marks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('exam_id')->constrained()->onDelete('cascade');
            $table->foreignId('student_id')->constrained()->onDelete('cascade');
            $table->foreignId('subject_id')->constrained()->onDelete('cascade');
            $table->decimal('written_marks', 6, 2)->nullable();
            $table->decimal('mcq_marks', 6, 2)->nullable();
            $table->decimal('practical_marks', 6, 2)->nullable();
            $table->decimal('total_marks', 6, 2)->default(0);
            $table->decimal('full_marks', 6, 2)->default(100);
            $table->decimal('pass_marks', 6, 2)->default(33);
            $table->string('grade', 5)->nullable();
            $table->decimal('gpa', 3, 2)->nullable();
            $table->boolean('is_absent')->default(false);
            $table->text('remarks')->nullable();
            $table->foreignId('entered_by')->nullable()->constrained('users');
            $table->timestamps();

            $table->unique(['exam_id', 'student_id', 'subject_id'], 'exam_student_subject_unique');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('exam_marks');
    }
};