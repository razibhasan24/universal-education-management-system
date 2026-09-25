<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Super Admin
        $superAdmin = User::create([
            'institution_id' => 1,
            'name' => 'Super Admin',
            'email' => 'superadmin@school.com',
            'password' => Hash::make('password'),
            'phone' => '01711111111',
            'user_type' => 'admin',
            'status' => 'active',
        ]);
        $superAdmin->assignRole('super-admin');

        // Admin / Principal
        $admin = User::create([
            'institution_id' => 1,
            'name' => 'Md. Abdul Karim',
            'email' => 'admin@school.com',
            'password' => Hash::make('password'),
            'phone' => '01711111112',
            'user_type' => 'admin',
            'status' => 'active',
        ]);
        $admin->assignRole('admin');

        // Accountant
        $accountant = User::create([
            'institution_id' => 1,
            'name' => 'Md. Rahmat Ali',
            'email' => 'accountant@school.com',
            'password' => Hash::make('password'),
            'phone' => '01711111113',
            'user_type' => 'accountant',
            'status' => 'active',
        ]);
        $accountant->assignRole('accountant');

        // Teacher
        $teacher = User::create([
            'institution_id' => 1,
            'name' => 'Mrs. Fatema Begum',
            'email' => 'teacher@school.com',
            'password' => Hash::make('password'),
            'phone' => '01711111114',
            'user_type' => 'teacher',
            'status' => 'active',
        ]);
        $teacher->assignRole('teacher');

        // Student
        $student = User::create([
            'institution_id' => 1,
            'name' => 'Rahim Uddin',
            'email' => 'student@school.com',
            'password' => Hash::make('password'),
            'phone' => '01711111115',
            'user_type' => 'student',
            'status' => 'active',
        ]);
        $student->assignRole('student');

        $this->command->info('✅ 5 Demo Users created!');
        $this->command->info('   Email: superadmin@school.com | Password: password');
        $this->command->info('   Email: admin@school.com      | Password: password');
        $this->command->info('   Email: accountant@school.com | Password: password');
        $this->command->info('   Email: teacher@school.com    | Password: password');
        $this->command->info('   Email: student@school.com    | Password: password');
    }
}