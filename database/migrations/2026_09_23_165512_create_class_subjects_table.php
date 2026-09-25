<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('class_subjects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('class_id')->constrained('classes')->onDelete('cascade');
            $table->foreignId('subject_id')->constrained('subjects')->onDelete('cascade');
            $table->string('group')->nullable(); // Science, Arts, Commerce
            $table->boolean('is_mandatory')->default(true);
            $table->timestamps();

            $table->unique(['class_id', 'subject_id', 'group'], 'class_subject_group_unique');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('class_subjects');
    }
};