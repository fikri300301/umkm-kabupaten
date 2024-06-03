<?php

namespace Database\Seeders;

use App\Models\Pelatihan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PelatihanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pelatihan = Pelatihan::create([
            'name_pelatihan' => 'Manajemen Pemasaran',
            'description_pelatihan' => 'Bagaimana memasarkan product',
            'start_date' => '2023-09-05',
            'end_date' => '2023-09-13',
            'tahun' => '2020',
            'category_id' => 2
        ]);

        $pelatihan1 = Pelatihan::create([
            'name_pelatihan' => 'startegi branding',
            'description_pelatihan' => 'Bagaimana membuat merk product terkenal',
            'start_date' => '2023-09-05',
            'end_date' => '2023-09-13',
            'tahun' => '2020',
            'category_id' => 2
        ]);

        $pelatihan2 = Pelatihan::create([
            'name_pelatihan' => 'Manajemen Operasional dan SDM',
            'description_pelatihan' => 'Bagaimana mengelola umkm dan karyawan',
            'start_date' => '2023-09-05',
            'end_date' => '2023-09-13',
            'tahun' => '2020',
            'category_id' => 1
        ]);

        $pelatihan3 = Pelatihan::create([
            'name_pelatihan' => 'Public Speaking dan Negosiasi Bisnis',
            'description_pelatihan' => 'Keahlian individu untuk kemajuan umkm',
            'start_date' => '2023-09-05',
            'end_date' => '2023-09-13',
            'tahun' => '2020',
            'category_id' => 1
        ]);
    }
}