<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;

class HomeController extends Controller
{

    public function index()
    {
        $bests = Product::where('label', 'best')->latest()->take(6)->get();
        $montlys = Product::where('label', 'special')->latest()->take(6)->get();

        $categories = Category::withCount('products')
            ->orderBy('name')
            ->get();

        return view('home', compact('bests', 'montlys', 'categories'));
    }
}
