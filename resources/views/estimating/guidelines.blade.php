<x-app-layout>
    <x-slot name="pageheader">
        {{ __('Guidelines') }}
    </x-slot>
    
    <div class="p-4 sm:py-12">
        <div class="md:container md:mx-auto grid grid-flow-row gap-8 grid-cols-1 lg:grid-cols-3">
            <div class="lg:col-span-1 flex justify-center pb-4">
                @livewire('add-guideline')
            </div>
            <div class="lg:col-span-2 border-4 border-emerald-700 rounded-md overflow-x-auto">
                @livewire('all-guidelines')
            </div>
        </div>
    </div>
</x-app-layout>