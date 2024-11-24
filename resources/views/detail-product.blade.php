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
    <nav class="bg-white border-b border-gray-300 dark:bg-gray-900 dark:border-gray-700 shadow-lg">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">

            <div class="flex items-center space-x-5">
                <button x-on:click="open = true" class="px-4 py-2 text-black rounded-md">
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15" />
                    </svg>
                </button>

                <a href='{{ route('home') }}'>
                    <x-rafa-logo class="block h-9 w-auto" />
                </a>
            </div>

            <div class="hidden w-full md:block md:w-auto" id="navbar-default">
                <div class="flex items-center space-x-8">
                    <ul class="font-medium flex flex-col p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
                        <li>
                            <a href="{{ route('home') }}" class="block py-2 px-3 text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:p-0 dark:text-white md:dark:text-blue-500" aria-current="page">Home</a>
                        </li>
                        <a href="{{ route('cart.index') }}" class="relative text-[#C07CA5] font-semibold">
                            Cart
                            <span class="absolute -top-2 -right-4 bg-[#C07CA5] text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">
                                {{ $cartItems->count() }}
                            </span>
                        </a>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <div class="bg-gradient-to-r from-pink-100 to-purple-100 h-[40px] flex items-center justify-center space-x-8 text-gray-700">
    </div>
    <!-- Main Container -->
    <div class="flex justify-center items-center">
        <div class="py-12">
            <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
                <div class="overflow-hidden border sm:rounded-lg">
                    <div class="p-6">
                        <div class="grid grid-cols-1 lg:grid-cols-2">
                            <!-- Bagian Kiri - Gambar -->
                            <div class="space-y-2">
                                <!-- Thumbnail Utama -->
                                <div class="relative">
                                    @if($product->thumbnail)
                                    <div class="aspect-square w-full max-w-md mx-auto overflow-hidden rounded-lg ">
                                        <picture>
                                            <source srcset="{{ asset('storage/' . $product->thumbnail) }}" type="image/webp">
                                            <img src="{{ asset('storage/' . $product->thumbnail) }}" alt="{{ $product->name }}" class="w-full h-full object-contain transform hover:scale-105 transition-transform duration-300" id="mainImage">
                                        </picture>
                                    </div>
                                    @endif
                                </div>

                                <!-- Galeri Gambar -->
                                @if($product->images->count())
                                <div class="flex flex-wrap gap-2 justify-center max-w-md mx-auto">
                                    <!-- Thumbnail sebagai pilihan pertama -->
                                    @if($product->thumbnail)
                                    <div class="w-20 h-20 rounded-md overflow-hidden cursor-pointer hover:opacity-75 transition border-2 border-transparent hover:border-blue-500">
                                        <img src="{{ asset('storage/' . $product->thumbnail) }}" alt="Thumbnail" class="w-full h-full object-cover thumbnail-img" onclick="changeImage(this.src)">
                                    </div>
                                    @endif

                                    <!-- Gambar produk lainnya -->
                                    @foreach($product->images as $image)
                                    <div class="w-20 h-20 rounded-md overflow-hidden cursor-pointer hover:opacity-75 transition border-2 border-transparent hover:border-blue-500">
                                        <img src="{{ asset('storage/' . $image->image) }}" alt="Gambar Produk" class="w-full h-full object-cover thumbnail-img" onclick="changeImage(this.src)">
                                    </div>
                                    @endforeach
                                </div>
                                @endif
                            </div>

                            <!-- Bagian Kanan - Informasi Produk -->
                            <div class="space-y-3">
                                <!-- Header Produk -->
                                <div>
                                    <h1 class="text-2xl font-semibold text-gray-900 mb-2">{{ $product->name }}</h1>
                                    <span class="text-sm"><span>{{ _("(Pre Order: ") }}</span>{{ _($product->pre_order) }}<span>{{ _(")") }}</span></span>
                                </div>

                                <!-- Harga -->
                                <div class="bg-gray-50 rounded-lg">
                                    <div class="text-2xl">
                                        {{ FormatRupiah($product->price) }}
                                    </div>
                                </div>

                                <div class="flex items-center space-x-2">
                                    <div class="w-6 h-6 rounded-full border shadow-sm" style="background-color: {{ $product->color }}">
                                    </div>
                                    <span class="text-sm text-gray-500">Warna</span>
                                </div>

                                <!-- Informasi Detail -->
                                <div class="mb-3">
                                    <div class="items-center bg-gray-50 rounded-md">
                                        <span>Ukuran: </span>
                                        <span class="text-gray-700">{{ $product->size }}</span>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <div class="items-center bg-gray-50 rounded-md">
                                        <!-- Form untuk Tambah ke Keranjang -->
                                        <form action="{{ route('cart.add', $product->id) }}" method="POST" id="addToCartForm">
                                            @csrf
                                            {{-- <!-- Input Lokasi Pickup -->
                                            <x-input-auth id="pickup_cart" class="block mt-1 mb-2 w-full" type="text" name="pickup" :value="old('pickup')" required autofocus placeholder="Masukkan lokasi pickup" /> --}}

                                            <!-- Input Quantity -->
                                            <input type="number" name="quantity" value="1" min="1" class="form-control mb-3" style="width: 125px; margin: 0 auto; height:38px; border-radius: 8px">

                                            <!-- Tombol Tambah ke Keranjang -->
                                            <div class="mt-2 space-x-2 flex">
                                                <x-button-add-to-cart type="submit">
                                                    {{ __('Tambah Keranjang') }}
                                                </x-button-add-to-cart>
                                            </div>
                                        </form>
                                    </div>
                                </div>


                                <!-- Deskripsi -->
                                <div class="mt-6 border rounded-md shadow-sm">
                                    <h3 class="text-lg font-semibold mb-2 px-2 py-3">Produk Detail</h3>
                                    <div class="prose prose-sm text-gray-600 bg-gray-50 rounded-lg px-2 py-2">
                                        {!! $product->description !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <style>
            #mainImage {
                max-height: 400px;
                object-fit: contain;
                width: 100%;
            }

            .thumbnail-img {
                object-fit: cover;
                transition: all 0.3s ease;
            }

            .thumbnail-img:hover {
                transform: scale(1.05);
            }

            img {
                image-rendering: auto;
                -webkit-transform: translateZ(0);
                backface-visibility: hidden;
            }

        </style>

    </div>
    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js" defer></script>
    <script>
        function changeImage(src) {
            const mainImage = document.getElementById('mainImage');
            const currentSrc = mainImage.src;

            if (currentSrc !== src) {
                mainImage.style.opacity = '0';
                setTimeout(() => {
                    mainImage.src = src;
                    mainImage.style.opacity = '1';
                }, 300);
            }
        }


        document.addEventListener('DOMContentLoaded', function() {
            const thumbnails = document.querySelectorAll('.thumbnail-img');
            thumbnails.forEach(thumb => {
                thumb.addEventListener('click', function() {
                    thumbnails.forEach(t => t.parentElement.classList.remove('border-blue-500'));
                    this.parentElement.classList.add('border-blue-500');
                });
            });
        });

    </script>

    @livewireScripts
</body>
</html>
