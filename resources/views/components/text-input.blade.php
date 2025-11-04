@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge([
    'class' => 'border-green-300 focus:border-green-400 focus:ring-green-500 rounded-md shadow-sm',
]) !!}>
