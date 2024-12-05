<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('List Penjualan') }}
        </h2>
    </x-slot>

    <div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <!-- Search Form -->
            <div class="mb-4">
                <form action="{{ route('sales.index') }}" method="GET" class="flex gap-4">
                    <!-- Membuat kolom search lebih lebar dengan flex-grow atau w-full -->
                    <input type="text" name="search" value="{{ request('search') }}" class="rounded-lg w-full border-gray-300 flex-grow h-[38px]" placeholder="Search sales by buyer name or product name...">

                    <!-- Start Date Input -->
                    <input type="date" name="start_date" value="{{ old('start_date', $startDate) }}" class="rounded-lg border-gray-300 flex-1 h-[38px]" placeholder="Start Date">

                    <!-- End Date Input -->
                    <input type="date" name="end_date" value="{{ old('end_date', $endDate) }}" class="rounded-lg border-gray-300 flex-1 h-[38px]" placeholder="End Date">

                    <button type="submit" class="inline-flex h-[38px] items-center px-4 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-white hover:bg-blue-600 focus:bg-blue-600 active:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        Search
                    </button>
                </form>

            </div>

            <div class="relative overflow-x-auto bg-white shadow-lg rounded-lg p-6">
                <!-- Success Message -->
                @if(session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
                    {{ session('success') }}
                </div>
                @endif

                <!-- Error Message -->
                @if(session('error'))
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert">
                    {{ session('error') }}
                </div>
                @endif

                <div class="flex justify-between items-center mb-4">
                    <div class="justify-start">
                        <h3 class="text-lg font-medium mb-4">Sales</h3>
                        <a href="{{ route('sales.export') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition duration-150 ease-in-out">
                            Export to Excel
                        </a>
                    </div>

                    <a href="{{ route('sales.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition duration-150 ease-in-out">
                        Add Sale
                    </a>
                </div>

                <table class="w-full text-sm text-left text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3">No</th>
                            <th scope="col" class="px-6 py-3">Buyer Name</th>
                            <th scope="col" class="px-6 py-3">Product</th>
                            <th scope="col" class="px-6 py-3">Sale Price</th>
                            <th scope="col" class="px-6 py-3">Sale Date</th>
                            <th scope="col" class="px-6 py-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($sales as $index => $sale)
                        <tr class="bg-white border-b hover:bg-gray-50">
                            <td class="px-6 py-4">
                                {{ ($sales->currentPage() - 1) * $sales->perPage() + $index + 1 }}
                            </td>
                            <td class="px-6 py-4 font-medium text-gray-900">
                                {{ $sale->buyer_name }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $sale->product->name ?? 'N/A' }}
                            </td>
                            <td class="px-6 py-4">
                                {{ FormatRupiah($sale->sale_price) }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $sale->sale_date }}
                            </td>
                            <td class="px-6 py-4 space-x-2">
                                <div class="flex space-x-2">
                                    <a href="{{ route('sales.show', $sale) }}" class="px-3 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600 transition duration-150 ease-in-out">
                                        Detail
                                    </a>
                                    <form action="{{ route('sales.destroy', $sale) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this sale?');">
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
                            <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                                No sales found
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="mt-4">
                    {{ $sales->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
