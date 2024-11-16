<div class="min-h-screen h-[633px] w-[617px] flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
        <div class="flex items-center space-x-4 mb-4">
            <hr class="h-1 border border-1 w-full">
            <div class="flex flex-col items-center">
                {{ $logo }}
            </div>
            <hr class="h-1 border border-1  w-full">
        </div>
        {{ $slot }}
    </div>
</div>
