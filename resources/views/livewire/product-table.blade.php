 <div>
     <div class="mb-4 flex gap-4">
         <input type="text" wire:model.debounce.300ms="search" placeholder="Search products by name, color, size or price..." class="rounded-lg border-gray-300 w-full h-[38px]" />
         <button wire:click="searchProducts" class="h-[38px] px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 transition">
             Search
         </button>
     </div>
     <table class="w-full text-sm text-left text-gray-500">
         <thead class="text-xs text-gray-700 uppercase bg-gray-50">
             <tr>
                 <th scope="col" class="px-6 py-3">No</th>
                 <th scope="col" class="px-6 py-3">Thumbnail</th>
                 <th scope="col" class="px-6 py-3">Product Name</th>
                 <th scope="col" class="px-6 py-3">Category</th>
                 <th scope="col" class="px-6 py-3">Price</th>
                 <th scope="col" class="px-6 py-3">Pre Order</th>
                 <th scope="col" class="px-6 py-3">Actions</th>
             </tr>
         </thead>
         <tbody>
             @forelse ($products as $index => $product)
             <tr class="bg-white border-b hover:bg-gray-50">
                 <td class="px-6 py-4">
                     {{ ($products->currentPage() - 1) * $products->perPage() + $index + 1 }}
                 </td>
                 <td class="px-6 py-4">
                     @if($product->thumbnail)
                     <img src="{{ Storage::url($product->thumbnail) }}" alt="{{ $product->name }}" class="w-16 h-16 object-cover rounded">
                     @else
                     <div class="w-16 h-16 bg-gray-200 rounded flex items-center justify-center">
                         <span class="text-gray-400">No image</span>
                     </div>
                     @endif
                 </td>
                 <td class="px-6 py-4 font-medium text-gray-900">
                     {{ $product->name }}
                 </td>
                 <td class="px-6 py-4">
                     {{ $product->category->name }}
                 </td>
                 <td class="px-6 py-4">
                     {{ FormatRupiah($product->price) }}
                 </td>
                 <td class="px-6 py-4">
                     {{ $product->pre_order }}
                 </td>
                 <td class="px-6 py-4 space-x-2">
                     <div class="flex space-x-2">
                         <a href="{{ route('products.show', $product) }}" class="px-3 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 transition duration-150 ease-in-out">
                             View
                         </a>
                         <a href="{{ route('products.edit', $product) }}" class="px-3 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600 transition duration-150 ease-in-out">
                             Edit
                         </a>
                         <form action="{{ route('products.destroy', $product) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this product?');">
                             @csrf
                             @method('DELETE')
                             <button type="submit" class="px-3 py-2 bg-red-500 text-white rounded hover:bg-red-600 transition duration-150 ease-in-out">
                                 Delete
                             </button>
                         </form>
                     </div>
                 </td>
             </tr>
             @empty
             <tr>
                 <td colspan="7" class="px-6 py-4 text-center text-gray-500">
                     No products found
                 </td>
             </tr>
             @endforelse
         </tbody>
     </table>

     <div class="mt-4">
         {{ $products->links() }}
     </div>
 </div>
