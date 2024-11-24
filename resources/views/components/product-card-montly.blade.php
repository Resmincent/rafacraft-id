<div class="relative group w-64 h-64 overflow-hidden rounded-lg shadow-lg transition-all duration-300 hover:shadow-xl">
    {{-- Product Image --}}
    <img src="{{ asset('storage/' . $montly->thumbnail) }}" alt="{{ $montly->name }}" class="w-full h-full object-cover" />

    <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-30 transition-all duration-300 flex items-end justify-center pb-3">
        <div class="bg-white px-6 py-3 transform scale-0 group-hover:scale-100 transition-transform duration-300">
            <h3 class="text-gray-600 text-center">
                {{ $montly->name }}
            </h3>
            <p class="text-gray-800 text-center text-lg font-semibold">
                {{ FormatRupiah($montly->price) }}
            </p>
        </div>
    </div>
</div>
