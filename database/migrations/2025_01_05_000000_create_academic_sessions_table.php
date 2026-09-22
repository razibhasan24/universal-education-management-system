<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('academic_sessions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('institution_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->date('start_date');
            $table->date('end_date');
            $table->string('status', 20)->default('active');
            $table->timestamps();

            $table->index(['institution_id', 'status']);
        });

        // Ensure only one active session per institution
        DB::statement("
            CREATE UNIQUE INDEX active_session_per_institution
            ON academic_sessions (institution_id, status)
            WHERE status = 'active'
        ");
    }

    public function down(): void
    {
        Schema::table('academic_sessions', function (Blueprint $table) {
            $table->dropForeign(['institution_id']);
        });
        Schema::dropIfExists('academic_sessions');
    }
};
