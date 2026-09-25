<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('institution_id')->constrained()->onDelete('cascade');
            $table->string('student_id', 30)->unique(); // STD-2025-00001
            $table->string('name_bn');
            $table->string('name_en')->nullable();
            $table->enum('gender', ['male', 'female', 'other']);
            $table->date('dob');
            $table->string('birth_certificate_no', 30)->nullable();
            $table->string('religion')->nullable();
            $table->string('blood_group', 5)->nullable();
            $table->string('nationality')->default('Bangladeshi');
            $table->string('father_name');
            $table->string('father_occupation')->nullable();
            $table->string('father_nid', 20)->nullable();
            $table->string('father_phone', 20)->nullable();
            $table->string('mother_name');
            $table->string('mother_occupation')->nullable();
            $table->string('mother_nid', 20)->nullable();
            $table->string('mother_phone', 20)->nullable();
            $table->string('guardian_name')->nullable();
            $table->string('guardian_relation')->nullable();
            $table->string('guardian_phone', 20)->nullable();
            $table->string('guardian_occupation')->nullable();
            $table->text('present_address')->nullable();
            $table->text('permanent_address')->nullable();
            $table->string('photo')->nullable();
            $table->string('signature')->nullable();
            $table->date('admission_date');
            $table->enum('status', ['active', 'inactive', 'transferred', 'graduated', 'dropped'])->default('active');
            $table->timestamps();
            $table->softDeletes();

            $table->index(['institution_id', 'status']);
            $table->index('student_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};