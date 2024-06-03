<?php

namespace Database\Seeders;

use App\Models\CategoryPelatihan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoryPelatihanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $category = CategoryPelatihan::create([
            'name_category' => 'unggulan'
        ]);

        $category = CategoryPelatihan::create([
            'name_category' => 'Digital'
        ]);
    }
}