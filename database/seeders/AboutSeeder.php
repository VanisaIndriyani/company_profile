<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\About;

class AboutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        About::create([
            'caption' => 'Kami adalah agen travel terpercaya dan jaminan layanan perencanaan wisata yang mudah dan murah',
            'image' => 'default.jpg', // pastikan file ini ada di public/about_image/
        ]);
    }
}
