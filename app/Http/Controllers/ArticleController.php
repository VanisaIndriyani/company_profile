<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $articles = Article::all();
        return view('manager.blog.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('manager.blog.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpg,jpeg,png',
        ]);
        $data['slug'] = Str::slug($data['title']);
        if ($request->hasFile('image')) {
            $img = $request->file('image');
            $imgName = time().'_'.$img->getClientOriginalName();
            $img->move(public_path('article_image'), $imgName);
            $data['image'] = $imgName;
        }
        Article::create($data);
        return redirect()->route('manager.blog')->with('success', 'Artikel berhasil ditambah!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $article = Article::findOrFail($id);
        return view('manager.blog.edit', compact('article'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $article = Article::findOrFail($id);
        $data = $request->validate([
            'title' => 'required',
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpg,jpeg,png',
        ]);
        $data['slug'] = Str::slug($data['title']);
        if ($request->hasFile('image')) {
            $img = $request->file('image');
            $imgName = time().'_'.$img->getClientOriginalName();
            $img->move(public_path('article_image'), $imgName);
            $data['image'] = $imgName;
        }
        $article->update($data);
        return redirect()->route('manager.blog')->with('success', 'Artikel berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $article = Article::findOrFail($id);
        $article->delete();
        return redirect()->route('manager.blog')->with('success', 'Artikel berhasil dihapus!');
    }
}
