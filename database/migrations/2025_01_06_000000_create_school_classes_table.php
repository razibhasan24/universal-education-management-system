<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('school_classes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('institution_id')->constrained()->onDelete('cascade');
            $table->foreignId('academic_session_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('code', 50)->nullable();
            $table->unsignedSmallInteger('numeric_order')->default(0);
            $table->string('status', 20)->default('active');
            $table->timestamps();

            $table->unique(['institution_id', 'academic_session_id', 'code'], 'class_code_unique');
            $table->index(['institution_id', 'academic_session_id', 'numeric_order'], 'class_order_idx');
        });
    }

    public function down(): void
    {
        Schema::table('school_classes', function (Blueprint $table) {
            $table->dropForeign(['institution_id']);
            $table->dropForeign(['academic_session_id']);
        });
        Schema::dropIfExists('school_classes');
    }
};
