<?php

namespace App\Http\Controllers;

use App\Models\Product;

class HomeController extends Controller
{

    public function index()
    {
        $bests = Product::where('label', 'best')->latest()->take(6)->get();
        $montlys = Product::where('label', 'special')->latest()->take(6)->get();

        return view('home', compact('bests', 'montlys'));
    }
}