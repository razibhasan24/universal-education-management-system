<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sections', function (Blueprint $table) {
            $table->id();
            $table->foreignId('institution_id')->constrained()->onDelete('cascade');
            $table->foreignId('class_id')->constrained('school_classes')->onDelete('cascade');
            $table->string('name');
            $table->unsignedSmallInteger('capacity')->default(0);
            $table->string('status', 20)->default('active');
            $table->timestamps();

            $table->unique(['class_id', 'name'], 'section_name_unique');
            $table->index(['institution_id', 'class_id']);
        });
    }

    public function down(): void
    {
        Schema::table('sections', function (Blueprint $table) {
            $table->dropForeign(['institution_id']);
            $table->dropForeign(['class_id']);
        });
        Schema::dropIfExists('sections');
    }
};
