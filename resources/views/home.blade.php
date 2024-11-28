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

<body class="bg-gray-50 text-gray-800 font-sans antialiased">

    <nav class="bg-white border-b border-gray-300 dark:bg-gray-900 dark:border-gray-700 shadow-lg">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">

            <div class="flex items-center space-x-5">
                <a href='{{ route('home') }}'>
                    <x-rafa-logo class="block h-9 w-auto" />
                </a>
            </div>

            <button data-collapse-toggle="navbar-default" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-default" aria-expanded="false">
                <span class="sr-only">Open main menu</span>
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15" />
                </svg>
            </button>
            <div class="hidden w-full md:block md:w-auto" id="navbar-default">
                <div class="flex items-center space-x-8">
                    <button type="button" id="user-menu-button" aria-expanded="false" data-dropdown-toggle="user-dropdown" data-dropdown-placement="bottom">
                        <span class="sr-only">Open user menu</span>
                        <svg width="39" height="39" viewBox="0 0 69 73" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <rect width="69" height="73" fill="url(#pattern0_1_1485)" />
                            <defs>
                                <pattern id="pattern0_1_1485" patternContentUnits="objectBoundingBox" width="1" height="1">
                                    <use xlink:href="#image0_1_1485" transform="matrix(0.01 0 0 0.00945205 0 0.0273973)" />
                                </pattern>
                                <image id="image0_1_1485" width="100" height="100" xlink:href="data:image/png;base64,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" />
                            </defs>
                        </svg>
                    </button>
                    <a href="{{ route('cart.index') }}">
                        <button>
                            <svg width="39" height="39" viewBox="0 0 71 82" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                <rect width="71" height="82" fill="url(#pattern0_1_1064)" />
                                <defs>
                                    <pattern id="pattern0_1_1064" patternContentUnits="objectBoundingBox" width="1" height="1">
                                        <use xlink:href="#image0_1_1064" transform="matrix(0.01 0 0 0.00865854 0 0.0670732)" />
                                    </pattern>
                                    <image id="image0_1_1064" width="100" height="100" xlink:href="data:image/png;base64,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" />
                                </defs>
                            </svg>
                        </button>
                    </a>

                    @if(auth()->check() && auth()->user()->is_admin)
                    <a class="nav-link font-weight-bold text-gray-700" href="{{ route('dashboard') }}">
                        <x-button-see>
                            Dashboard Admin
                        </x-button-see>
                    </a>
                    @endif
                </div>
                <!-- Dropdown menu -->
                <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-700 dark:divide-gray-600" id="user-dropdown">
                    <ul class="py-2" aria-labelledby="user-menu-button">
                        @guest
                        <li>
                            <a href="{{ route('login') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Login</a>
                        </li>
                        <li>
                            <a href="{{ route('register') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Register</a>
                        </li>
                        @else
                        <div class="px-4 py-3">
                            <span class="block text-sm text-gray-900 dark:text-white">{{ Auth::user()->name }}</span>
                        </div>
                        <li>
                            <form method="POST" action="{{ route('logout') }}" x-data>
                                @csrf
                                <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">
                                    Logout
                                </button>
                            </form>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <!-- Main Container -->
    <div class="min-h-screen bg-white">
        <div class="max-w-7xl mx-auto py-1 px-4 sm:py-3 lg:py-5 sm:px-6 lg:px-8">
            <h1 class="text-lg font-semibold my-5">Terlaris</h1>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach ($bests as $best)
                @include('components.product-card-best', ['product' => $best])
                @endforeach
            </div>
        </div>
        <a href="{{ route('landing') }}">
            <x-button-see class="mb-12 mt-12">
                {{ __('See More') }}
            </x-button-see>
        </a>
        <div class="max-w-7xl mx-auto py-1 px-4 sm:py-3 lg:py-5 sm:px-6 lg:px-8">
            <h1 class="text-lg font-semibold my-5">Spesial Bulanan</h1>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach ($montlys as $montly)
                @include('components.product-card-montly', ['product' => $montly])
                @endforeach
            </div>
        </div>
        <a href="{{ route('landing') }}">
            <x-button-see class="mb-12 mt-12">
                {{ __('See More') }}
            </x-button-see>
        </a>

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
    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>

    @livewireScripts
</body>

</html>
