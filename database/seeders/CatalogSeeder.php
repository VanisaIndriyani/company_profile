<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Catalog;

class CatalogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Catalog::create([
            'name' => 'Kopi Arabika',
            'description' => 'Kopi Arabika dengan cita rasa khas dan aroma harum.',
            'image' => 'arabika.jpg', // pastikan file ini ada di public/catalog_image/
            'price' => 35000,
            'category' => 'Coffee',
        ]);
        Catalog::create([
            'name' => 'Vape Premium',
            'description' => 'Vape dengan kualitas premium dan rasa mantap.',
            'image' => 'vape.jpg',
            'price' => 120000,
            'category' => 'Vape',
        ]);
    }
}
