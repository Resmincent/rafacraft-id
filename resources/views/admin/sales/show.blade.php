<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Penjualan') }}
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
        <div class="bg-white shadow-2xl rounded-2xl overflow-hidden border-2 border-blue-100">
            {{-- Header Section with Gradient --}}
            <div class="bg-gradient-to-r from-blue-500 to-purple-600 p-6">
                <h3 class="text-2xl font-bold text-white">{{ $sale->product->name }}</h3>
            </div>

            {{-- Details Grid --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 p-8">
                {{-- Product Details --}}
                <div class="space-y-4">
                    <div class="bg-gray-50 p-4 rounded-xl shadow-sm">
                        <label class="block text-xs font-semibold text-gray-500 mb-1">{{ __('Buyer Name') }}</label>
                        <p class="text-lg font-bold text-gray-800 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-blue-500" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                            </svg>
                            {{ $sale->buyer_name }}
                        </p>
                    </div>

                    <div class="bg-gray-50 p-4 rounded-xl shadow-sm">
                        <label class="block text-xs font-semibold text-gray-500 mb-1">{{ __('Sale Date') }}</label>
                        <p class="text-lg font-bold text-gray-800 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-blue-500" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
                            </svg>
                            {{ $sale->sale_date }}
                        </p>
                    </div>
                </div>

                {{-- Financial Details --}}
                <div class="space-y-4">
                    <div class="bg-green-50 p-4 rounded-xl shadow-sm">
                        <label class="block text-xs font-semibold text-green-600 mb-1">{{ __('Sale Price') }}</label>
                        <p class="text-2xl font-extrabold text-green-700 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            {{ FormatRupiah($sale->sale_price) }}
                        </p>
                    </div>

                    {{-- Optional: Product Category or Additional Info --}}
                    <div class="bg-gray-50 p-4 rounded-xl shadow-sm">
                        <label class="block text-xs font-semibold text-gray-500 mb-1">{{ __('Product Category') }}</label>
                        <p class="text-lg font-bold text-gray-800 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-blue-500" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z" />
                            </svg>
                            {{ $sale->product->category->name ?? 'Not Specified' }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
