<?php

namespace Database\Seeders;

use App\Models\Subject;
use Illuminate\Database\Seeder;

class SubjectSeeder extends Seeder
{
    public function run(): void
    {
        $subjects = [
            ['name' => 'Bangla', 'name_bn' => 'বাংলা', 'code' => 'SUB-001', 'full_marks' => 100, 'pass_marks' => 33],
            ['name' => 'English', 'name_bn' => 'ইংরেজি', 'code' => 'SUB-002', 'full_marks' => 100, 'pass_marks' => 33],
            ['name' => 'Mathematics', 'name_bn' => 'গণিত', 'code' => 'SUB-003', 'full_marks' => 100, 'pass_marks' => 33],
            ['name' => 'Science', 'name_bn' => 'বিজ্ঞান', 'code' => 'SUB-004', 'full_marks' => 100, 'pass_marks' => 33],
            ['name' => 'Social Science', 'name_bn' => 'সমাজ বিজ্ঞান', 'code' => 'SUB-005', 'full_marks' => 100, 'pass_marks' => 33],
            ['name' => 'Religion', 'name_bn' => 'ধর্ম', 'code' => 'SUB-006', 'full_marks' => 100, 'pass_marks' => 33],
            ['name' => 'ICT', 'name_bn' => 'তথ্য ও যোগাযোগ প্রযুক্তি', 'code' => 'SUB-007', 'full_marks' => 100, 'pass_marks' => 33],
            ['name' => 'Physical Education', 'name_bn' => 'শারীরিক শিক্ষা', 'code' => 'SUB-008', 'full_marks' => 100, 'pass_marks' => 33],
        ];

        foreach ($subjects as $subject) {
            Subject::create(array_merge($subject, [
                'institution_id' => 1,
                'type' => 'theory',
                'is_active' => true,
            ]));
        }

        $this->command->info('✅ 8 Subjects created!');
    }
}