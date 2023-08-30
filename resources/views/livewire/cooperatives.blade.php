<div class="container">
    <div class="flex flex-wrap mb-3 justify-between p-2">
        <div class="mx-4">
            <label for="pb-filter-cooperative">Cooperative</label>
            <select wire:model="cooperative" name="pb_filter_cooperative" id="pb-filter-cooperative" class="block border rounded w-full p-2">
                <option value="aepa">AEPA/ESCNJ/CES/CMAS</option>
                <option value="ei">EI/IPHEC</option>
                <option value="omnia">OMNIA</option>
            </select>
        </div>
        @if($cooperative=='aepa')
            <div class="mx-4">
                <label class="" for="pb-filter-pw">PW</label>
                <select name="pb-filter-pw" id="pb-filter-pw" class="block border rounded w-full p-2" wire:model="pw">
                    <option value="1">PW</option>
                    <option value="0">NPW</option>
                </select>
            </div>
        @endif
        <div class="mx-4">
            <label for="pb-filter-linebook">Linebook</label>
            <select wire:model="linebook" name="pb_filter_linebook" id="pb_filter_linebook" class="block border rounded w-full p-2">
                <option value="08_15_2023">August 15, 2023</option>
                <option value="01_01_2023">January 1, 2023</option>
                <option value="03_01_2022">March 1, 2022</option>
                <option value="03_01_2021">March 1, 2021</option>
            </select>
        </div>
        <div class="mx-4">
            <label for="pb-filter-state">State</label>
            <select wire:model="state" name="pb_filter_state" id="pb_filter_state" class="block border rounded w-full p-2">
                <option value="">Base</option>
                @foreach($states as $state)
                    <option value="{{$state->id}}">{{$state->State}}</option>
                @endforeach
            </select>
        </div>
        <div class="mx-4">
            <label class="" for="pb-filter-perPage">Per Page</label>
            <select name="pb-filter-perPage" id="pb-filter-perPage" class="block border rounded w-full p-2" wire:model="perPage">
                <option value="20">20</option>
                <option value="50">50</option>
                <option value="100">100</option>
            </select>
        </div>
        <div class="mx-4">
            <label for="pb-filter-category">Category</label>
            <select name="pb-filter-category" id="pb-filter-category" class="block border rounded w-full p-2" wire:model="category">
                <option value="">All</option>
                @foreach($categories as $category)
                    <option value="{{$category->id}}">{{$category->Name}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="mb-3 px-2">
        <div class="mx-4">
            <label for="pb-filter-search">Search</label>
            <input type="text" class="block border rounded min-w-full p-2" id="pb-filter-search" wire:model.live.debounce.350ms="search">
        </div>
    </div>
    @if(count($lines))
        <div class="p-6">
            {{$lines->links('livewire-pagination-links')}}
        </div>
    @endif
    <div class="text-center">
        {{$lines->total()}} lines
    </div>
    <div class="grid grid-flow-col justify-stretch">
        <table class="table-auto">
            <thead class="">
                <tr>
                    <th>Line</th>
                    <th>Description</th>
                    <th class="">UOM</th>
                    <th class="">Price</th>
                    <th class="">Category</th>
                    {{-- <th class="">Prepriced</th> --}}
                </tr>
            </thead>
            <tbody id="cooperative-table-body">
                @foreach($lines as $line)
                    <tr class="odd:bg-gray-100">
                        <td class="p-2">{{$line->Line}}</td>
                        <td class="p-2">{{$line->Description}}</td>
                        <td class="p-2 text-center">{{$line->UOM}}</td>
                        <td class="p-2 text-center">{{($line->UOM) ? (($line->fk_UOM == 2 || $line->fk_UOM == 12) ? $line[$line_version]*$multiplier."%" : (($line->fk_UOM==10) ? $line[$line_version]*$multiplier : "$".number_format($line[$line_version]*$multiplier, 2))) : ''}}</td>
                        <td class="p-2 text-center">{{($line->UOM) ? $line->Name : ''}}</td>
                        {{-- <td class="p-2 text-center">{{($line->UOM) ? (($line->Prepriced) ? "Yes" : "No") : ''}}</td> --}}
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>