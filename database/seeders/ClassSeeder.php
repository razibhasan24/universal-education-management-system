<?php

namespace Database\Seeders;

use App\Models\SchoolClass;
use App\Models\Section;
use Illuminate\Database\Seeder;

class ClassSeeder extends Seeder
{
    public function run(): void
    {
        $classes = [
            ['name' => 'Class One', 'name_bn' => 'প্রথম শ্রেণি', 'numeric_value' => 1, 'level' => 'primary'],
            ['name' => 'Class Two', 'name_bn' => 'দ্বিতীয় শ্রেণি', 'numeric_value' => 2, 'level' => 'primary'],
            ['name' => 'Class Three', 'name_bn' => 'তৃতীয় শ্রেণি', 'numeric_value' => 3, 'level' => 'primary'],
            ['name' => 'Class Four', 'name_bn' => 'চতুর্থ শ্রেণি', 'numeric_value' => 4, 'level' => 'primary'],
            ['name' => 'Class Five', 'name_bn' => 'পঞ্চম শ্রেণি', 'numeric_value' => 5, 'level' => 'primary'],
            ['name' => 'Class Six', 'name_bn' => 'ষষ্ঠ শ্রেণি', 'numeric_value' => 6, 'level' => 'secondary'],
            ['name' => 'Class Seven', 'name_bn' => 'সপ্তম শ্রেণি', 'numeric_value' => 7, 'level' => 'secondary'],
            ['name' => 'Class Eight', 'name_bn' => 'অষ্টম শ্রেণি', 'numeric_value' => 8, 'level' => 'secondary'],
            ['name' => 'Class Nine', 'name_bn' => 'নবম শ্রেণি', 'numeric_value' => 9, 'level' => 'secondary'],
            ['name' => 'Class Ten', 'name_bn' => 'দশম শ্রেণি', 'numeric_value' => 10, 'level' => 'secondary'],
        ];

        foreach ($classes as $index => $class) {
            $created = SchoolClass::create([
                'institution_id' => 1,
                'name' => $class['name'],
                'name_bn' => $class['name_bn'],
                'numeric_value' => $class['numeric_value'],
                'level' => $class['level'],
                'order' => $index + 1,
                'is_active' => true,
            ]);

            // প্রতি ক্লাসে ২টি section (A, B)
            Section::create(['class_id' => $created->id, 'name' => 'A', 'name_bn' => 'ক', 'order' => 1, 'capacity' => 60]);
            Section::create(['class_id' => $created->id, 'name' => 'B', 'name_bn' => 'খ', 'order' => 2, 'capacity' => 60]);
        }

        $this->command->info('✅ 10 Classes + 20 Sections created!');
    }
}