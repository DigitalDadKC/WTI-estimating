<div class="container">
    @php
        $pb_column = $pricebook['pricebook_column'];
        $pb_status_column = $pricebook['pricebook_status_column'];
    @endphp
    <div class="flex flex-wrap mb-3 justify-between p-2">
        <div class="mx-4">
            <label for="pb-filter-cooperative">Cooperative</label>
            <select wire:model.live="cooperative" name="pb_filter_cooperative" id="pb-filter-cooperative" class="block border rounded w-full p-2">
                <option value="book">BOOK</option>
                <option value="aepa">AEPA/ESCNJ/CES/CMAS</option>
                <option value="ei">EI/IPHEC</option>
                <option value="omnia">OMNIA</option>
            </select>
        </div>
        <div class="mx-4">
            <label for="pb-filter-pricebook">Effective Date</label>
            <select wire:model.live="effective_date_id" name="pb_filter_pricebook" id="pb-filter-pricebook" class="block border rounded w-full p-2">
                @foreach($effective_dates as $date)
                    <option value="{{$date->id}}">{{date("F d, Y",strtotime($date->date))}}</option>
                @endforeach
            </select>
        </div>
        <div class="mx-4">
            <label for="pb-filter-category">Category</label>
            <select name="pb-filter-category" id="pb-filter-category" class="block border rounded w-full p-2" wire:model.live="category">
                <option value="">All</option>
                @foreach($categories as $category)
                    <option value="{{$category->id}}">{{$category->Name}}</option>
                @endforeach
            </select>
        </div>
        <div class="mx-4">
            <label class="" for="pb-filter-perPage">Per Page</label>
            <select name="" id="pb-filter-perPage" class="block border rounded w-full p-2" wire:model.live="perPage">
                <option value="20">20</option>
                <option value="50">50</option>
                <option value="100">100</option>
            </select>
        </div>
        <div class="mx-4">
            <label for="">Order By</label>
            <select name="" id="" class="block border rounded w-full p-2" wire:model.live="orderBy">
                <option value="Pricebooks.id">ID</option>
                <option value="Pricebooks.SKU">SKU</option>
                <option value="Pricebooks.Name">Description</option>
                <option value="Pricebooks.{{$pb_column}}">Price</option>
                <option value="Material_Categories.Name">Category</option>
            </select>
        </div>
        <div class="mx-4">
            <label for="">Sort by</label>
            <select name="" id="" class="block border rounded w-full p-2" wire:model.live="sortBy">
                <option value="asc">ASC</option>
                <option value="desc">DESC</option>
            </select>
        </div>
    </div>
    <div class="mx-4">
        <label for="pb-filter-search">Search</label>
        <input type="text" class="block border rounded min-w-full p-2" id="pb-filter-search" wire:model.live.debounce.350ms="search">
    </div>
    <div class="p-6">
        {{$materials->links('livewire-pagination-links')}}
    </div>
    <div class="text-center pb-4">
        {{$materials->total()}} materials
    </div>
    <div class="grid grid-flow-col justify-stretch">
        <table class="table-auto">
            <thead class="">
                <tr>
                    <th>SKU</th>
                    <th>Description</th>
                    <th class="">Units</th>
                    <th class="">Price</th>
                    <th class="">Status</th>
                    <th class="">Discountable</th>
                    <th>Category</th>
                </tr>
            </thead>
            <tbody id="pricebook-table-body">
                @foreach($materials as $material)
                    <tr class="odd:bg-gray-100" wire:key="{{$material->id}}">
                        <td x-data="{ input: $el, copied: false }"
                            class="p-2 cursor-pointer font-bold text-center hover:text-white hover:bg-gray-500"
                            @click="navigator.clipboard.writeText(input.innerText), tooltip = false, copied = true, setTimeout(() => copied = false, 1000)"
                            ><span class="p-1 rounded-lg">
                                {{$material->SKU}}
                            </span>
                            <span x-show="copied"
                                x-cloak
                                x-transition
                                class="absolute"
                                style="display: none;">
                                <p class="py-1 px-2 ms-4 inline-flex items-center justify-center text-green-100 font-sm bg-emerald-600 rounded-lg shadow-lg">COPIED!</p>
                            </span>
                        </td>
                        <td>{{$material->Name}}</td>
                        <td class="text-center">
                            @if($material->materialCategories->id == 29)
                                <button wire:click="viewMaterial({{$material}})" class="px-3 py-1 rounded-lg bg-emerald-600 text-white hover:bg-emerald-500" type="button" >
                                    {{$material->materialUnitSizes->Unit_Size}}
                                </button>
                            @else
                                {{$material->materialUnitSizes->Unit_Size}}
                            @endif
                        </td>
                        <td>{{($material->$pb_column && ($material->$pb_status_column == 'Active' || $material->$pb_status_column == 'New')) ?
                                (($material->Discountable) ? 
                                    "$" . number_format($material->$pb_column * ($discount), 2) :
                                    "$" . number_format($material->$pb_column, 2)) :
                                'QUOTE'}}
                        </td>
                        <td>{{$material->$pb_status_column}}</td>
                        <td class="p-2 text-center">{{($material->Discountable) ? "Yes" : "No"}}</td>
                        <td class="p-2 text-center">{{$material->materialCategories->Name}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <x-modal 
            name="unit-conversion"
            title="Board-to-Square Conversion"
            subtitle="Name: {{ optional($selectedMaterial)->Name }}<br>SKU: {!! optional($selectedMaterial)->SKU !!}<br>SQ/Pallet: {!!optional($selectedMaterial)->SQPerPallet!!}"
            focusable>
            @slot('slot')
                @if($selectedMaterial)
                    <div 
                        x-data="{
                            init() {
                                this.boards = '';
                                this.sqperpallet = {{optional($selectedMaterial)->SQPerPallet}};
                                this.SF = {{optional($selectedMaterial)->SF}};
                            },
                            get pallets() {
                                return Math.ceil((boards*SF/100)/sqperpallet)
                            },
                            get squares() {
                                return (Math.ceil((boards*SF/100)/sqperpallet)*sqperpallet).toFixed(2)
                            }
                        }"
                    >
                    <div class="grid grid-cols-2 p-4 dark:bg-emerald-600">
                        <div>
                            <x-input-label class="text-lg">Boards</x-input-label>
                            <x-text-input type="text" x-model.number="boards" @click="$el.select()" class="text-lg border-black" />
                        </div>
                        <div>
                            <x-input-label class="text-lg">Squares</x-input-label>
                            <x-text-input x-model.number="squares" :disabled="true" class="text-lg border-black" />
                            <div>
                                <span x-text="`${pallets} pallets`"></span>
                            </div>
                        </div>
                    </div>
                @endif
            @endslot
        </x-modal>
    </div>
</div>
