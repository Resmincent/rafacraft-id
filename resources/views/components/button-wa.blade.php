<div class="flex justify-center items-center">
    <button {{ $attributes->merge(['type' => 'submit', 'class' => ' w-full flex justify-center items-center px-6 py-3 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-50 transition ease-in-out duration-150', 'style' => 'background-color: #C694B2']) }}>
        {{ $slot }}
    </button>
</div>
