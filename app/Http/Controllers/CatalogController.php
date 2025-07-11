<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Catalog;

class CatalogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $catalogs = Catalog::all();
        return view('manager.catalog.index', compact('catalogs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('manager.catalog.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'description' => 'nullable',
            'price' => 'required|integer',
            'stock' => 'required|integer|min:0',
            'category' => 'required',
            'image' => 'nullable|image|mimes:jpg,jpeg,png',
        ]);
        
        if ($request->stock < 0) {
            return redirect()->back()->with('error', 'Stok tidak boleh negatif!');
        }
        
        if ($request->hasFile('image')) {
            $img = $request->file('image');
            $imgName = time().'_'.$img->getClientOriginalName();
            $img->move(public_path('catalog_image'), $imgName);
            $data['image'] = $imgName;
        }
        Catalog::create($data);
        return redirect()->route('manager.catalog')->with('success', 'Katalog berhasil ditambah!');
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
        $catalog = Catalog::findOrFail($id);
        return view('manager.catalog.edit', compact('catalog'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $catalog = Catalog::findOrFail($id);
        $data = $request->validate([
            'name' => 'required',
            'description' => 'nullable',
            'price' => 'required|integer',
            'stock' => 'required|integer|min:0',
            'category' => 'required',
            'image' => 'nullable|image|mimes:jpg,jpeg,png',
        ]);
        
        if ($request->stock < 0) {
            return redirect()->back()->with('error', 'Stok tidak boleh negatif!');
        }
        
        if ($request->hasFile('image')) {
            $img = $request->file('image');
            $imgName = time().'_'.$img->getClientOriginalName();
            $img->move(public_path('catalog_image'), $imgName);
            $data['image'] = $imgName;
        }
        $catalog->update($data);
        return redirect()->route('manager.catalog')->with('success', 'Katalog berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $catalog = Catalog::findOrFail($id);
        $catalog->delete();
        return redirect()->route('manager.catalog')->with('success', 'Katalog berhasil dihapus!');
    }

    public function stock()
    {
        $catalogs = Catalog::all();
        return view('manager.stock', compact('catalogs'));
    }

    public function updateStock(Request $request, $id)
    {
        $catalog = Catalog::findOrFail($id);
        $request->validate([
            'stock' => 'required|integer|min:0',
        ]);
        
        if ($request->stock < 0) {
            return redirect()->route('manager.stock')->with('error', 'Stok tidak boleh negatif!');
        }
        
        $catalog->stock = $request->stock;
        $catalog->save();
        return redirect()->route('manager.stock')->with('success', 'Stok berhasil diupdate!');
    }
}
