@props(['on'])

<div 
    x-data="{show: false}"
    x-show="show"
    x-init="@this.on('{{ $on }}', () => {show = true; setTimeout(() => {show = false;}, 2000)})"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 transform scale-90"
    x-transition:enter-end="opacity-100 transform scale-100"
    x-transition:leave="transition ease-in duration-300"
    x-transition:leave-start="opacity-100 transform scale-100"
    x-transition:leave-end="opacity-0 transform scale-90"
    class="fixed top-2 left-1/2 transform -translate-x-1/2 font-bold text-lg rounded-lg bg-emerald-500 px-48 py-2 pointer-events-none z-50"
    style="display: none"
>
    <p>
        {{$slot->isEmpty() ? 'Saved' : $slot}}
    </p>
</div>