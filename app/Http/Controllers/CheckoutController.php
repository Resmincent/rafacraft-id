<?php

namespace App\Http\Controllers;

use App\Models\Bouquet;
use App\Models\Cart;
use App\Models\CustomBucketItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = Cart::where('user_id', Auth::id())
            ->with(['cartItems.product', 'cartItems.customBucket'])
            ->first();

        if (!$cart || $cart->cartItems->isEmpty()) {
            return redirect()->route('cart.index')
                ->with('error', 'Keranjang belanja kosong.');
        }

        $cartItems = $cart->cartItems;
        $total = $cartItems->sum(function ($item) {
            return $item->getPrice() * $item->quantity;
        });

        // Calculate minimum date (tomorrow)
        $minDate = Carbon::tomorrow()->format('Y-m-d');
        // Calculate maximum date (30 days from today)
        $maxDate = Carbon::now()->addDays(30)->format('Y-m-d');

        return view('checkout', compact('cartItems', 'total', 'minDate', 'maxDate'));
    }

    public function process(Request $request)
    {
        try {
            $validated = $request->validate([
                'full_name' => 'required|string|max:255',
                'phone_number' => 'required|string|max:20',
                'address' => 'required|string',
                'city' => 'required|string|max:100',
                'pickup' => 'required|in:pickup,delivery',
                'delivery_date' => 'required|date|after:today|before_or_equal:' . now()->addDays(30),
                'notes' => 'nullable|string',
            ]);

            $cart = Cart::where('user_id', Auth::id())
                ->with(['cartItems.product', 'cartItems.customBucket'])
                ->first();

            if (!$cart || $cart->cartItems->isEmpty()) {
                return back()->with('error', 'Keranjang belanja kosong.');
            }

            $total = $cart->cartItems->sum(function ($item) {
                return $item->getPrice() * $item->quantity;
            });

            // Combine delivery date with notes
            $formattedDate = Carbon::parse($validated['delivery_date'])->isoFormat('dddd, D MMMM Y');
            $combinedNotes = "Tanggal: " . $formattedDate;
            if (!empty($validated['notes'])) {
                $combinedNotes .= "\nCatatan tambahan: " . $validated['notes'];
            }

            foreach ($cart->cartItems as $item) {
                $item->update([
                    'full_name' => $validated['full_name'],
                    'phone_number' => $validated['phone_number'],
                    'address' => $validated['address'],
                    'city' => $validated['city'],
                    'pickup' => $validated['pickup'],
                    'notes' => $combinedNotes
                ]);
            }

            $message = $this->createWhatsAppMessage($cart, $validated, $total, $formattedDate);

            Log::info('Checkout initiated', [
                'user_id' => Auth::id(),
                'cart_id' => $cart->id,
                'customer_info' => $validated,
                'total' => $total
            ]);

            $cart->delete();
            $whatsappNumber = "6287888129093";
            $encodedMessage = urlencode($message);
            $whatsappUrl = "https://wa.me/{$whatsappNumber}?text={$encodedMessage}";

            return redirect($whatsappUrl);
        } catch (\Exception $e) {
            Log::error('Checkout error', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return back()
                ->with('error', 'Terjadi kesalahan saat memproses checkout.')
                ->withInput();
        }
    }

    private function createWhatsAppMessage($cart, $customerInfo, $total, $formattedDate)
    {
        $message = "*PESANAN BARU RAFACRAFT*\n\n";

        $message .= "*Informasi Pembeli:*\n";
        $message .= "Nama: {$customerInfo['full_name']}\n";
        $message .= "No HP: {$customerInfo['phone_number']}\n";
        $message .= "Alamat: {$customerInfo['address']}\n";
        $message .= "Kota: {$customerInfo['city']}\n";
        $message .= "Pengambilan: " . ($customerInfo['pickup'] === 'pickup' ? 'Ambil Sendiri' : 'Pengiriman') . "\n";
        $message .= "Tanggal: {$formattedDate}\n";

        if (!empty($customerInfo['notes'])) {
            $message .= "Catatan: {$customerInfo['notes']}\n";
        }

        $message .= "\n*Detail Pesanan:*\n";
        foreach ($cart->cartItems as $item) {
            if ($item->item_type === 'product') {
                $itemName = $item->product->name;
                $price = $item->product->price;
                $size = $item->product->size;
                $url = $item->product->category->name;
                $message .= "- {$itemName}\n";
                $message .= "- Ukuran: {$size}\n";
                $message .= "- Kategori Bucket: {$url}\n";
            } elseif ($item->item_type === 'custom_bucket') {
                $itemName = $item->customBucket->tema . " (Custom Bucket)";
                $price = $item->customBucket->price;
                $size = $item->customBucket->size->size;
                $url = $item->customBucket->url;
                $message .= "- {$itemName}\n";
                $message .= "- Ukuran:  {$size}\n";
                $message .= "- Referensi: {$url}\n";

                $customBucketItems = CustomBucketItem::where('custom_bucket_id', $item->customBucket->id)->get();
                if ($customBucketItems->count() > 0) {
                    $message .= "Bouquet dalam Custom Bucket:\n";
                    foreach ($customBucketItems as $bucketItem) {
                        $bouquet = Bouquet::find($bucketItem->bouquet_id);
                        $message .= "  - {$bouquet->name} (Qty: {$bucketItem->quantity})\n";
                    }
                }
            } else {
                continue;
            }


            $message .= "  Jumlah: {$item->quantity} x Rp " . number_format($price, 0, ',', '.') . "\n";
            $message .= "  Subtotal: Rp " . number_format($price * $item->quantity, 0, ',', '.') . "\n\n";
        }

        $message .= "\n*Total Pembayaran: Rp " . number_format($total, 0, ',', '.') . "*\n\n";

        $message .= "Terima kasih telah berbelanja di Rafacraft!\n";
        $message .= "Pesanan Anda akan segera diproses.";


        return $message;
    }
}
