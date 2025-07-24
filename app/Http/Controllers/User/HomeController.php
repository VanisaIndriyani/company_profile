<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\Category;
use App\Models\Article;
use App\Models\Catalog;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    public function index()
    {
        try {
            $about = About::all();
            $categories = Category::all();
            $articles = Article::all();
            $catalogs = Catalog::all();
            
            // Initialize gallery items
            $galleryItems = collect();
            
            // Add articles to gallery
            if ($articles->count() > 0) {
                foreach ($articles as $article) {
                    if ($article->image && !empty($article->image)) {
                        $galleryItems->push([
                            'image' => 'article_image/' . $article->image,
                            'title' => $article->title ?? 'Untitled Article',
                            'type' => 'blog',
                            'slug' => $article->slug ?? '',
                            'id' => $article->id
                        ]);
                    }
                }
            }
            
            // Add catalogs to gallery
            if ($catalogs->count() > 0) {
                foreach ($catalogs as $catalog) {
                    if ($catalog->image && !empty($catalog->image)) {
                        $galleryItems->push([
                            'image' => 'catalog_image/' . $catalog->image,
                            'title' => $catalog->name ?? 'Untitled Catalog',
                            'type' => 'catalog',
                            'slug' => null,
                            'id' => $catalog->id
                        ]);
                    }
                }
            }
            
            // Shuffle and limit to 8 items for gallery
            $galleryItems = $galleryItems->shuffle()->take(8);
            
            // Debug info
            Log::info('HomeController Success', [
                'articles_count' => $articles->count(),
                'catalogs_count' => $catalogs->count(),
                'gallery_items_count' => $galleryItems->count()
            ]);
            
            return view('user.home', compact('about', 'categories', 'articles', 'catalogs', 'galleryItems'));
            
        } catch (\Exception $e) {
            Log::error('HomeController Error', [
                'message' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile()
            ]);
            
            // Return with empty gallery items if there's an error
            $about = collect();
            $categories = collect();
            $articles = collect();
            $catalogs = collect();
            $galleryItems = collect();
            
            return view('user.home', compact('about', 'categories', 'articles', 'catalogs', 'galleryItems'));
        }
    }
}
