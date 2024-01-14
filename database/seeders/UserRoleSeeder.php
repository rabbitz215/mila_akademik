<?php

namespace Database\Seeders;

use App\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create admin user
        $admin = User::create([
            'name' => 'Admin',
            'last_name' => 'User',
            'email' => 'admin@admin.polinema.ac.id',
            'password' => Hash::make('nopass'),
        ]);

        $adminRole = Role::where('name', 'admin')->first();
        $admin->assignRole($adminRole);
    }
}
