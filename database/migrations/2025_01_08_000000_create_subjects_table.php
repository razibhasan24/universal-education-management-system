<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('subjects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('institution_id')->constrained()->onDelete('cascade');
            $table->foreignId('class_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('code', 50)->nullable();
            $table->unsignedSmallInteger('full_marks')->default(100);
            $table->unsignedSmallInteger('pass_marks')->default(33);
            $table->string('subject_type', 20)->default('compulsory');
            $table->string('status', 20)->default('active');
            $table->timestamps();

            $table->unique(['class_id', 'code'], 'subject_code_unique');
            $table->index(['institution_id', 'class_id', 'subject_type']);
        });
    }

    public function down(): void
    {
        Schema::table('subjects', function (Blueprint $table) {
            $table->dropForeign(['institution_id']);
            $table->dropForeign(['class_id']);
        });
        Schema::dropIfExists('subjects');
    }
};
