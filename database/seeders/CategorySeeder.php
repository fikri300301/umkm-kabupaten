<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $category = Category::create([
            'name_category' => 'mikro',
            'angka' => '50.000.000 - 70.000.000',
            'status_category' => 'publish'
        ]);
        
    }
}