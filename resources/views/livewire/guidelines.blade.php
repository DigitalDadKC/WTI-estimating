<div>
    <div class="px-6">
        @include('livewire.includes-guidelines.create-guideline')
    </div>
    <x-flash-message on="created">{{ __('GUIDELINE CREATED') }}</x-flash-message>
    <div class="w-full">
        @include('livewire.includes-guidelines.guideline-search')
    </div>
    <div class="grid sm:grid-cols-2 gap-2">
        @foreach($guidelines as $index => $guideline)
            @include('livewire.includes-guidelines.guideline-card')
        @endforeach
        <div class="my-2">
            {{$guidelines->links() }}
        </div>
    </div>
    <x-flash-message on="updated">{{ __('GUIDELINE UPDATED') }}</x-flash-message>
    <x-flash-message on="deleted">{{ __('GUIDELINE DELETED') }}</x-flash-message>
</div>