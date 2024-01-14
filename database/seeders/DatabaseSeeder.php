<?php

namespace Database\Seeders;

use App\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            RoleSeeder::class,
            UserRoleSeeder::class,
            KelasSeeder::class,
            StudyProgramSeeder::class,
            StudentSeeder::class,
            MatkulSeeder::class,
        ]);
    }
}
