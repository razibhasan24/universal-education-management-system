<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            ['key' => 'institution_name', 'value' => 'Demo High School', 'group' => 'general'],
            ['key' => 'institution_name_bn', 'value' => 'ডেমো উচ্চ বিদ্যালয়', 'group' => 'general'],
            ['key' => 'address', 'value' => '১২৩, প্রধান সড়ক, ঢাকা', 'group' => 'general'],
            ['key' => 'phone', 'value' => '01700000000', 'group' => 'general'],
            ['key' => 'email', 'value' => 'info@demoschool.edu.bd', 'group' => 'general'],
            ['key' => 'currency', 'value' => 'BDT', 'group' => 'general'],
            ['key' => 'currency_symbol', 'value' => '৳', 'group' => 'general'],
            ['key' => 'timezone', 'value' => 'Asia/Dhaka', 'group' => 'general'],
            ['key' => 'logo', 'value' => null, 'group' => 'general', 'type' => 'file'],
            ['key' => 'sms_enabled', 'value' => '0', 'group' => 'sms', 'type' => 'boolean'],
            ['key' => 'attendance_sms', 'value' => '1', 'group' => 'sms', 'type' => 'boolean'],
            ['key' => 'fee_due_sms', 'value' => '1', 'group' => 'sms', 'type' => 'boolean'],
        ];

        foreach ($settings as $setting) {
            Setting::create(array_merge([
                'institution_id' => 1,
                'type' => 'string',
            ], $setting));
        }

        $this->command->info('✅ Settings created!');
    }
}