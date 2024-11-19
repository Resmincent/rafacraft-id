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
                            {{-- <p class="text-xl font-bold text-gray-900">{{ $widget['cars'] }}</p> --}}
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
                            {{-- <p class="text-xl font-bold text-gray-900">{{ $widget['motorcycles'] }}</p> --}}
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
                            {{-- <p class="text-xl font-bold text-gray-900">{{ $widget['users'] }}</p> --}}
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Data Penjualan -->
                <div>
                    <div class="bg-white shadow-md hover:shadow-lg transition duration-300 transform hover:scale-105 rounded-lg">
                        <h3 class="text-gray-600 text-xl font-semibold p-4">Data Penjualan</h3>
                        <div class="overflow-x-auto p-4">
                            <table class="min-w-full text-sm text-left text-gray-500">
                                <thead class="bg-gray-100 text-gray-600 font-bold">
                                    <tr>
                                        <th class="px-4 py-2">ID Penjualan</th>
                                        <th class="px-4 py-2">Nama Produk</th>
                                        <th class="px-4 py-2">Kategori</th>
                                        <th class="px-4 py-2">Status</th>
                                        <th class="px-4 py-2">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $sales = [
                                    ['id' => 'S001', 'product' => 'Laptop', 'category' => 'Elektronik', 'status' => 'Sukses', 'total' => 'Rp 15,000,000'],
                                    ['id' => 'S002', 'product' => 'Kamera', 'category' => 'Fotografi', 'status' => 'Pending', 'total' => 'Rp 7,500,000'],
                                    ['id' => 'S003', 'product' => 'Smartphone', 'category' => 'Elektronik', 'status' => 'Gagal', 'total' => 'Rp 8,000,000'],
                                    ];
                                    @endphp
                                    @foreach ($sales as $sale)
                                    <tr class="border-b hover:bg-gray-50">
                                        <td class="px-4 py-2">{{ $sale['id'] }}</td>
                                        <td class="px-4 py-2">{{ $sale['product'] }}</td>
                                        <td class="px-4 py-2">{{ $sale['category'] }}</td>
                                        <td class="px-4 py-2">
                                            <span class="text-xs font-semibold px-2 py-1 rounded {{
                                        $sale['status'] == 'Sukses' ? 'bg-green-100 text-green-800' :
                                        ($sale['status'] == 'Pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                                {{ $sale['status'] }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-2">{{ $sale['total'] }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Isian bouquet Overview -->
                <div>
                    <div class="bg-white shadow-md hover:shadow-lg transition duration-300 transform hover:scale-105 rounded-lg">
                        <h3 class="text-gray-600 text-xl font-semibold p-4">Isiian Bouquet</h3>
                        <div class="overflow-x-auto p-4">
                            <table class="min-w-full text-sm text-left text-gray-500">
                                <thead class="bg-gray-100 text-gray-600 font-bold">
                                    <tr>
                                        <th class="px-4 py-2">Purchase ID</th>
                                        <th class="px-4 py-2">Vendor Name</th>
                                        <th class="px-4 py-2">Name</th>
                                        <th class="px-4 py-2">Created</th>
                                        <th class="px-4 py-2">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $purchases = [
                                    ['id' => 'P001', 'vendor' => 'Vendor A', 'name' => 'John Doe', 'created' => '2024-11-15', 'total' => 'Rp 10,000,000'],
                                    ['id' => 'P002', 'vendor' => 'Vendor B', 'name' => 'Jane Doe', 'created' => '2024-11-16', 'total' => 'Rp 5,000,000'],
                                    ['id' => 'P003', 'vendor' => 'Vendor C', 'name' => 'Bob Smith', 'created' => '2024-11-17', 'total' => 'Rp 8,000,000'],
                                    ];
                                    @endphp
                                    @foreach ($purchases as $purchase)
                                    <tr class="border-b hover:bg-gray-50">
                                        <td class="px-4 py-2">{{ $purchase['id'] }}</td>
                                        <td class="px-4 py-2">{{ $purchase['vendor'] }}</td>
                                        <td class="px-4 py-2">{{ $purchase['name'] }}</td>
                                        <td class="px-4 py-2">{{ $purchase['created'] }}</td>
                                        <td class="px-4 py-2">{{ $purchase['total'] }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
