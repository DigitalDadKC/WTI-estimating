<div class="">
    <div class="flex flex-col items-center p-4 space-y-2 flex-nowrap overflow-x-auto">
        <div class="font-italic p-2 text-emerald-700 font-bold text-lg"
            x-data="{show: false}"
            x-show="show"
            x-transition
            x-init="@this.on('updated', () => {show = true; setTimeout(() => {show = false;}, 2000) })"
            style="display: none;"
            >Guideline Updated!
        </div>
        <div class="font-italic p-2 text-red-700 font-bold text-lg"
            x-data="{show: false}"
            x-show="show"
            x-transition
            x-init="@this.on('deleted', () => {show = true; setTimeout(() => {show = false;}, 2000) })"
            style="display: none;"
            >Guideline Deleted!
        </div>
        @foreach($guidelines as $index => $guideline)
            <div class="flex items-center space-y-2 w-full">
                <div class="w-24">
                    {{$guideline['user']['name']}}
                </div>
                @if(auth()->id() == $guideline['user_id'])
                    @if($editedGuidelineIndex === $index || $editedGuidelineField === $index.'.guideline')
                        <x-text-input class="w-full" type="text"
                            @click.away="$wire.editedGuidelineField === '{{$index}}.guideline' ? $wire.saveGuideline({{$index}}) : null"
                            @keydown.enter="$wire.saveGuideline({{$index}})"
                            wire:model.defer.debounce.20ms="guidelines.{{$index}}.guideline"
                        />
                        @if($errors->has('guidelines.'.$index.'.guideline'))
                            <div class="text-red-500">
                                {{$errors->first('guidelines.'.$index.'.guideline')}}
                            </div>
                        @endif
                    @else
                        <div class="block cursor-pointer hover:bg-gray-400 rounded-md px-1" wire:click="editGuidelineField({{$index}}, 'guideline') ">
                            {{$guideline['guideline']}}
                        </div>
                    @endif
                @else
                    <div class="block overflow-x-auto whitespace-nowrap">
                        {{$guideline['guideline']}}
                    </div>
                @endif
                @if(auth()->id() == $guideline['user_id'])
                    <div class="" wire:click.prevent="deleteGuideline({{$index}})">
                        <i class="fa-solid fa-lg fa-trash hover:text-red-500"></i>
                    </div>
                @endif
            </div>
        @endforeach
    </div>
</div>
