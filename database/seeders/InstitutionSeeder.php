<?php

namespace Database\Seeders;

use App\Models\Institution;
use Illuminate\Database\Seeder;

class InstitutionSeeder extends Seeder
{
    public function run(): void
    {
        Institution::create([
            'name' => 'Demo High School',
            'name_bn' => 'ডেমো উচ্চ বিদ্যালয়',
            'type' => 'school',
            'medium' => 'bangla',
            'level' => 'secondary',
            'eiin' => '123456',
            'phone' => '01700000000',
            'email' => 'info@demoschool.edu.bd',
            'address' => '১২৩, প্রধান সড়ক, ঢাকা',
            'city' => 'Dhaka',
            'district' => 'Dhaka',
            'division' => 'Dhaka',
            'principal_name' => 'মোঃ আব্দুল করিম',
            'principal_phone' => '01700000001',
            'established_date' => '2000-01-01',
            'motto' => 'শিক্ষাই আলো',
            'is_active' => true,
        ]);

        $this->command->info('✅ Institution created!');
    }
}