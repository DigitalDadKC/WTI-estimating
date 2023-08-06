<div class="w-96 lg:w-full ">
    <x-textarea onkeydown="if(event.keyCode ==13) return false;" type="text" class="w-full resize-none" placeholder="Enter Guideline..." wire:model.debounce.50ms="guideline" wire:keydown.enter.debounce.20ms="addGuideline">
    </x-textarea>
    @error('guideline')
        <p class="text-red-500 mt-2">{{$message}}</p>
    @enderror
    <div class="font-italic p-2 justify-center text-emerald-700 font-bold text-lg absolute"
        x-data="{show: false}"
        x-show="show"
        x-transition
        x-init="@this.on('saved', () => {show = true; setTimeout(() => {show = false;}, 2000) })"
        style="display: none;"
        >Guideline Added!
    </div>
</div>