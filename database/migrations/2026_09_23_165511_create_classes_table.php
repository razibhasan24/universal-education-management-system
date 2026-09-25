<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('classes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('institution_id')->constrained()->onDelete('cascade');
            $table->string('name'); // Class One, HSC, Dakhil
            $table->string('name_bn')->nullable(); // প্রথম শ্রেণি
            $table->integer('numeric_value')->default(0); // sorting এর জন্য
            $table->enum('level', ['primary', 'secondary', 'higher_secondary'])->nullable();
            $table->string('group')->nullable(); // Science, Arts, Commerce
            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();

            $table->unique(['institution_id', 'name']);
            $table->index(['institution_id', 'is_active']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('classes');
    }
};