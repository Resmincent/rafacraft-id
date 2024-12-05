<?php

namespace App\Exports;

use App\Models\Sale;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SalesExport implements FromCollection, WithHeadings
{
    /**
     * Mengambil data yang akan diekspor.
     *
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Sale::with('product')->get()->map(function ($sale) {
            return [
                'Buyer Name' => $sale->buyer_name,
                'Product' => $sale->product->name,
                'Sale Price' => FormatRupiah($sale->sale_price),
                'Sale Date' => $sale->sale_date,
            ];
        });
    }

    /**
     * Menambahkan heading pada file Excel.
     *
     * @return array
     */
    public function headings(): array
    {
        return [
            'Buyer Name',
            'Product',
            'Sale Price',
            'Sale Date',
        ];
    }
}
