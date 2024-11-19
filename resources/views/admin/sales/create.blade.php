<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Penjualan') }}
        </h2>
    </x-slot>

    <div class="max-w-3xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
        <div class="bg-white shadow-2xl rounded-xl p-10 border border-gray-100">
            <form action="{{ route('sales.store') }}" method="POST" class="space-y-6" x-data="saleForm()">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Product Dropdown -->
                    <div>
                        <label for="product_id" class="block text-sm font-semibold text-gray-700 mb-2">
                            {{ __('Select Product') }}
                        </label>
                        <select id="product_id" name="product_id" x-model="selectedProduct" @change="updatePrice" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition duration-200" required>
                            <option value="" disabled selected>{{ __('Choose a product') }}</option>
                            @foreach ($products as $product)
                            <option value="{{ $product->id }}" data-price="{{ $product->price }}">
                                {{ $product->name }} ({{ FormatRupiah($product->price) }})
                            </option>
                            @endforeach
                        </select>
                        @error('product_id')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Sale Price (Auto-populated) -->
                    <div>
                        <label for="sale_price" class="block text-sm font-semibold text-gray-700 mb-2">
                            {{ __('Sale Price') }}
                        </label>
                        <input type="text" id="sale_price" name="sale_price" x-model="salePriceFormatted" readonly class="w-full rounded-lg border-gray-300 bg-gray-100 cursor-not-allowed shadow-sm" />
                        <input type="hidden" name="sale_price" x-model="salePrice" />
                        @error('sale_price')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Sale Date -->
                    <div>
                        <label for="sale_date" class="block text-sm font-semibold text-gray-700 mb-2">
                            {{ __('Sale Date') }}
                        </label>
                        <input type="date" id="sale_date" name="sale_date" value="{{ now()->format('Y-m-d') }}" required class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition duration-200" />
                        @error('sale_date')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Buyer Name -->
                    <div>
                        <label for="buyer_name" class="block text-sm font-semibold text-gray-700 mb-2">
                            {{ __('Buyer Name') }}
                        </label>
                        <input type="text" id="buyer_name" name="buyer_name" required placeholder="{{ __('Full Name') }}" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition duration-200" />
                        @error('buyer_name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="flex items-center justify-end mt-8">
                    <button type="submit" class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-300 transition duration-200 ease-in-out transform hover:-translate-y-0.5">
                        {{ __('Save') }}
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script>
        function saleForm() {
            return {
                selectedProduct: ''
                , salePrice: ''
                , salePriceFormatted: ''
                , updatePrice() {
                    const productSelect = document.getElementById('product_id');
                    const selectedOption = productSelect.options[productSelect.selectedIndex];
                    this.salePrice = selectedOption.getAttribute('data-price');
                    this.salePriceFormatted = new Intl.NumberFormat('id-ID', {
                        style: 'currency'
                        , currency: 'IDR'
                        , minimumFractionDigits: 0
                        , maximumFractionDigits: 0
                    }).format(this.salePrice);
                }
            }
        }

    </script>
</x-app-layout>
