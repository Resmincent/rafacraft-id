<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\CustomBucket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CartController extends Controller
{
    // Menampilkan halaman keranjang belanja
    public function index()
    {
        $cart = $this->getOrCreateCart();
        $cartItems = $cart->cartItems()->with(['product', 'customBucket'])->get();

        // Debug: Periksa detail item keranjang
        foreach ($cartItems as $item) {
            Log::info('Detail Item Keranjang', [
                'id' => $item->id,
                'tipe_item' => $item->item_type,
                'id_produk' => $item->product_id,
                'id_custom_bucket' => $item->custom_bucket_id,
                'produk' => $item->product ? $item->product->toArray() : null,
                'custom_bucket' => $item->customBucket ? $item->customBucket->toArray() : null
            ]);
        }

        $total = $cartItems->sum(function ($item) {
            if ($item->product) {
                return $item->product->price * $item->quantity;
            } elseif ($item->customBucket) {
                return $item->customBucket->price * $item->quantity;
            }
            return 0;
        });

        return view('cart', compact('cartItems', 'total'));
    }
    // Menambahkan produk ke keranjang
    public function addToCart(Request $request, $productId)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $cart = $this->getOrCreateCart();
        $product = Product::findOrFail($productId);

        $this->addOrUpdateCartItem($cart, $product, $request->input('quantity'), 'product');

        return redirect()->route('cart.index')->with('success', 'Produk berhasil ditambahkan ke keranjang.');
    }


    // Memperbarui kuantitas produk di keranjang
    public function updateQuantity(Request $request, $cartItemId)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $cartItem = CartItem::findOrFail($cartItemId);
        $cartItem->update(['quantity' => $request->input('quantity')]);

        return redirect()->route('cart.index')->with('success', 'Kuantitas produk berhasil diperbarui.');
    }

    // Menghapus produk dari keranjang
    public function removeFromCart($cartItemId)
    {
        $cartItem = CartItem::findOrFail($cartItemId);
        $cartItem->delete();

        return redirect()->route('cart.index')->with('success', 'Produk berhasil dihapus dari keranjang.');
    }

    // Mendapatkan atau membuat keranjang baru untuk pengguna saat ini
    private function getOrCreateCart()
    {
        return Auth::user()->cart ?: Cart::create(['user_id' => Auth::id()]);
    }

    // Menambahkan atau memperbarui item keranjang
    public function addOrUpdateCartItem($cart, $item, $quantity, $itemType)
    {
        $itemId = $item->id;
        $customBucketId = null;
        $productId = null;

        if ($itemType === 'custom_bucket') {
            $customBucketId = $itemId;
        } elseif ($itemType === 'product') {
            $productId = $itemId;
        }

        // Tambahkan log debug
        Log::info('Menambah Item Keranjang', [
            'item_type' => $itemType,
            'custom_bucket_id' => $customBucketId,
            'product_id' => $productId
        ]);

        $cartItem = $cart->cartItems()
            ->where(function ($query) use ($itemId, $itemType) {
                if ($itemType === 'custom_bucket') {
                    $query->where('custom_bucket_id', $itemId);
                } elseif ($itemType === 'product') {
                    $query->where('product_id', $itemId);
                }
            })
            ->first();

        if ($cartItem) {
            $cartItem->increment('quantity', $quantity);
        } else {
            $cart->cartItems()->create([
                'item_type' => $itemType,  // Pastikan ini diset dengan benar
                'quantity' => $quantity,
                'custom_bucket_id' => $customBucketId,
                'product_id' => $productId,
            ]);
        }
    }

    public function addCustomBucketToCart(Request $request, $customBucketId)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $cart = $this->getOrCreateCart();
        $customBucket = CustomBucket::findOrFail($customBucketId);

        $this->addOrUpdateCartItem($cart, $customBucket, $request->input('quantity'), 'custom_bucket');

        return redirect()->route('cart.index')->with('success', 'Custom bucket berhasil ditambahkan ke keranjang.');
    }
}
