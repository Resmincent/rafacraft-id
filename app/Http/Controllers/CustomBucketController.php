<?php

namespace App\Http\Controllers;

use App\Models\Bouquet;
use App\Models\CustomBucket;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\CustomBucketItem;
use App\Models\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class CustomBucketController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = new CustomBucket();
        $sizes = Size::all();
        $buckets = Bouquet::all();
        return view('custom-buckets', compact('sizes', 'buckets', 'data'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $size = Size::findOrFail($request->size_id);

        $bouquetData = [];
        $totalPrice = $size->price;

        if ($request->has('bouquets')) {
            $bouquetValidationRules = [];
            $bouquetQuantities = $request->input('bouquet_quantities', []);

            foreach ($request->bouquets as $bouquetId) {
                $bouquet = Bouquet::findOrFail($bouquetId);
                $quantity = $bouquetQuantities[$bouquetId] ?? 0;

                if ($quantity > 0) {
                    $bouquetData[] = [
                        'bouquet_id' => $bouquetId,
                        'quantity' => $quantity
                    ];
                    $totalPrice += $bouquet->price * $quantity;
                }
            }
        }

        $validator = Validator::make($request->all(), [
            'tema' => 'required|string|max:255',
            'url' => 'required|string|max:255',
            'size_id' => 'required|exists:sizes,id',
            'bouquets' => 'required|array|min:1',
            'bouquets.*' => 'exists:bouquets,id',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }


        $customBucket = CustomBucket::create([
            'tema' => $request->tema,
            'url' => $request->url,
            'size_id' => $request->size_id,
            'price' => $totalPrice
        ]);

        foreach ($bouquetData as $item) {
            CustomBucketItem::create([
                'custom_bucket_id' => $customBucket->id,
                'bouquet_id' => $item['bouquet_id'],
                'quantity' => $item['quantity']
            ]);
        }

        // Automatically add to cart
        $cart = $this->getOrCreateCart();
        $this->addCustomBucketToCart($cart, $customBucket);

        return redirect()
            ->route('cart.index')
            ->with('success', 'Custom bucket berhasil dibuat dan ditambahkan ke keranjang!');
    }

    /**
     * Add custom bucket to cart
     */
    public function addToCart(Request $request, $customBucketId)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $cart = $this->getOrCreateCart();
        $customBucket = CustomBucket::findOrFail($customBucketId);
        $this->addCustomBucketToCart($cart, $customBucket, $request->input('quantity'));

        return redirect()->route('cart.index')->with('success', 'Custom bucket berhasil ditambahkan ke keranjang.');
    }

    /**
     * Get or create cart for current user
     */
    private function getOrCreateCart()
    {
        return Auth::user()->cart ?: Cart::create(['user_id' => Auth::id()]);
    }

    /**
     * Add custom bucket to cart
     */
    private function addCustomBucketToCart($cart, $customBucket, $quantity = 1)
    {
        $existingCartItem = CartItem::where('cart_id', $cart->id)
            ->where('custom_bucket_id', $customBucket->id)
            ->first();

        if ($existingCartItem) {
            // Jika sudah ada, update quantity
            $existingCartItem->update([
                'quantity' => $existingCartItem->quantity + $quantity,
                'item_type' => 'custom_bucket'  // Tambahkan ini
            ]);
        } else {
            // Jika belum ada, buat cart item baru
            CartItem::create([
                'cart_id' => $cart->id,
                'custom_bucket_id' => $customBucket->id,
                'quantity' => $quantity,
                'item_type' => 'custom_bucket'  // Tambahkan ini
            ]);
        }
    }
}
