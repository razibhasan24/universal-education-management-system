<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('institutions', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('name_bn')->nullable();
            $table->enum('type', ['school', 'college', 'madrasa', 'coaching', 'training']);
            $table->enum('medium', ['bangla', 'english', 'madrasa', 'mixed']);
            $table->enum('level', ['primary', 'secondary', 'higher_secondary', 'graduation'])->nullable();
            $table->string('eiin', 20)->nullable()->unique(); // Bangladesh Education Board Code
            $table->string('registration_no', 50)->nullable();
            $table->string('logo')->nullable();
            $table->string('favicon')->nullable();
            $table->string('phone', 20)->nullable();
            $table->string('phone_alt', 20)->nullable();
            $table->string('email')->nullable();
            $table->string('website')->nullable();
            $table->text('address')->nullable();
            $table->string('city')->nullable();
            $table->string('district')->nullable();
            $table->string('division')->nullable();
            $table->string('postal_code', 10)->nullable();
            $table->string('principal_name')->nullable();
            $table->string('principal_phone', 20)->nullable();
            $table->date('established_date')->nullable();
            $table->string('motto')->nullable();
            $table->json('social_links')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();

            $table->index(['type', 'is_active']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('institutions');
    }
};