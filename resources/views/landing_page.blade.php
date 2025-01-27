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

<body x-data="{ open: false }" class="bg-gray-50 text-gray-800 font-sans antialiased">
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
                        @if(auth()->check() && auth()->user()->is_admin)
                        <a class="nav-link font-weight-bold text-gray-700" href="{{ route('dashboard') }}">
                            <x-button-see>
                                Dashboard Admin
                            </x-button-see>
                        </a>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <div class="bg-gradient-to-r from-pink-100 to-purple-100 h-[40px] flex items-center justify-center space-x-8 text-gray-700">
    </div>
    <!-- Main Container -->
    <div class="min-h-screen bg-white">
        <!-- Sidebar Overlay -->
        <div x-show="open" class="fixed inset-0 z-50 overflow-hidden" x-cloak>
            <div x-show="open" x-transition:enter="transition-opacity ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity ease-in duration-300" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="absolute inset-0 bg-slate-300 bg-opacity-75 transition-opacity"></div>
            <!-- Sidebar Content -->
            <section class="absolute inset-y-0 left-0 pr-10 max-w-full flex">
                <div x-show="open" x-transition:enter="transition-transform ease-out duration-300" x-transition:enter-start="transform -translate-x-full" x-transition:enter-end="transform translate-x-0" x-transition:leave="transition-transform ease-in duration-300" x-transition:leave-start="transform translate-x-0" x-transition:leave-end="transform -translate-x-full" class="w-[500px]">
                    <div class="h-full flex flex-col py-6 bg-white shadow-xl">
                        <!-- Sidebar Header -->
                        <div class="flex items-center justify-between px-4 py-3 border-b border-gray-200 shadow-sm">
                            <!-- Tombol Kembali -->
                            <div class="flex items-center">
                                <button x-on:click="open = false" class="text-gray-500 hover:text-gray-700">
                                    <span class="sr-only">Close</span>
                                    <svg width="38" height="32" viewBox="0 0 38 32" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                        <rect width="38" height="32" fill="url(#pattern0_17_57)" />
                                        <defs>
                                            <pattern id="pattern0_17_57" patternContentUnits="objectBoundingBox" width="1" height="1">
                                                <use xlink:href="#image0_17_57" transform="matrix(0.00896552 0 0 0.01 0.0517241 0)" />
                                            </pattern>
                                            <image id="image0_17_57" width="100" height="100" xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAGQAAABkCAYAAABw4pVUAAAACXBIWXMAAAsTAAALEwEAmpwYAAABCUlEQVR4nO3csUrEQBSF4XvyCm5ns2+tla+0/Vjso0QEBTtTxaN+H9wuxZCfgYEwmQEAAAAAAAAAAIDvbTNzOfAcJ8jMPM/MfWau3nhHjP1jRCmKsYvSF2MXpS/GLsq5p6mXAzE+53VmHk9c37+Sgzvj69xm5uGnF/4XRYweEaNHxOgRMXpEjB4Ro0fE6BExekSMHhGjR8ToETF6iFFEjCJiFBGjiBhFxCgM8uTTaxdRColSSJRCohQSpVCcvvpElD4RpU9E6RNR+kSUPhGlT0TpE1H6RJQ+EaVPROkTUfpsrkX/3p2y3FHvibLE6ImyxOiJssToibLE6LH5xR8AAAAAAAAAAADv3gDRQSeBJYNjcgAAAABJRU5ErkJggg==" />
                                        </defs>
                                    </svg>
                                </button>
                                <button class="ml-2 font-medium text-base" x-on:click="open = false">Back</button>
                            </div>
                            <!-- Kategori Title -->
                            <h3 class="text-lg font-medium">Kategori</h3>
                        </div>

                        <!-- Sidebar Content -->
                        <div class="mt-4 px-4 h-full overflow-auto">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                @foreach ($categories as $category)
                                <div class="bg-white rounded-lg shadow-sm hover:shadow-md transition-shadow duration-300 border border-gray-200 h-32">
                                    <form method="GET" action="{{ route('landing') }}">
                                        <input type="hidden" name="category_id" value="{{ $category->id }}">
                                        <button type="submit" class="h-full w-full">
                                            <div class="h-full p-6 flex flex-col items-center justify-center">
                                                @if($category->cover)
                                                <img src="{{ asset('storage/' . $category->cover) }}" alt="{{ $category->name }}" class="w-8 h-8 mb-2" />
                                                @else
                                                <div class="w-8 h-8 mb-2 rounded-full"></div>
                                                @endif
                                                <h6 class="text-gray-800 text-base font-semibold text-center">{{ $category->name }}</h6>
                                            </div>
                                        </button>
                                    </form>
                                </div>
                                @endforeach

                                {{-- kustom --}}
                                <a href="{{ route('custom-buckets.create') }}">
                                    <div class="bg-white rounded-lg shadow-sm hover:shadow-md transition-shadow duration-300 border border-gray-200 h-32">
                                        <div class="h-full p-6 flex flex-col items-center justify-center">
                                            <svg width="30" height="30" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                                <rect width="100" height="100" fill="url(#pattern0_26_258)" />
                                                <defs>
                                                    <pattern id="pattern0_26_258" patternContentUnits="objectBoundingBox" width="1" height="1">
                                                        <use xlink:href="#image0_26_258" transform="scale(0.01)" />
                                                    </pattern>
                                                    <image id="image0_26_258" width="100" height="100" xlink:href="data:image/png;base64,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" />
                                                </defs>
                                            </svg>
                                            <h6 class="text-gray-800 text-base font-semibold text-center">{{ _('Bouquet Custom') }}</h6>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>

                        <!-- Sidebar Footer -->
                        <div class="flex items-center justify-center px-4 py-3 border-t border-gray-200 shadow-sm">
                            <div class="flex items-center justify-center">
                                <a href="https://www.instagram.com/rafacraft.id/" target="_blank">
                                    <svg width="32" height="32" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                        <rect width="100" height="100" fill="url(#pattern0_26_365)" />
                                        <defs>
                                            <pattern id="pattern0_26_365" patternContentUnits="objectBoundingBox" width="1" height="1">
                                                <use xlink:href="#image0_26_365" transform="scale(0.01)" />
                                            </pattern>
                                            <image id="image0_26_365" width="100" height="100" xlink:href="data:image/png;base64,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" />
                                        </defs>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <div class="max-w-7xl mx-auto py-6 px-4 sm:py-8 lg:py-10 sm:px-6 lg:px-8">
            <!-- Search Section -->
            <div class="max-w-3xl mx-auto mb-12">

                <form action="{{ route('landing') }}" method="GET" class="space-y-4">
                    <!-- Search Bar -->
                    <div class="relative">
                        <input type="search" name="search" value="{{ request('search') }}" class="block w-full p-4 ps-12 text-base text-gray-900 border border-gray-200 rounded-xl bg-white shadow-sm focus:ring-2 focus:ring-[#C07CA5] focus:border-[#C07CA5] transition-all duration-200" placeholder="Search by product name, price or size..." />
                        <button type="submit" class="absolute end-2.5 bottom-2.5 px-6 py-2 text-sm font-medium text-white bg-[#C07CA5] rounded-lg hover:bg-[#A6698C] focus:ring-4 focus:ring-[#C07CA5]/50 transition-all duration-200">
                            Search
                        </button>
                    </div>
                </form>
            </div>

            <!-- Search Results -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @forelse ($products as $product)
                <a href="{{ route('detailProduct', $product->id) }}" class="group">
                    @include('components.product-card', ['product' => $product])
                </a>
                @empty
                <div class="col-span-full flex flex-col items-center justify-center py-12">
                    <svg class="w-16 h-16 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">No products found</h3>
                    <p class="text-gray-500">Try adjusting your search or filter to find what you're looking for.</p>
                </div>
                @endforelse
            </div>

            <!-- Show results count if searching -->
            @if(request('search'))
            <div class="mt-6 text-center text-gray-600">
                Found {{ $products->count() }} results for "{{ request('search') }}"
            </div>
            @endif
        </div>
    </div>

    <footer class="bg-[#C07CA5]">
        <div class="mx-auto w-full">
            <div class="px-10 py-10 lg:py-10">
                <div>
                    <h1 class="mb-6 text-lg font-semibold text-white uppercase dark:text-white">Informasi Toko</h1>
                    <ul class="text-gray-500 dark:text-gray-400 font-medium">
                        <li class="mb-2">
                            <span class="hover:underline text-white" style="font-size: 13px">Address: Permata Regensi Blok.A5 No.22 Cibitung Kabupaten Bekasi Jawa Barat</span>
                        </li>
                        <li class="mb-2">
                            <span class="hover:underline text-white" style="font-size: 13px">Whatsapp Us: +62 851-7103-1412</span>
                        </li>
                        <li class="mb-2">
                            <span class="hover:underline text-white" style="font-size: 13px">Hours: 10.30am - 6pm</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>

    <style>
        [x-cloak] {
            display: none !important;
        }

    </style>
    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>

    @livewireScripts
</body>

</html>
