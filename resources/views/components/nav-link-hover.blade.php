@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center p-1 border-b-2 border-indigo-400 text-sm font-medium leading-5 text-gray-900 focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out'
            : 'inline-flex items-center p-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out';
@endphp

<li class="leading-relaxed py-1 px-4 bg-gray-100 hover:bg-gray-300 hover:shadow-inner transition duration-500 ease-in-out">
    <a {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </a>
</li>