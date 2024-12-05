<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class ProductTable extends Component
{
    use WithPagination;

    public $search = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function searchProducts()
    {
        $this->resetPage();
    }

    public function render()
    {
        $products = Product::with('category')
            ->where(function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('color', 'like', '%' . $this->search . '%')
                    ->orWhere('size', 'like', '%' . $this->search . '%')
                    ->orWhere('price', 'like', '%' . $this->search . '%');
            })
            ->paginate(10);

        return view('livewire.product-table', compact('products'));
    }
}
