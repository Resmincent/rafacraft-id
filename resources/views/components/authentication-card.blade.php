<div class="min-h-screen flex items-center justify-center bg-gray-100">
    <div class="w-full max-w-md px-6 py-4 bg-white shadow-md sm:rounded-lg">
        <div class="flex items-center space-x-4 mb-4">
            <hr class="h-1 border border-1 w-full">
            <div class="flex flex-col items-center">
                {{ $logo }}
            </div>
            <hr class="h-1 border border-1 w-full">
        </div>
        {{ $slot }}
    </div>
</div>
