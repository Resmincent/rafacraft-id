<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Exports\SalesExport;
use Maatwebsite\Excel\Facades\Excel;

class SaleController extends Controller
{
    /**
     * Display a listing of the sales.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $query = Sale::with('product');

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('buyer_name', 'like', '%' . $search . '%')
                    ->orWhereHas('product', function ($q) use ($search) {
                        $q->where('name', 'like', '%' . $search . '%');
                    });
            });
        }

        if ($startDate && $endDate) {
            $query->whereDate('created_at', '>=', $startDate)
                ->whereDate('created_at', '<=', $endDate);
        } elseif ($startDate) {
            $query->whereDate('created_at', '>=', $startDate);
        } elseif ($endDate) {
            $query->whereDate('created_at', '<=', $endDate);
        }

        $sales = $query->paginate(10);

        return view('admin.sales.index', compact('sales', 'search', 'startDate', 'endDate'));
    }

    /**
     * Show the form for creating a new sale.
     */
    public function create()
    {
        $products = Product::with('category')->get();
        return view('admin.sales.create', compact('products'));
    }

    /**
     * Store a newly created sale in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'sale_price' => 'required|numeric|min:0',
            'sale_date' => 'required|date',
            'buyer_name' => 'required|string|max:255',
        ]);

        Sale::create($validated);

        return redirect()->route('sales.index')->with('success', 'Penjualan berhasil ditambahkan.');
    }

    /**
     * Display the specified sale.
     */
    public function show(Sale $sale)
    {
        $products = Product::with('category')->get();
        return view('admin.sales.show', compact('sale', 'products'));
    }

    /**
     * Remove the specified sale from storage.
     */
    public function destroy(Sale $sale)
    {
        $sale->delete();

        return redirect()->route('sales.destroy')->with('success', 'Penjualan berhasil dihapus.');
    }

    public function export()
    {
        return Excel::download(new SalesExport, 'data_penjualan_rafacraft.xlsx');
    }
}
