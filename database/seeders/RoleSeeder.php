<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Seed roles with guard_name 'web'
        $roles = [
            ['name' => 'admin', 'guard_name' => 'web'],
            ['name' => 'dosen', 'guard_name' => 'web'],
            ['name' => 'mahasiswa', 'guard_name' => 'web'],
            // Add more roles if needed
        ];

        // Insert roles into the database
        DB::table('roles')->insert($roles);
    }
}
