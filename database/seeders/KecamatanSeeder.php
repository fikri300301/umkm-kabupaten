<?php

namespace Database\Seeders;

use App\Models\Kecamatan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KecamatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kecamatan = Kecamatan::create([
            'name_kecamatan' => 'MOJO'
        ]);

        $kecamatan1 = Kecamatan::create([
            'name_kecamatan' => 'SEMEN'
        ]);

        $kecamatan2 = Kecamatan::create([
            'name_kecamatan' => 'NGADILUWIH'
        ]);

        $kecamatan3 = Kecamatan::create([
            'name_kecamatan' => 'KRAS'
        ]);

    }
}