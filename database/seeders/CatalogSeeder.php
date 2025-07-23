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
        // Coffee Products
        Catalog::create([
            'name' => 'Kopi Arabika',
            'description' => 'Kopi Arabika dengan cita rasa khas dan aroma harum.',
            'image' => '1751586658_row-1-column-1.png',
            'price' => 35000,
            'stock' => 50,
            'category' => 'Coffee',
        ]);
        
        Catalog::create([
            'name' => 'Kopi Robusta',
            'description' => 'Kopi Robusta dengan rasa yang kuat dan nikmat.',
            'image' => '1751586672_row-2-column-1.png',
            'price' => 30000,
            'stock' => 40,
            'category' => 'Coffee',
        ]);
        
        Catalog::create([
            'name' => 'Cappuccino',
            'description' => 'Cappuccino dengan susu foam yang lembut.',
            'image' => '1751586684_row-1-column-3.png',
            'price' => 45000,
            'stock' => 30,
            'category' => 'Coffee',
        ]);
        
        // Vape Products
        Catalog::create([
            'name' => 'Vape Premium',
            'description' => 'Vape dengan kualitas premium dan rasa mantap.',
            'image' => '1751588276_row-1-column-2.png',
            'price' => 120000,
            'stock' => 20,
            'category' => 'Vape',
        ]);
        
        Catalog::create([
            'name' => 'Vape Starter Kit',
            'description' => 'Vape starter kit untuk pemula dengan rasa nikmat.',
            'image' => '1751595050_Kucing.jpg',
            'price' => 85000,
            'stock' => 25,
            'category' => 'Vape',
        ]);
        
        Catalog::create([
            'name' => 'Vape Liquid',
            'description' => 'Liquid vape dengan berbagai pilihan rasa.',
            'image' => '1751595067_Kucing.jpg',
            'price' => 55000,
            'stock' => 35,
            'category' => 'Vape',
        ]);
    }
}
