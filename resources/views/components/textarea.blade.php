@props(['disabled' => false, 'rows' => 3])

<textarea {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['rows' => $rows, 'class' => 'border border-emerald-700 bg-white p-2 rounded-md shadow-sm']) !!}>
    {{ $value ?? $slot }}
</textarea>