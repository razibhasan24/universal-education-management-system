<?php

namespace Database\Seeders;

<<<<<<< HEAD
=======
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
>>>>>>> fdf64b54617ff63720d6ee480331d892c4043616
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
<<<<<<< HEAD
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
=======
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            PermissionSeeder::class,
        ]);

        User::firstOrCreate(
            ['email' => 'test@example.com'],
            ['name' => 'Test User', 'password' => 'password']
        );
    }
}
>>>>>>> fdf64b54617ff63720d6ee480331d892c4043616
