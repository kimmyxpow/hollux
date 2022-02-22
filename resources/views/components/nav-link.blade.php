@props(['active'])

@php
$classes = ($active ?? false)
            ? "text-sm font-medium block after:content-[''] after:block after:h-0.5 after:bg-gray-800 text-gray-600 after:rounded-full after:w-4/5 after:transition-all after:duration-300"
            : "text-sm font-medium block after:content-[''] after:block after:h-0.5 after:bg-gray-800 text-gray-600 after:rounded-full after:w-0 hover:after:w-4/5 after:transition-all after:duration-300";
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
