<x-app-layout>
    <x-slot name="pageheader">
        {{ __('Pricebook') }}
    </x-slot>

    <div class="p-4">
        @livewire('pricebooks')
    </div>
</x-app-layout>
