<?php

namespace Database\Seeders;

use App\Models\Perizinan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PerizinanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $perizinan = Perizinan::create([
            'name_perizinan' => 'NIB(Nomor induk Usaha)'
        ]);

        $perizinan1 = Perizinan::create([
            'name_perizinan' => 'NPWP(Nomor Pokok Wajib Pajak) Pribadi'
        ]);

        $perizinan2 = Perizinan::create([
            'name_perizinan' => 'IUMK (Izin Usaha Mikro Kecil)'
        ]);

        $perizinan3 = Perizinan::create([
            'name_perizinan' => 'HKI Merek (Jika usaha nya memiliki merek)'
        ]);

        $perizinan4 = Perizinan::create([
            'name_perizinan' => 'SIUP (Surat Izin Usaha Perdagangan)'
        ]);
    }
}