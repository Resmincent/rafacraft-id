<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $categoryId = $request->input('category_id');

        $bests = Product::where('label', 'best')
            ->when($categoryId, function ($query) use ($categoryId) {
                return $query->where('category_id', $categoryId);
            })
            ->latest()
            ->take(6)
            ->get();

        $monthlys = Product::where('label', 'special')
            ->when($categoryId, function ($query) use ($categoryId) {
                return $query->where('category_id', $categoryId);
            })
            ->latest()
            ->take(6)
            ->get();

        $categories = Category::withCount('products')
            ->orderBy('name')
            ->get();

        return view('home', compact('bests', 'monthlys', 'categories'));
    }
}
