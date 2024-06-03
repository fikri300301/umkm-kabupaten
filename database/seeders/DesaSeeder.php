<?php

namespace Database\Seeders;

use App\Models\Desa;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DesaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $desa = Desa::create([
            'kecamatan_id' => 1,
            'name_desa' => 'JUGO'
        ]);

        $desa1 = Desa::create([
            'kecamatan_id' => 1,
            'name_desa' => 'BLIMBIMG'
        ]);

        $desa2 = Desa::create([
            'kecamatan_id' => 1,
            'name_desa' => 'PAMONGAN'
        ]);

        $desa3 = Desa::create([
            'kecamatan_id' => 1,
            'name_desa' => 'PETUNGROTO'
        ]);

        $desa4 = Desa::create([
            'kecamatan_id' => 2,
            'name_desa' => 'BULU'
        ]);

        $desa5 = Desa::create([
            'kecamatan_id' => 2,
            'name_desa' => 'SIDOMULYO'
        ]);

        $desa6 = Desa::create([
            'kecamatan_id' => 2,
            'name_desa' => 'PUHRUBUH'
        ]);

        $desa7 = Desa::create([
            'kecamatan_id' => 2,
            'name_desa' => 'SELOPANGGUNG'
        ]);

        $desa8 = Desa::create([
            'kecamatan_id' => 3,
            'name_desa' => 'TALES'
        ]);

        $desa9 = Desa::create([
            'kecamatan_id' => 3,
            'name_desa' => 'NGADILUWIH'
        ]);

        $desa10 = Desa::create([
            'kecamatan_id' => 3,
            'name_desa' => 'BEDUG'
        ]);

        $des11 = Desa::create([
            'kecamatan_id' => 3,
            'name_desa' => 'REMBANG KEPUH'
        ]);
    }
}