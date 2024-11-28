<div class="border rounded-lg relative" style="border-radius:12px; height:330px">
    {{-- Product Image --}}
    <img src="{{ asset('storage/' . $product->thumbnail) }}" alt="{{ $product->name }}" class="w-full h-full object-cover" />
    <div class="justify-between flex">
        <div class="flex items-start justify-start pb-3">
            <div class="bg-white py-3">
                <h3 class="text-gray-600 text-start">
                    {{ $product->name }}
                </h3>
                <p class="text-gray-800 text-start text-lg font-semibold">
                    {{ FormatRupiah($product->price) }}
                </p>
                <div class="w-6 h-6 rounded-full border shadow-sm" style="background-color: {{ $product->color }}"></div>
            </div>
        </div>
        <div class="justify-end flex items-center pb-3 mr-3">
            <span class="w-15 h-15 rounded-full border px-2 shadow-sm">Size: {{ $product->size }}</span>
        </div>
    </div>
</div>
