<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Article;

class BlogController extends Controller
{
    public function index()
    {
        $articles = Article::all();
        $recents = Article::orderBy('created_at', 'desc')->take(5)->get();
        return view('user.blog', compact('articles', 'recents'));
    }

    public function show($slug)
    {
        $article = Article::where('slug', $slug)->firstOrFail();
        return view('user.blog_show', compact('article'));
    }
} 