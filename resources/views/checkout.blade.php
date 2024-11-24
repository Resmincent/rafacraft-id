<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Checkout - {{ config('app.name', 'Laravel') }}</title>
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
    <nav class="bg-white border-b border-gray-300 shadow-lg">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
            <div class="flex items-center space-x-5">
                <a href='{{ route('home') }}'>
                    <x-rafa-logo class="block h-9 w-auto" />
                </a>
            </div>

            <div class="hidden w-full md:block md:w-auto">
                <div class="flex items-center space-x-8">
                    <ul class="font-medium flex flex-col p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:flex-row md:space-x-8 md:mt-0 md:border-0 md:bg-white">
                        <li>
                            <a href="{{ route('home') }}" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0">Home</a>
                        </li>
                        <li>
                            <a href="{{ route('cart.index') }}" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0">Cart</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <div class="bg-gradient-to-r from-pink-100 to-purple-100 h-[40px] flex items-center justify-center space-x-8 text-gray-700">
    </div>

    <!-- Main Container -->
    <div class="flex justify-center items-center min-h-screen py-12">
        <div class="container mx-auto px-4">
            <div class="max-w-5xl mx-auto">
                <h1 class="text-2xl font-semibold mb-8">Checkout</h1>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Checkout Form -->
                    <div class="lg:col-span-2">
                        <div class="bg-white rounded-xl shadow-md overflow-hidden">
                            <div class="p-6">
                                <h2 class="text-2xl font-semibold text-gray-800 mb-6">Informasi Pengiriman</h2>

                                @if ($errors->any())
                                <div class="mb-6 bg-red-50 p-4 rounded-lg">
                                    <div class="text-sm text-red-600">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                                @endif

                                <form action="{{ route('checkout.process') }}" method="POST">
                                    @csrf
                                    <div class="space-y-6">
                                        <!-- Customer Name -->
                                        <div>
                                            <label for="full_name" class="block text-sm font-medium text-gray-700">
                                                Nama Lengkap
                                            </label>
                                            <input type="text" name="full_name" id="full_name" value="{{ old('full_name') }}" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-[#C07CA5] focus:ring-[#C07CA5]" required>
                                        </div>

                                        <!-- Phone Number -->
                                        <div>
                                            <label for="phone_number" class="block text-sm font-medium text-gray-700">
                                                Nomor Telepon
                                            </label>
                                            <input type="tel" name="phone_number" id="phone_number" value="{{ old('phone_number') }}" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-[#C07CA5] focus:ring-[#C07CA5]" required>
                                        </div>

                                        <!-- Address -->
                                        <div>
                                            <label for="address" class="block text-sm font-medium text-gray-700">
                                                Alamat Lengkap
                                            </label>
                                            <textarea name="address" id="address" rows="3" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-[#C07CA5] focus:ring-[#C07CA5]" required>{{ old('address') }}</textarea>
                                        </div>

                                        <!-- City -->
                                        <div>
                                            <label for="city" class="block text-sm font-medium text-gray-700">
                                                Kota
                                            </label>
                                            <input type="text" name="city" id="city" value="{{ old('city') }}" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-[#C07CA5] focus:ring-[#C07CA5]" required>
                                        </div>

                                        <!-- Pickup Method -->
                                        <div>
                                            <label for="pickup" class="block text-sm font-medium text-gray-700">
                                                Metode Pengambilan
                                            </label>
                                            <select name="pickup" id="pickup" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-[#C07CA5] focus:ring-[#C07CA5]" required>
                                                <option value="pickup" {{ old('pickup') == 'pickup' ? 'selected' : '' }}>Ambil Sendiri</option>
                                                <option value="delivery" {{ old('pickup') == 'delivery' ? 'selected' : '' }}>Pengiriman</option>
                                            </select>
                                        </div>

                                        <div>
                                            <label for="delivery_date" class="block text-sm font-medium text-gray-700">
                                                Tanggal Pengambilan/Pengiriman
                                            </label>
                                            <input type="date" name="delivery_date" id="delivery_date" value="{{ old('delivery_date') }}" min="{{ $minDate }}" max="{{ $maxDate }}" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-[#C07CA5] focus:ring-[#C07CA5]" required>
                                        </div>

                                        <!-- Additional Notes -->
                                        <div>
                                            <label for="notes" class="block text-sm font-medium text-gray-700">
                                                Catatan Tambahan (Opsional)
                                            </label>
                                            <textarea name="notes" id="notes" rows="3" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-[#C07CA5] focus:ring-[#C07CA5]">{{ old('notes') }}</textarea>
                                        </div>

                                        <div class="pt-6">
                                            <x-button-wa>
                                                {{ _('Pesan Lewat WhatsApp') }}
                                            </x-button-wa>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Order Summary -->
                    <div class="lg:col-span-1">
                        <div class="bg-white rounded-xl shadow-md overflow-hidden sticky top-4">
                            <div class="p-6">
                                <h4 class="text-xl font-semibold text-gray-800 mb-6">Ringkasan Pesanan</h4>

                                <!-- Cart Items -->
                                <div class="space-y-4 mb-6">
                                    @foreach($cartItems as $item)
                                    <div class="flex justify-between items-start pb-4 border-b border-gray-200">
                                        <div>
                                            <h5 class="font-medium text-gray-800">
                                                {{ $item->item_type === 'product' ? $item->product->name : $item->customBucket->name }}
                                            </h5>
                                            <p class="text-sm text-gray-500">
                                                {{ $item->quantity }} x Rp {{ number_format($item->getPrice(), 0, ',', '.') }}
                                            </p>
                                        </div>
                                        <span class="font-medium text-gray-800">
                                            Rp {{ number_format($item->getPrice() * $item->quantity, 0, ',', '.') }}
                                        </span>
                                    </div>
                                    @endforeach
                                </div>

                                <!-- Total -->
                                <div class="border-t border-gray-200 pt-4 mt-4">
                                    <div class="flex justify-between text-lg font-semibold text-gray-800">
                                        <span>Total</span>
                                        <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
    @livewireScripts
</body>
</html>
