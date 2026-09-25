<?php

namespace Database\Seeders;

use App\Models\ExamType;
use Illuminate\Database\Seeder;

class ExamTypeSeeder extends Seeder
{
    public function run(): void
    {
        $types = [
            ['name' => 'First Terminal', 'name_bn' => 'প্রথম সাময়িক', 'weight_percentage' => 20],
            ['name' => 'Half Yearly', 'name_bn' => 'অর্ধ-বার্ষিক', 'weight_percentage' => 30],
            ['name' => 'Second Terminal', 'name_bn' => 'দ্বিতীয় সাময়িক', 'weight_percentage' => 20],
            ['name' => 'Annual', 'name_bn' => 'বার্ষিক', 'weight_percentage' => 30],
            ['name' => 'Test Exam', 'name_bn' => 'টেস্ট পরীক্ষা', 'weight_percentage' => 100],
        ];

        foreach ($types as $index => $type) {
            ExamType::create(array_merge($type, [
                'institution_id' => 1,
                'order' => $index + 1,
                'is_active' => true,
            ]));
        }

        $this->command->info('✅ 5 Exam Types created!');
    }
}