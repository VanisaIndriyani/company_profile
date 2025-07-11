<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create([
            'name' => 'Wisata Alam',
            'description' => 'Nikmati keindahan alam bersama kami.',
            'image' => 'alam.jpg', // pastikan file ini ada di public/category_image/
        ]);
        // Tambah data lain jika perlu
    }
}
