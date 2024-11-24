<?php

namespace App\Http\Controllers;

use App\Models\Bouquet;
use App\Models\Category;
use App\Models\Product;
use App\Models\Sale;

class DashboardController extends Controller
{

    public function index()
    {
        $products = Product::latest()->take(10)->get();
        $sales = Sale::latest()->take(10)->get();

        $bqt_count = Bouquet::count();
        $categories_count = Category::count();
        $count_product = Product::count();

        return view('dashboard', compact('products', 'count_product', 'categories_count', 'bqt_count', 'sales'));
    }
}
