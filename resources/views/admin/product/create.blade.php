<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Produk') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="grid grid-cols-12 gap-6">
                            <div class="col-span-12 lg:col-span-9">
                                <div class="grid grid-cols-12 gap-6">
                                    <!-- Nama Produk -->
                                    <div class="col-span-12 lg:col-span-11">
                                        <div class="mb-4">
                                            <x-input type="text" name="name" class="mt-1 block w-full" id="name" value="{{ old('name') }}" required autofocus placeholder="Nama Produk" />
                                            <x-input-error for="name" class="mt-2" />
                                        </div>
                                    </div>

                                    <!-- Color Picker -->
                                    <div class="col-span-12 lg:col-span-1">
                                        <div class="mb-4">
                                            <div class="relative mt-1">
                                                <x-input type="color" name="color" class="absolute w-12 h-12 opacity-0 cursor-pointer" id="color" value="{{ old('color', '#000000') }}" required />
                                                <div class="w-12 h-12 rounded-full border-2 border-gray-300" style="background-color: {{ old('color', '#000000') }}" id="colorPreview"></div>
                                            </div>
                                            <x-input-error for="color" class="mt-2" />
                                        </div>
                                    </div>

                                    <!-- Kategori Dropdown -->
                                    <div class="col-span-12 lg:col-span-4 mt-1">
                                        <div class="mb-4">
                                            <select name="category_id" id="category_id" class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" required>
                                                <option value="" disabled selected>{{ __('Pilih Kategori') }}</option>
                                                @foreach($categories as $category)
                                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                                    {{ $category->name }}
                                                </option>
                                                @endforeach
                                            </select>
                                            <x-input-error for="category_id" class="mt-2" />
                                        </div>
                                    </div>

                                    <!-- Pre Order -->
                                    <div class="col-span-12 lg:col-span-4">
                                        <div class="mb-4">
                                            <x-input type="text" name="pre_order" class="mt-1 block w-full" id="pre_order" value="{{ old('pre_order') }}" required placeholder="Pre Order" />
                                            <x-input-error for="pre_order" class="mt-2" />
                                        </div>
                                    </div>

                                    <!-- Harga -->
                                    <div class="col-span-12 lg:col-span-4">
                                        <div class="mb-4">
                                            <x-input type="number" name="price" class="mt-1 block w-full" id="price" value="{{ old('price') }}" required placeholder="Harga" />
                                            <x-input-error for="price" class="mt-2" />
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Sidebar -->
                            <div class="col-span-12 lg:col-span-3">
                                <!-- Size Radio Buttons -->
                                <div class="mb-4">
                                    <x-label value="{{ __('Ukuran') }}" />
                                    @foreach(['S', 'M', 'L'] as $size)
                                    <label class="inline-flex items-center mt-2">
                                        <input type="radio" name="size" value="{{ $size }}" class="form-radio h-5 w-5 text-indigo-600" {{ old('size') == $size ? 'checked' : '' }} required>
                                        <span class="ml-2 text-gray-700">{{ $size }}</span>
                                    </label>
                                    @endforeach
                                    <x-input-error for="size" class="mt-2" />
                                </div>


                                <!-- Label Radio Buttons -->
                                <div class="mb-4">
                                    <x-label value="{{ __('Label') }}" />
                                    <div class="mt-2 space-y-2">
                                        <label class="inline-flex items-center">
                                            <input type="radio" name="label" value="best" class="form-radio h-5 w-5 text-indigo-600" {{ old('label') == 'best' ? 'checked' : '' }}>
                                            <span class="ml-2 text-gray-700">Best Product</span>
                                        </label>
                                        <label class="inline-flex items-center">
                                            <input type="radio" name="label" value="special" class="form-radio h-5 w-5 text-indigo-600" {{ old('label') == 'special' ? 'checked' : '' }}>
                                            <span class="ml-2 text-gray-700">Special Montly</span>
                                        </label>
                                        <label class="inline-flex items-center">
                                            <input type="radio" name="label" value="" class="form-radio h-5 w-5 text-indigo-600" {{ old('label') === null ? 'checked' : '' }}>
                                            <span class="ml-2 text-gray-700">No Label</span>
                                        </label>
                                    </div>
                                    <x-input-error for="label" class="mt-2" />
                                </div>

                                <!-- Thumbnail -->
                                <div class="mb-4">
                                    <x-label for="thumbnail" value="{{ __('Thumbnail Produk*') }}" />
                                    <input type="file" name="thumbnail" class="mt-1 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" id="thumbnail" required>
                                    <p class="mt-1 text-sm text-gray-500">Max 2MB (PNG, JPG, JPEG)</p>
                                    <div id="thumbnailPreview" class="mt-3"></div>
                                    <x-input-error for="thumbnail" class="mt-2" />
                                </div>

                                <!-- Product Images -->
                                <div class="mb-4">
                                    <x-label for="product_images" value="{{ __('Gambar Produk (Multiple)*') }}" />
                                    <input type="file" name="product_images[]" class="mt-1 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" id="product_images" multiple required>
                                    <p class="mt-1 text-sm text-gray-500">Max 2MB per file (PNG, JPG, JPEG)</p>
                                    <div id="imagePreview" class="mt-3 grid grid-cols-2 gap-2"></div>
                                    <x-input-error for="product_images" class="mt-2" />
                                </div>
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="mb-4">
                            <textarea name="description" id="description" rows="5" class="mt-1 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">{{ old('description') }}</textarea>
                            <x-input-error for="description" class="mt-2" />
                        </div>

                        <!-- Buttons -->
                        <div class="flex justify-end mt-6 gap-4">
                            <a href="{{ route('products.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-300 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-400 active:bg-gray-500 focus:outline-none focus:border-gray-500 focus:ring focus:ring-gray-300 disabled:opacity-25 transition">
                                {{ __('Batalkan') }}
                            </a>
                            <x-button>
                                {{ __('Simpan') }}
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.ckeditor.com/ckeditor5/35.4.0/classic/ckeditor.js"></script>
    <script>
        ClassicEditor.create(document.querySelector('#description'))
            .catch(error => {
                console.error(error);
            });

        document.getElementById('color').addEventListener('input', function(e) {
            document.getElementById('colorPreview').style.backgroundColor = e.target.value;
        });

        // Thumbnail preview
        document.getElementById('thumbnail').addEventListener('change', function(event) {
            const thumbnailPreview = document.getElementById('thumbnailPreview');
            thumbnailPreview.innerHTML = '';

            if (event.target.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    thumbnailPreview.innerHTML = `
                        <div class="relative">
                            <img src="${e.target.result}" class="rounded-lg object-cover w-full h-48">
                        </div>
                    `;
                }
                reader.readAsDataURL(event.target.files[0]);
            }
        });

        // Multiple images preview
        document.getElementById('product_images').addEventListener('change', function(event) {
            const imagePreview = document.getElementById('imagePreview');
            imagePreview.innerHTML = '';

            Array.from(event.target.files).forEach(file => {
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const div = document.createElement('div');
                        div.className = 'relative';
                        div.innerHTML = `
                            <div class="relative group">
                                <img src="${e.target.result}" class="rounded-lg object-cover w-full h-32">
                                <button type="button"
                                    class="absolute top-0 right-0 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center m-1 opacity-0 group-hover:opacity-100 transition-opacity"
                                    onclick="this.closest('.relative').remove()">
                                    ×
                                </button>
                            </div>
                        `;
                        imagePreview.appendChild(div);
                    }
                    reader.readAsDataURL(file);
                }
            });
        });

    </script>

</x-app-layout>
