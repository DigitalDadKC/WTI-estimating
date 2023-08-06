@props(['disabled' => false])

<textarea {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border border-emerald-700 bg-white p-2 rounded-md shadow-sm']) !!}>
    {{ $value ?? $slot }}
</textarea>