<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $roles = [
            ['name' => 'super_admin', 'display_name' => 'Super Admin', 'description' => 'Has access to all system functionality.'],
            ['name' => 'institution_admin', 'display_name' => 'Institution Admin', 'description' => 'Manages a single institution.'],
            ['name' => 'principal', 'display_name' => 'Principal', 'description' => 'Oversees academic operations of an institution.'],
            ['name' => 'teacher', 'display_name' => 'Teacher', 'description' => 'Teaches assigned classes and subjects.'],
            ['name' => 'accountant', 'display_name' => 'Accountant', 'description' => 'Handles finance and fee management.'],
            ['name' => 'student', 'display_name' => 'Student', 'description' => 'Enrolled learner in a class.'],
            ['name' => 'guardian', 'display_name' => 'Guardian', 'description' => 'Parent or guardian of a student.'],
        ];

        foreach ($roles as $role) {
            Role::updateOrCreate(
                ['name' => $role['name']],
                ['display_name' => $role['display_name'], 'description' => $role['description']]
            );
        }
    }
}
