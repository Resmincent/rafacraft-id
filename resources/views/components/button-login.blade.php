<button {{ $attributes->merge([
    'type' => 'submit',
    'class' => 'inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest',
    'style' => 'background-color: #C07CA5; border-radius: 35px;'
]) }} onmouseover="this.style.backgroundColor='#A45C88';" onmouseout="this.style.backgroundColor='#C07CA5';">
    {{ $slot }}
</button>
