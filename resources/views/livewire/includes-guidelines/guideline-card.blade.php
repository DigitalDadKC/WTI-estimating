<div wire:key="{{$guideline->id}}" class="mb-2 px-4 py-2 bg-white border border-gray-800 rounded-md hover:shadow">
    <div class="flex items-start justify-between space-x-2">
        @if($editGuidelineID === $guideline->id)
            <x-text-input wire:model="editGuideline" type="text" placeholder="Todo.." class="bg-gray-100 text-gray-900 text-sm rounded block w-full" />
        @else
            <h3 class="text-lg text-semibold text-gray-800">{{$guideline->guideline}}</h3>
        @endif
        @if(auth()->id() === $guideline['user_id'])
            <div class="flex space-x-2">
                <button wire:click="edit({{$guideline->id}})" class="text-emerald-400 hover:text-emerald-600">
                    <i class="fa-solid fa-lg fa-wrench cursor-pointer"></i>
                </button>
                <div class="text-red-400 hover:text-red-600 cursor-pointer" wire:click.prevent="delete({{$guideline->id}})">
                    <span class="fa-solid fa-lg">X</span>
                </div>
            </div>
        @endif
    </div>
    <p class="text-xs text-gray-500"> {{$guideline->created_at}}</p>
    <p class="text-xs text-gray-500"> {{$guideline->user->name}}</p>
    <div class="mt-3 text-xs text-gray-700">
        @if($editGuidelineID === $guideline->id)
            <button wire:click="update" class="mt-3 px-4 py-2 bg-teal-500 text-white font-semibold rounded hover:bg-teal-600 dark:bg-emerald-600">Update</button>
            <button wire:click="cancelEdit" class="mt-3 px-4 py-2 bg-red-500 text-white font-semibold rounded hover:bg-red-600">Cancel</button>
        @endif

    </div>
</div>