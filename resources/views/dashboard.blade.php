<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
            <div class="bg-green-50 border border-green-300 text-green-800 px-4 py-3 rounded relative mb-6">
                {{ session('success') }}
                <button type="button" class="absolute top-0 right-0 px-4 py-3 focus:outline-none" data-dismiss="alert">
                    <span>&times;</span>
                </button>
            </div>
            @endif

            @if (session('status'))
            <div class="bg-green-50 border border-green-300 text-green-800 px-4 py-3 rounded relative mb-6">
                {{ session('status') }}
            </div>
            @endif

            <!-- Widget Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-10">
                <!-- Mobil Widget -->
                <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                    <div class="flex items-center px-4 py-6">
                        <div class="p-3 bg-blue-100 text-blue-500 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 17l-1.5 1.5a3 3 0 003.9 3.9L7 21m12-4l1.5-1.5a3 3 0 00-3.9-3.9L17 12M7 12h0M17 12h0"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h4 class="text-lg font-semibold text-gray-700">Product</h4>
                            <p class="text-xl font-bold text-gray-900">{{ $count_product }}</p>
                        </div>
                    </div>
                </div>

                <!-- Motor Widget -->
                <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                    <div class="flex items-center px-4 py-6">
                        <div class="p-3 bg-green-100 text-green-500 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 9v2M14 9v2m1 5l.35 1.65a2 2 0 01-1.85 2.35h-5.1a2 2 0 01-1.85-2.35L9 16M9 12h0M15 12h0"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h4 class="text-lg font-semibold text-gray-700">Category</h4>
                            <p class="text-xl font-bold text-gray-900">{{ $categories_count }}</p>
                        </div>
                    </div>
                </div>

                <!-- Users Widget -->
                <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                    <div class="flex items-center px-4 py-6">
                        <div class="p-3 bg-yellow-100 text-yellow-500 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5M12 14l-2-2M9 10m6-4m-2 4"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h4 class="text-lg font-semibold text-gray-700">Isi Bouquet</h4>
                            <p class="text-xl font-bold text-gray-900">{{ $bqt_count }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Data Penjualan -->
                <a href="{{ route('sales.index') }}">
                    <div>
                        <div class="bg-white shadow-md hover:shadow-lg transition duration-300 transform hover:scale-105 rounded-lg">
                            <h3 class="text-gray-600 text-xl font-semibold p-4">Data Penjualan</h3>
                            <div class="overflow-x-auto p-4">
                                <table class="min-w-full text-sm text-left text-gray-500">
                                    <thead class="bg-gray-100 text-gray-600 font-bold">
                                        <tr>
                                            <th class="px-4 py-2">Buyer</th>
                                            <th class="px-4 py-2">Product Name</th>
                                            <th class="px-4 py-2">Price</th>
                                            <th class="px-4 py-2">Sale Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($sales as $sale)
                                        <tr class="border-b hover:bg-gray-50">
                                            <td class="px-4 py-2">{{ $sale->buyer_name }}</td>
                                            <td class="px-4 py-2">{{ $sale->product->name }}</td>
                                            <td class="px-4 py-2">{{ FormatRupiah($sale->sale_price) }}</td>
                                            <td class="px-4 py-2">{{ $sale->sale_date }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </a>

                <!-- Isian bouquet Overview -->
                <a href="{{ route('products.index') }}">
                    <div>
                        <div class="bg-white shadow-md hover:shadow-lg transition duration-300 transform hover:scale-105 rounded-lg">
                            <h3 class="text-gray-600 text-xl font-semibold p-4">Product</h3>
                            <div class="overflow-x-auto p-4">
                                <table class="min-w-full text-sm text-left text-gray-500">
                                    <thead class="bg-gray-100 text-gray-600 font-bold">
                                        <tr>
                                            <th class="px-4 py-2">Product Name</th>
                                            <th class="px-4 py-2">Color</th>
                                            <th class="px-4 py-2">Price</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($products as $product)
                                        <tr class="border-b hover:bg-gray-50">
                                            <td class="px-4 py-2">{{ $product->name}}</td>
                                            <td class="px-4 py-2">
                                                <div class="w-6 h-6 rounded-full border shadow-sm" style="background-color: {{ $product->color }}">
                                            </td>
                                            <td class="px-4 py-2">{{FormatRupiah($product->price)}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

        </div>
    </div>
</x-app-layout>
