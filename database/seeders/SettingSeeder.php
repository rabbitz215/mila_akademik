<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $setting = new \App\Setting();
        $setting->key = 'ACADEMIC_YEAR';
        $setting->value = '19';
        $setting->save();
    }
}
