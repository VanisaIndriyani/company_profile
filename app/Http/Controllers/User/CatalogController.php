<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Catalog;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    public function index(Request $request)
    {
        $c = $request->input('c');
        if ($c) {
            $catalogs = Catalog::whereRaw('LOWER(category) = ?', [strtolower($c)])->get();
        } else {
            $catalogs = Catalog::all();
        }
        return view('user.catalog', compact('catalogs'));
    }

    public function show($id)
    {
        $catalog = Catalog::findOrFail($id);
        return view('user.catalog_show', compact('catalog'));
    }
} 