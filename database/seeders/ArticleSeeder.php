<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Article;
use Illuminate\Support\Str;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Article::create([
            'title' => 'Tips Liburan Hemat',
            'slug' => Str::slug('Tips Liburan Hemat'),
            'content' => 'Berikut adalah tips liburan hemat bersama Fourjoo...',
            'image' => 'tips.jpg', // pastikan file ini ada di public/article_image/
        ]);
        // Tambah data lain jika perlu
    }
}
