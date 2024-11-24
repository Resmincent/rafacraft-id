<?php

namespace App\Http\Controllers;

use App\Models\CustomBucket;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;


class CustomBucketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $customBuckets = CustomBucket::with('bouquets')->get();
        // return view('custom-buckets.index', compact('customBuckets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('custom-buckets');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tema' => 'required|string|max:255',
            'color' => 'required|string|max:50',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'size' => 'required|string|in:small,medium,large',
            'price' => 'required|numeric|min:0'
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('custom-buckets', 'public');
        }

        CustomBucket::create([
            'tema' => $request->tema,
            'color' => $request->color,
            'image' => $imagePath,
            'size' => $request->size
        ]);

        return redirect()
            ->route('cart.index')
            ->with('success', 'Custom bucket berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(CustomBucket $customBucket)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CustomBucket $customBucket)
    {
        // return view('custom-buckets.edit', compact('customBucket'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CustomBucket $customBucket)
    {
        // $validator = Validator::make($request->all(), [
        //     'tema' => 'required|string|max:255',
        //     'color' => 'required|string|max:50',
        //     'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        //     'size' => 'required|string|in:small,medium,large',
        //     'price' => 'required|numeric|min:0'
        // ]);

        // if ($validator->fails()) {
        //     return redirect()
        //         ->back()
        //         ->withErrors($validator)
        //         ->withInput();
        // }

        // $data = $request->except('image');

        // if ($request->hasFile('image')) {
        //     // Delete old image
        //     if ($customBucket->image) {
        //         Storage::disk('public')->delete($customBucket->image);
        //     }

        //     // Store new image
        //     $data['image'] = $request->file('image')->store('custom-buckets', 'public');
        // }

        // $customBucket->update($data);

        // return redirect()
        //     ->route('custom-buckets.index')
        //     ->with('success', 'Custom bucket berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CustomBucket $customBucket)
    {
        // Delete image if exists
        if ($customBucket->image) {
            Storage::disk('public')->delete($customBucket->image);
        }

        $customBucket->delete();

        return redirect()
            ->route('custom-buckets.index')
            ->with('success', 'Custom bucket berhasil dihapus!');
    }

    public function addToCart(Request $request, CustomBucket $customBucket)
    {
        $validator = Validator::make($request->all(), [
            'quantity' => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $cart = $this->getOrCreateCart();
        $this->addCustomBucketToCart($cart, $customBucket, $request->quantity);

        return redirect()
            ->route('cart.index')
            ->with('success', 'Custom bucket berhasil ditambahkan ke keranjang!');
    }

    private function getOrCreateCart()
    {
        return Auth::user()->cart ?: Cart::create(['user_id' => Auth::id()]);
    }

    private function addCustomBucketToCart($cart, $customBucket, $quantity)
    {
        $cartItem = $cart->cartItems()
            ->where('custom_bucket_id', $customBucket->id)
            ->where('item_type', 'custom_bucket')
            ->first();

        if ($cartItem) {
            $cartItem->increment('quantity', $quantity);
        } else {
            $cart->cartItems()->create([
                'custom_bucket_id' => $customBucket->id,
                'quantity' => $quantity,
                'item_type' => 'custom_bucket'
            ]);
        }
    }
}
