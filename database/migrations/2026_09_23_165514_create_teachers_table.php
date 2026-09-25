<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('institution_id')->constrained()->onDelete('cascade');
            $table->string('employee_id', 30)->unique(); // EMP-2025-0001
            $table->string('name_bn');
            $table->string('name_en')->nullable();
            $table->enum('gender', ['male', 'female', 'other']);
            $table->date('dob');
            $table->string('religion')->nullable();
            $table->string('blood_group', 5)->nullable();
            $table->string('nid', 20)->nullable();
            $table->string('phone', 20);
            $table->string('phone_alt', 20)->nullable();
            $table->string('email')->nullable();
            $table->string('designation'); // Headmaster, Assistant Teacher
            $table->string('department')->nullable();
            $table->string('qualification'); // MA, BEd
            $table->text('specialization')->nullable();
            $table->decimal('salary', 10, 2)->nullable();
            $table->date('joining_date');
            $table->enum('employment_type', ['permanent', 'contract', 'part_time', 'guest'])->default('permanent');
            $table->text('present_address')->nullable();
            $table->text('permanent_address')->nullable();
            $table->string('photo')->nullable();
            $table->string('signature')->nullable();
            $table->enum('status', ['active', 'inactive', 'resigned', 'retired', 'terminated'])->default('active');
            $table->timestamps();
            $table->softDeletes();

            $table->index(['institution_id', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('teachers');
    }
};