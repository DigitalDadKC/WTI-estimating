
<div class="container content mx-auto">
    <div id="create-form" class="hover:shadow p-6 bg-white dark:bg-emerald-600 rounded-lg">
        <h2 class="font-semibold text-lg text-gray-800 dark:text-white mb-5">Create New Guideline</h2>
        <div>
            <form>
                @csrf
                <div class="mb-6">
                    <x-textarea wire:model="guideline" wire:keydown.enter="create" onkeydown="if(event.keyCode==13) return false;" type="text" id="guideline" placeholder="Enter Guideline..."
                        class="bg-gray-100 text-gray-900 rounded block w-full p-2.5">
                    </x-textarea>
                </div>
                <button wire:click.prevent="create" type="submit" class="px-4 py-2 bg-gray-800 text-white font-semibold rounded hover:bg-gray-600">Create Guideline</button>
            </form>
        </div>
    </div>
</div>