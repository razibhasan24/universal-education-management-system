<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('institution_id')->nullable()->after('id')
                  ->constrained()->onDelete('set null');
            $table->string('phone', 20)->nullable()->after('email');
            $table->string('photo')->nullable()->after('phone');
            $table->enum('user_type', ['admin', 'teacher', 'student', 'parent', 'staff', 'accountant'])
                  ->default('student')->after('photo');
            $table->enum('status', ['active', 'inactive', 'suspended'])
                  ->default('active')->after('user_type');
            $table->timestamp('last_login_at')->nullable()->after('status');
            $table->string('last_login_ip', 45)->nullable()->after('last_login_at');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['institution_id']);
            $table->dropColumn([
                'institution_id', 'phone', 'photo', 'user_type',
                'status', 'last_login_at', 'last_login_ip'
            ]);
        });
    }
};