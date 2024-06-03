<?php

namespace Database\Seeders;

use App\Models\Bantuan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BantuanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bantuan = Bantuan::create([
            'name_bantuan' => 'BLT UMKM Kab.Kediri tahap 1',
            'description_bantuan' => ' program bantuan produktif penanganan dampak pandemi Covid-19 untuk para pelaku usaha mikro',
            'tahun' => '2020',
            'sumber_bantuan' => 'Pemerintah Pusat'
        ]);

        $bantuan1 = Bantuan::create([
            'name_bantuan' => 'BLT UMKM Kab.Kediri tahap 2',
            'description_bantuan' => ' program bantuan produktif penanganan dampak pandemi Covid-19 untuk para pelaku usaha mikro',
            'tahun' => '2020',
            'sumber_bantuan' => 'Pemerintah Pusat'
        ]);
    }
}