<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Produk') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                        <!-- Bagian Kiri - Gambar -->
                        <div class="space-y-4">
                            <!-- Thumbnail Utama -->
                            <div class="relative">
                                @if($product->thumbnail)
                                <div class="aspect-square w-full max-w-md mx-auto overflow-hidden rounded-lg shadow-sm">
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
                        <div class="space-y-6">
                            <!-- Header Produk -->
                            <div>
                                <h1 class="text-2xl font-bold text-gray-900 mb-2">{{ $product->name }}</h1>
                                <div class="flex items-center space-x-4">
                                    <span class="px-3 py-1 bg-gray-100 text-gray-600 rounded-full text-sm">
                                        {{ $product->category->name }}
                                    </span>
                                    <div class="flex items-center space-x-2">
                                        <div class="w-6 h-6 rounded-full border shadow-sm" style="background-color: {{ $product->color }}">
                                        </div>
                                        <span class="text-sm text-gray-500">Warna</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Harga -->
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <div class="text-2xl font-bold text-gray-900">
                                    {{ FormatRupiah($product->price) }}
                                </div>
                            </div>

                            <!-- Informasi Detail -->
                            <div class="space-y-4">
                                @if($product->pre_order)
                                <div class="flex items-center bg-yellow-50 p-3 rounded-md">
                                    <svg class="w-5 h-5 text-yellow-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <span class="text-yellow-700">Pre Order: {{ $product->pre_order }}</span>
                                </div>
                                @endif

                                @if($product->pickup)
                                <div class="flex items-center bg-blue-50 p-3 rounded-md">
                                    <svg class="w-5 h-5 text-blue-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    <span class="text-blue-700">Pickup: {{ $product->pickup }}</span>
                                </div>
                                @endif

                                <div class="flex items-center bg-gray-50 p-3 rounded-md">
                                    <svg class="w-5 h-5 text-gray-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 2L6 22M18 2L18 22M3 6L21 6M3 18L21 18"></path>
                                    </svg>
                                    <span class="text-gray-700">Ukuran: {{ $product->size }}</span>
                                </div>
                            </div>

                            <!-- Deskripsi -->
                            <div class="mt-6">
                                <h3 class="text-lg font-semibold mb-2">Deskripsi Produk</h3>
                                <div class="prose prose-sm text-gray-600 bg-gray-50 p-4 rounded-lg">
                                    {!! $product->description !!}
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tombol Kembali -->
                    <div class="mt-8 pt-6 border-t">
                        <a href="{{ route('products.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-100 border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-200 active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-all duration-300">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                            {{ __('Kembali ke Daftar Produk') }}
                        </a>
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
</x-app-layout>
