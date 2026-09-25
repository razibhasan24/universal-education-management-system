<?php

namespace Database\Seeders;

use App\Models\FeeCategory;
use Illuminate\Database\Seeder;

class FeeCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Monthly Tuition Fee', 'name_bn' => 'মাসিক বেতন', 'frequency' => 'monthly'],
            ['name' => 'Admission Fee', 'name_bn' => 'ভর্তি ফি', 'frequency' => 'one_time'],
            ['name' => 'Exam Fee', 'name_bn' => 'পরীক্ষা ফি', 'frequency' => 'half_yearly'],
            ['name' => 'Session Charge', 'name_bn' => 'সেশন চার্জ', 'frequency' => 'yearly'],
            ['name' => 'Library Fee', 'name_bn' => 'লাইব্রেরি ফি', 'frequency' => 'yearly'],
            ['name' => 'Sports Fee', 'name_bn' => 'খেলাধুলা ফি', 'frequency' => 'yearly'],
            ['name' => 'Development Fee', 'name_bn' => 'উন্নয়ন ফি', 'frequency' => 'one_time'],
        ];

        foreach ($categories as $index => $cat) {
            FeeCategory::create(array_merge($cat, [
                'institution_id' => 1,
                'code' => 'FEE-' . str_pad($index + 1, 3, '0', STR_PAD_LEFT),
                'is_active' => true,
            ]));
        }

        $this->command->info('✅ 7 Fee Categories created!');
    }
}