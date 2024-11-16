@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-gray-300 shadow-sm', 'style' => 'border-radius:30px; background-color: #E7E6E6;']) !!}>
