<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;



class LandingPageController extends Controller
{
    public function index(Request $request)
    {
        $cart = Cart::where('user_id', Auth::id())->first();

        $cartItems = $cart ? $cart->cartItems()->with('product')->get() : collect();

        $query = Product::query();

        if ($request->filled('search')) {
            $searchTerm = $request->input('search');
            $query->where(function ($q) use ($searchTerm) {
                $q->where('name', 'like', "%{$searchTerm}%")
                    ->orWhere('model', 'like', "%{$searchTerm}%")
                    ->orWhereHas('category', function ($q) use ($searchTerm) {
                        $q->where('name', 'like', "%{$searchTerm}%");
                    });
            });
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        $products = $query->with('category')
            ->latest()
            ->paginate(12);

        $categories = Category::withCount('products')
            ->orderBy('name')
            ->get();

        return view('landing_page', compact('products', 'categories', 'cartItems'));
    }
    public function detail($id)
    {
        $product = Product::with('category')->findOrFail($id);
        $cart = Cart::where('user_id', Auth::id())->first();

        $cartItems = $cart ? $cart->cartItems()->with('product')->get() : collect();


        return view('detail-product', compact('product', 'cartItems'));
    }
}
