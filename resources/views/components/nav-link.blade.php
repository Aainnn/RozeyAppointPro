@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center text-sm font-bold text-pink-600 uppercase tracking-wide focus:outline-none transition duration-150 ease-in-out'
            : 'inline-flex items-center text-sm font-bold text-black uppercase tracking-wide hover:text-pink-600 focus:outline-none transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
