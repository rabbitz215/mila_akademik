<?php

namespace Database\Seeders;

use App\StudyProgram;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StudyProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        StudyProgram::create([
            'name' => 'Diploma IV Jaringan Telekomunikasi Digital'
        ]);
    }
}
