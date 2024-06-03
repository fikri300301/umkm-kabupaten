<?php

namespace Database\Seeders;

use App\Models\CategoriesDivision;
use Illuminate\Database\Seeder;

class CategoriesDivisions extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CategoriesDivision::create([
            'name' => 'harian'
        ]);
        CategoriesDivision::create([
            'name' => 'internal'
        ]);
        CategoriesDivision::create([
            'name' => 'eksternal'
        ]);
    }
}
