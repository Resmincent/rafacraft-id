<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Custom Bucket - {{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="shortcut icon" href="{{ asset('img/image 20.png') }}" />
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
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
                <button class="p-2 hover:bg-gray-100 rounded-full transition-colors duration-200">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
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
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <div class="container mx-auto px-4 py-12">
        <div class="max-w-2xl mx-auto bg-white shadow-lg rounded-lg p-8">
            <h1 class="text-3xl font-bold text-center mb-8 text-[#C07CA5]">Create Your Custom Bucket</h1>

            <form action="{{ route('custom-buckets.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="space-y-6">
                    <!-- Theme Input -->
                    <div>
                        <label for="tema" class="block text-sm font-medium text-gray-700">
                            Tema yang diingankan
                        </label>
                        <input type="text" name="tema" id="tema" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-[#C07CA5] focus:ring-[#C07CA5]" required>
                    </div>

                    <!-- Url input -->

                    <div>
                        <label for="url" class="block text-sm font-medium text-gray-700">
                            Url untuk referensi
                        </label>
                        <input type="text" name="url" id="url" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-[#C07CA5] focus:ring-[#C07CA5]" placeholder="https://www.instagram.com/p/C8qdHH8yBvH/?img_index=1" required>
                    </div>

                    <!-- Size Selection -->
                    <div>
                        <label for="size_id" class="block text-sm font-medium text-gray-700">
                            Ukuran Bouquet
                        </label>
                        <select name="size_id" id="size_id" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-[#C07CA5] focus:ring-[#C07CA5]" required>
                            <option value="">Pilih ukuran bouquet</option>
                            @foreach($sizes as $size)
                            <option value="{{ $size->id }}" data-price="{{ $size->price }}">
                                {{ ucfirst($size->size) }} - Rp {{ FormatRupiah($size->price) }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- daftar harga --}}
                    <h3 class="text-center">Tabel Harga Isiian Bouquet</h3>
                    <table class="w-full text-sm text-left text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3">No</th>
                                <th scope="col" class="px-6 py-3">Isian Bouquet</th>
                                <th scope="col" class="px-6 py-3">Harga</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($buckets as $index => $b)
                            <tr class="bg-white border-b">
                                <td class="px-6 py-4">{{ $index + 1 }}</td>
                                <td class="px-6 py-4">{{ $b->name }}</td>
                                <td class="px-6 py-4">{{ FormatRupiah($b->price) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- Bouquet Selection as Checkboxes -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">
                            Pilih isiian Bouquet
                        </label>
                        <div id="bouquet-container" class="grid grid-cols-2 gap-4 mt-2">
                            @foreach($buckets as $bouquet)
                            <div class="flex items-center">
                                <input type="checkbox" name="bouquets[]" id="bouquet-{{ $bouquet->id }}" value="{{ $bouquet->id }}" data-price="{{ $bouquet->price }}" class="bouquet-checkbox mr-2 text-[#C07CA5] focus:ring-[#C07CA5]">
                                <label for="bouquet-{{ $bouquet->id }}" class="flex-grow">
                                    {{ $bouquet->name }}
                                </label>
                                <input type="number" name="bouquet_quantities[{{ $bouquet->id }}]" min="0" value="0" class="bouquet-quantity w-16 rounded-lg border-gray-300 text-sm ml-2" disabled>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Price Calculation (Hidden) -->
                    <input type="hidden" name="price" id="total-price" value="0">

                    <!-- Price Display -->
                    <div id="price-display" class="text-right font-bold text-lg">
                        Total Harga: Rp <span id="displayed-price">0</span>
                    </div>

                    <!-- Submit Button -->
                    <div class="pt-6">
                        <button type="submit" class="w-full bg-[#C07CA5] text-white py-3 rounded-lg hover:bg-[#a1638a] transition duration-300">
                            Pesan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sizeSelect = document.getElementById('size_id');
            const bouquetCheckboxes = document.querySelectorAll('.bouquet-checkbox');
            const bouquetQuantities = document.querySelectorAll('.bouquet-quantity');
            const totalPriceInput = document.getElementById('total-price');
            const displayedPriceSpan = document.getElementById('displayed-price');

            bouquetCheckboxes.forEach((checkbox, index) => {
                checkbox.addEventListener('change', function() {
                    const quantityInput = bouquetQuantities[index];
                    quantityInput.disabled = !this.checked;
                    if (!this.checked) {
                        quantityInput.value = 0;
                    }
                    calculatePrice();
                });
            });

            bouquetQuantities.forEach(quantityInput => {
                quantityInput.addEventListener('change', calculatePrice);
                quantityInput.addEventListener('input', calculatePrice);
            });

            function calculatePrice() {
                if (!sizeSelect.value) {
                    totalPriceInput.value = 0;
                    displayedPriceSpan.textContent = '0';
                    return;
                }

                const sizePrice = parseFloat(sizeSelect.options[sizeSelect.selectedIndex].getAttribute('data-price')) || 0;
                let totalPrice = sizePrice;

                bouquetCheckboxes.forEach((checkbox, index) => {
                    if (checkbox.checked) {
                        const bouquetPrice = parseFloat(checkbox.getAttribute('data-price')) || 0;
                        const quantity = parseInt(bouquetQuantities[index].value) || 0;
                        totalPrice += bouquetPrice * quantity;
                    }
                });

                totalPriceInput.value = totalPrice;
                displayedPriceSpan.textContent = totalPrice.toLocaleString('id-ID');
            }

            sizeSelect.addEventListener('change', calculatePrice);
        });

    </script>
</body>
</html>
