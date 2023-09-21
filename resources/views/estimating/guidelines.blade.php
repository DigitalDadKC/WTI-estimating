<x-app-layout>
    <x-slot name="pageheader">
        {{ __('Guidelines') }}
    </x-slot>
    
    <div>
        @livewire('guidelines')
    </div>
</x-app-layout>