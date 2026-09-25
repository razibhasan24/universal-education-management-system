<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('notices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('institution_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->string('title_bn')->nullable();
            $table->longText('content');
            $table->longText('content_bn')->nullable();
            $table->string('attachment')->nullable();
            $table->enum('audience', ['all', 'students', 'teachers', 'parents', 'staff', 'specific_class'])
                  ->default('all');
            $table->foreignId('class_id')->nullable()->constrained('classes')->onDelete('set null');
            $table->date('publish_date');
            $table->date('expire_date')->nullable();
            $table->boolean('is_published')->default(false);
            $table->boolean('is_pinned')->default(false);
            $table->foreignId('created_by')->nullable()->constrained('users');
            $table->timestamps();
            $table->softDeletes();

            $table->index(['institution_id', 'is_published', 'publish_date'], 'notice_publish_idx');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('notices');
    }
};