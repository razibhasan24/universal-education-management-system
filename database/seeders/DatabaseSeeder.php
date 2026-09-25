<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            RolePermissionSeeder::class,   // প্রথমে Role & Permission
            InstitutionSeeder::class,       // তারপর Institution
            AcademicYearSeeder::class,
            ClassSeeder::class,
            SubjectSeeder::class,
            ExamTypeSeeder::class,
            FeeCategorySeeder::class,
            UserSeeder::class,              // Institution এর পরে User
            SettingSeeder::class,
        ]);
    }
}