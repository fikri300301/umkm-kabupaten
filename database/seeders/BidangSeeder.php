<?php

namespace Database\Seeders;

use App\Models\Bidang;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BidangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bidang = Bidang::create([
            'name_bidang' => 'Kerajinan',
            'status_bidang' => 'publish'
        ]);

        $bidang1 = Bidang::create([
            'name_bidang' => 'Kuliner',
            'status_bidang' => 'publish'
        ]);

        $bidang2 = Bidang::create([
            'name_bidang' => 'Jasa',
            'status_bidang' => 'publish'
        ]);

        $bidang3 = Bidang::create([
            'name_bidang' => 'Agribisnis',
            'status_bidang' => 'publish'
        ]);

        $bidang4 = Bidang::create([
            'name_bidang' => 'Fashion',
            'status_bidang' => 'publish'
        ]);

        $bidang5 = Bidang::create([
            'name_bidang' => 'Perdagangan Besar',
            'status_bidang' => 'publish'
        ]);

        $bidang6 = Bidang::create([
            'name_bidang' => 'Lainnya',
            'status_bidang' => 'publish'
        ]);
    }
}