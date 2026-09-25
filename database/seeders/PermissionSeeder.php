<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $permissions = [
            ['name' => 'view_dashboard', 'display_name' => 'View Dashboard'],
            ['name' => 'manage_students', 'display_name' => 'Manage Students'],
            ['name' => 'manage_teachers', 'display_name' => 'Manage Teachers'],
            ['name' => 'manage_classes', 'display_name' => 'Manage Classes'],
            ['name' => 'manage_subjects', 'display_name' => 'Manage Subjects'],
            ['name' => 'manage_exams', 'display_name' => 'Manage Exams'],
            ['name' => 'manage_grades', 'display_name' => 'Manage Grades'],
            ['name' => 'manage_attendance', 'display_name' => 'Manage Attendance'],
            ['name' => 'manage_fees', 'display_name' => 'Manage Fees'],
            ['name' => 'manage_payments', 'display_name' => 'Manage Payments'],
            ['name' => 'manage_expenses', 'display_name' => 'Manage Expenses'],
            ['name' => 'manage_announcements', 'display_name' => 'Manage Announcements'],
            ['name' => 'manage_messages', 'display_name' => 'Manage Messages'],
            ['name' => 'manage_users', 'display_name' => 'Manage Users'],
            ['name' => 'manage_roles', 'display_name' => 'Manage Roles'],
            ['name' => 'manage_settings', 'display_name' => 'Manage Settings'],
            ['name' => 'view_activity_logs', 'display_name' => 'View Activity Logs'],
            ['name' => 'view_reports_academic', 'display_name' => 'View Academic Reports'],
            ['name' => 'view_reports_financial', 'display_name' => 'View Financial Reports'],
            ['name' => 'view_reports_attendance', 'display_name' => 'View Attendance Reports'],
        ];

        foreach ($permissions as $permission) {
            Permission::updateOrCreate(['name' => $permission['name']], $permission);
        }
    }
}
