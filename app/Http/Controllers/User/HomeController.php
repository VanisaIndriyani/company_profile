<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\Category;
use App\Models\Article;

class HomeController extends Controller
{
    public function index()
    {
        $about = About::all();
        $categories = Category::all();
        $articles = Article::all();
        return view('user.home', compact('about', 'categories', 'articles'));
    }
}
