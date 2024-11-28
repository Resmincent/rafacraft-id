<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="shortcut icon" href="{{ asset('img/image 20.png') }}" />
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />

    @livewireStyles
</head>

<body class="bg-gray-50 text-gray-800">
    <div class="bg-gradient-to-r from-pink-100 to-purple-100 h-[40px] flex items-center justify-center space-x-8 text-gray-700">
        <span class="px-8 text-sm font-medium">✨ Welcome to Rafacraft ✨</span>
        <span class="text-sm flex items-center">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
            </svg>
            Whatsapp Us: +62 851-7103-1412
        </span>
    </div>

    <!-- Navigation -->
    <nav class="bg-white border-b border-gray-200 shadow-md">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
            <div class="flex items-center space-x-5">
                <a href='{{ route('home') }}' class="transform hover:scale-105 transition-transform duration-200">
                    <x-rafa-logo class="block h-10 w-auto" />
                </a>
            </div>

            <div class="hidden w-full md:block md:w-auto" id="navbar-default">
                <div class="flex items-center space-x-8">
                    <ul class="font-medium flex items-center space-x-8">
                        <li>
                            <a href="{{ route('home') }}" class="text-gray-700 hover:text-[#C07CA5] transition-colors duration-200">Home</a>
                        </li>
                        <li>
                            <a href="{{ route('cart.index') }}" class="relative text-[#C07CA5] font-semibold">
                                Cart
                                <span class="absolute -top-2 -right-4 bg-[#C07CA5] text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">
                                    {{ $cartItems->count() }}
                                </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="min-h-screen bg-gray-50 py-12">
        <div class="container mx-auto px-4 max-w-7xl">
            <h2 class="text-3xl font-bold text-gray-800 mb-8">Keranjang</h2>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Cart -->
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-xl shadow-md overflow-hidden">
                        <div class="p-6">
                            <h4 class="text-xl font-semibold text-gray-800 mb-6">Daftar Barang</h4>

                            @if($cartItems->isEmpty())
                            <div class="flex flex-col items-center justify-center py-12">
                                <svg class="w-16 h-16 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                </svg>
                                <p class="text-gray-500 text-lg">Your cart is empty</p>
                                <a href="{{ route('home') }}" class="mt-4 inline-flex items-center px-4 py-2 bg-[#C07CA5] text-white rounded-lg hover:bg-[#A6698C] transition-colors">
                                    Continue Shopping
                                </a>
                            </div>
                            @else
                            <div class="space-y-6">
                                @foreach($cartItems as $item)
                                <div class="flex items-center space-x-6 p-4 bg-gray-50 rounded-xl hover:bg-gray-100 transition-colors duration-200">
                                    @if ($item->item_type === 'product' && $item->product)
                                    <div class="flex-shrink-0">
                                        <img src="{{ $item->product->thumbnail ? asset('storage/' . $item->product->thumbnail) : asset('default-product-image.jpg') }}" alt="{{ $item->product->name ?? 'Product' }}" class="w-24 h-24 object-cover rounded-lg shadow-md hover:shadow-lg transition-shadow duration-200">
                                    </div>

                                    <div class="flex-1">
                                        <h3 class="text-lg font-semibold text-gray-800">{{ $item->product->name ?? 'Unnamed Product' }}</h3>
                                        <p class="text-[#C07CA5] font-medium mt-1">{{ $item->product ? formatRupiah($item->product->price) : 'N/A' }}</p>

                                        <div class="flex items-center space-x-4 mt-4">
                                            <form action="{{ route('cart.update', $item->id) }}" method="POST" class="flex items-center space-x-2">
                                                @csrf
                                                @method('PATCH')
                                                <div class="flex items-center border rounded-lg overflow-hidden">
                                                    <button type="button" onclick="this.parentNode.querySelector('input').stepDown()" class="px-3 py-1 bg-gray-100 hover:bg-gray-200 transition-colors">
                                                        -
                                                    </button>
                                                    <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" class="w-16 text-center border-x py-1">
                                                    <button type="button" onclick="this.parentNode.querySelector('input').stepUp()" class="px-3 py-1 bg-gray-100 hover:bg-gray-200 transition-colors">
                                                        +
                                                    </button>
                                                </div>
                                                <button type="submit" class="text-sm text-[#C07CA5] hover:text-[#A6698C] transition-colors">
                                                    Update
                                                </button>
                                            </form>

                                            <form action="{{ route('cart.remove', $item->id) }}" method="POST" class="flex-shrink-0">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-sm text-red-500 hover:text-red-700 transition-colors">
                                                    Remove
                                                </button>
                                            </form>
                                        </div>
                                    </div>

                                    <div class="text-lg font-semibold text-gray-800">
                                        {{ formatRupiah($item->product->price * $item->quantity) }}
                                    </div>

                                    @elseif ($item->item_type === 'custom_bucket')
                                    <div class="flex-shrink-0">
                                        <img src="{{ $item->customBucket->image ? asset('storage/' . $item->customBucket->image) : asset('default-bucket-image.jpg') }}" alt="{{ $item->customBucket->tema ?? 'Custom Bucket' }}" class="w-24 h-24 object-cover rounded-lg shadow-md hover:shadow-lg transition-shadow duration-200">
                                    </div>

                                    <div class="flex-1">
                                        <h3 class="text-lg font-semibold text-gray-800">{{ $item->customBucket->tema ?? 'Unnamed Bucket' }}</h3>
                                        <p class="text-[#C07CA5] font-medium mt-1">{{ $item->customBucket ? formatRupiah($item->customBucket->price) : 'N/A' }}</p>
                                        <div class="flex items-center space-x-4 mt-4">
                                            <form action="{{ route('cart.update', $item->id) }}" method="POST" class="flex items-center space-x-2">
                                                @csrf
                                                @method('PATCH')
                                                <div class="flex items-center border rounded-lg overflow-hidden">
                                                    <button type="button" onclick="this.parentNode.querySelector('input').stepDown()" class="px-3 py-1 bg-gray-100 hover:bg-gray-200 transition-colors">
                                                        -
                                                    </button>
                                                    <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" class="w-16 text-center border-x py-1">
                                                    <button type="button" onclick="this.parentNode.querySelector('input').stepUp()" class="px-3 py-1 bg-gray-100 hover:bg-gray-200 transition-colors">
                                                        +
                                                    </button>
                                                </div>
                                                <button type="submit" class="text-sm text-[#C07CA5] hover:text-[#A6698C] transition-colors">
                                                    Update
                                                </button>
                                            </form>

                                            <form action="{{ route('cart.remove', $item->id) }}" method="POST" class="flex-shrink-0">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-sm text-red-500 hover:text-red-700 transition-colors">
                                                    Remove
                                                </button>
                                            </form>
                                        </div>
                                    </div>

                                    <div class="text-lg font-semibold text-gray-800">
                                        {{ formatRupiah($item->customBucket->price * $item->quantity) }}
                                    </div>

                                    @endif
                                </div>
                                @endforeach
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Order Summary  -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-xl shadow-md overflow-hidden sticky top-4">
                        <div class="p-6">
                            <h4 class="text-xl font-semibold text-gray-800 mb-6">Ringkasan Pesanan</h4>

                            <div class="space-y-4">
                                <div class="flex justify-between text-gray-600">
                                    <span>Subtotal</span>
                                    <span>{{ formatRupiah($total) }}</span>
                                </div>

                                <div class="border-t border-gray-200 pt-4 mt-4">
                                    <div class="flex justify-between text-lg font-semibold text-gray-800">
                                        <span>Total</span>
                                        <span>{{ formatRupiah($total) }}</span>
                                    </div>
                                </div>
                            </div>

                            @if(!$cartItems->isEmpty())
                            <a href="{{ route('checkout.index') }}" class="mt-6 w-full inline-flex items-center justify-center px-6 py-3 bg-[#C07CA5] text-white text-lg font-medium rounded-lg hover:bg-[#A6698C] transform hover:scale-105 transition-all duration-200">
                                Beli
                            </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>

    @livewireScripts
</body>
</html>
