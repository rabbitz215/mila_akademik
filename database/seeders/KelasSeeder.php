<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tingkats = [1, 2, 3, 4];
        $kelasVariants = ['A', 'B', 'C', 'D', 'E'];

        foreach ($tingkats as $tingkat) {
            foreach ($kelasVariants as $kelas) {
                DB::table('kelas')->insert([
                    'tingkat' => $tingkat,
                    'kelas' => $kelas,
                ]);
            }
        }
    }
}
