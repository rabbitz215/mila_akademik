<?php

namespace Database\Seeders;

use App\SemesterSubject;
use App\Subject;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MatkulSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $matkuls = [
            ['RTD 171001', 'QMS', 1, 1],
            ['RTD 171102', 'Matematika Teknik I', 1, 2],
            ['RTD 171103', 'Rangkaian Listrik I', 1, 2],
            ['RTD 171104', 'Pengukuran Besaran Listrik', 1, 2],
            ['RTD 171105', 'Rangkaian Digital', 1, 2],
            ['RTD 171106', 'Praktikum Rangkaian Listrik I', 1, 2],
            ['RTD 171107', 'Teknik Komputer', 1, 2],
            ['RTD 171108', 'Algoritma dan Pemrograman', 1, 2],
            ['RTD 171109', 'Gambar Teknik Elektro', 1, 1],
            ['RTD 171110', 'Bengkel Elektromekanik', 1, 2],
            ['RTD 171111', 'Piranti Elektronika + Lab', 1, 2],
            ['RTD 172001', 'Bahasa Indonesia', 2, 2],
            ['RTD 172002', 'KWU', 2, 1],
            ['RTD 172004', 'Bahasa Inggris I', 2, 1],
            ['RTD 172105', 'Matematika Teknik II', 2, 2],
            ['RTD 172106', 'Pengantar Telekomunikasi', 2, 2],
            ['RTD 172107', 'Rangkaian Elektronika', 2, 2],
            ['RTD 172108', 'Praktikum Rangkaian Elektronika I', 2, 2],
            ['RTD 172109', 'Praktikum Pengukuran Besaran Listrik', 2, 1],
            ['RTD 172110', 'Praktikum Rangkaian Digital', 2, 2],
            ['RTD 172111', 'Pemrograman Komputer', 2, 2],
            ['RTD 172112', 'Rangkaian Listrik II + Lab', 2, 2],
            ['RTD 173001', 'Bahasa Inggris II', 3, 1],
            ['RTD 173102', 'Komunikasi Data', 3, 2],
            ['RTD 173103', 'Medan Elektromagnetik', 3, 2],
            ['RTD 173004', 'Pendidikan Agama', 3, 2],
            ['RTD 173105', 'Saluran Transmisi Telekomunikasi', 3, 2],
            ['RTD 173106', 'Telekomunikasi Analog dan Digital', 3, 2],
            ['RTD 173107', 'Praktikum Telekomunikasi Analog', 3, 2],
            ['RTD 173108', 'Praktikum Mikrokontroler I', 3, 2],
            ['RTD 173109', 'Praktikum Rangkaian Elektronika II', 3, 2],
            ['RTD 173110', 'Praktikum Jaringan Komputer I', 3, 2],
            ['RTD 173111', 'Elektronika Telekomunikasi + Lab', 3, 3],
            ['RTD 174001', 'Pendidikan Pancasila', 4, 2],
            ['RTD 174102', 'Keselamatan dan Kesehatan Kerja (K3)', 4, 1],
            ['RTD 174103', 'Teknik Gelombang Mikro', 4, 2],
            ['RTD 174104', 'Dasar Teknik Elektro', 4, 1],
            ['RTD 174105', 'Jaringan Telekomunikasi I', 4, 2],
            ['RTD 174006', 'Bahasa Inggris III', 4, 1],
            ['RTD 174107', 'Praktikum Komunikasi Data', 4, 2],
            ['RTD 174108', 'Praktikum Jaringan Komputer II', 4, 2],
            ['RTD 174109', 'Praktikum Saluran Transmisi', 4, 2],
            ['RTD 174110', 'Praktikum Telekomunikasi Digital', 4, 2],
            ['RTD 174111', 'Praktikum Sistem Mikrokontroler II', 4, 2],
            ['RTD 174112', 'Sistem Komunikasi Radio + Lab', 4, 2],
            ['RTD 175101', 'Standard dan Regulasi Telekomunikasi', 5, 1],
            ['RTD 175102', 'Teknik Switching & Rekayasa Trafik', 5, 2],
            ['RTD 175103', 'Sistem Komunikasi Satelit', 5, 2],
            ['RTD 175104', 'Teori dan Desain Antena', 5, 2],
            ['RTD 175105', 'Sistem Komunikasi Seluler', 5, 2],
            ['RTD 175106', 'Pemrosesan Sinyal Digital', 5, 2],
            ['RTD 175107', 'Teknik Kontrol Otomatis', 5, 2],
            ['RTD 175008', 'Bahasa Inggris IV', 5, 1],
            ['RTD 175109', 'Praktikum Teknik Gelombang Mikro', 5, 2],
            ['RTD 175110', 'Praktikum Jaringan Telekomunikasi I', 5, 2],
            ['RTD 175111', 'Sistem Video + Lab', 5, 2],
            ['RTD 175112', 'Teknik Instalasi Fiber Optik', 5, 2],
            ['RTD 176105', 'Pemrograman Aplikasi Mobile', 6, 2],
            ['RTD 176106', 'Praktikum Antena', 6, 1],
            ['RTD 176107', 'Praktikum Sistem Komunikasi Seluler', 6, 2],
            ['RTD 176108', 'Praktikum Pemrosesan Sinyal Digital', 6, 1],
            ['RTD 176110', 'Sistem Komunikasi Fiber Optik + Lab', 6, 2],
            ['RTD 177101', 'Etika dan Profesi', 7, 1],
            ['RTD 177102', 'Pengantar Ekonomi Teknik', 7, 1],
            ['RTD 177103', 'Pendidikan Kewarganegaraan', 7, 2],
            ['RTD 177104', 'Telekomunikasi Multimedia', 7, 2],
            ['RTD 177105', 'Teknologi Pita Lebar dan Kecepatan Tinggi', 7, 2],
            ['RTD 177106', 'Sistem Komunikasi Avionik dan Navigasi', 7, 1],
            ['RTD 177107', 'Praktikum Jaringan Telekomunikasi II', 7, 2],
            ['RTD 177108', 'Projek Telekomunikasi', 7, 2],
            ['RTD 177109', 'Praktikum Kecerdasan Buatan', 7, 2],
            ['RTD 177110', 'Metodologi Penelitian dan Pra Skripsi', 7, 1],
            ['RTD 177111', 'Sistem Komunikasi Seluler Lanjut + Lab', 7, 2],
            ['RTD 177112', 'Rekayasa Dan Aplikasi Internet + Lab', 7, 2],
            ['RTD 178101', 'PKL (On The Job Training)', 8, 2],
            ['RTD 178102', 'Seminar TA', 8, 1],
            ['RTD 178103', 'Skripsi', 8, 5],
        ];

        foreach ($matkuls as $matkul) {
            $subject = Subject::create([
                'kode_matkul' => $matkul[0],
                'name' => $matkul[1],
                'sks' => $matkul[3],
                'study_program_id' => 1,
            ]);

            SemesterSubject::create([
                'subject_id' => $subject->id,
                'study_program_id' => 1,
                'semester' => $matkul[2],
            ]);
        }
    }
}
