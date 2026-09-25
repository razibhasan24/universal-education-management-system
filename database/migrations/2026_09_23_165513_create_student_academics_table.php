<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('student_academics', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained()->onDelete('cascade');
            $table->foreignId('academic_year_id')->constrained()->onDelete('cascade');
            $table->foreignId('class_id')->constrained('classes')->onDelete('restrict');
            $table->foreignId('section_id')->nullable()->constrained('sections')->onDelete('set null');
            $table->string('roll_no', 20)->nullable();
            $table->string('group')->nullable(); // Science, Arts, Commerce
            $table->enum('status', ['active', 'promoted', 'detained', 'passed', 'failed'])->default('active');
            $table->decimal('total_marks', 8, 2)->nullable();
            $table->decimal('gpa', 3, 2)->nullable();
            $table->string('grade', 5)->nullable();
            $table->integer('position')->nullable();
            $table->boolean('is_current')->default(true);
            $table->timestamps();

            $table->unique(['student_id', 'academic_year_id'], 'student_year_unique');
            $table->index(['academic_year_id', 'class_id', 'section_id'], 'academic_class_section_idx');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('student_academics');
    }
};