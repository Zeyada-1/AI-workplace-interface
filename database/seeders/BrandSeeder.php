<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Brand;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $brands = ['Nike', 'Adidas', 'Zara', 'H&M', 'Apple', 'Samsung', 'Coca-Cola', 'Pepsi', 'McDonald\'s', 'KFC'];
        
        foreach ($brands as $brand) {
            Brand::create(['name' => $brand]);
        }
    }
}
