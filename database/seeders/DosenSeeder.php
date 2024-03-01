<?php

namespace Database\Seeders;

use App\Dosen;
use App\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DosenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 20; $i++) {
            $dosen = new Dosen();
            $dosen->fill([
                'name' => 'Dosen ' . $i,
                'nip' => '12345',
            ]);
            $dosen->save();

            $user = new User();
            $user->fill([
                'name' => 'Dosen ' . $i,
                'last_name' => 'Dosen',
                'email' => 'dosen' . $i . '@dosen.polinema.ac.id',
            ]);
            $user->password = bcrypt('nopass');
            $user->save();

            $user->assignRole('dosen');

            $dosen->user_id = $user->id;
            $dosen->save();

            $dosen->kelas()->sync([
                $i
            ]);
        }
    }
}
