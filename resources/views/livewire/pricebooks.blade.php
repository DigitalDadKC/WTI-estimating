<div>
    <div class="flex flex-wrap mb-3 justify-between p-2">
        @php
            $pb_column = $pricebook['pricebook_column'];
            $pb_status_column = $pricebook['pricebook_status_column'];
        @endphp
        <div class="mx-4">
            <label for="pb-filter-cooperative">Cooperative</label>
            <select wire:model="cooperative" name="pb_filter_cooperative" id="pb-filter-cooperative" class="block border rounded w-full p-2">
                <option value="0">BOOK</option>
                <option value="1">AEPA/ESCNJ/CES/CMAS</option>
                <option value="2">EI/IPHEC</option>
                <option value="3">OMNIA</option>
            </select>
        </div>
        <div class="mx-4">
            <label for="pb-filter-search">Search</label>
            <input type="text" class="block border rounded min-w-full p-2" id="pb-filter-search" wire:model.debounce.350ms="search">
        </div>
        <div class="mx-4">
            <label class="" for="pb-filter-perPage">Per Page</label>
            <select name="" id="pb-filter-perPage" class="block border rounded w-full p-2" wire:model="perPage">
                <option value="20">20</option>
                <option value="50">50</option>
                <option value="100">100</option>
            </select>
        </div>
        <div class="mx-4">
            <label for="">Order By</label>
            <select name="" id="" class="block border rounded w-full p-2" wire:model="orderBy">
                <option value="Pricebooks.id">ID</option>
                <option value="Pricebooks.SKU">SKU</option>
                <option value="Pricebooks.Name">Description</option>
                <option value="Pricebooks.{{$pb_column}}">Price</option>
                <option value="Material_Categories.Name">Category</option>
            </select>
        </div>
        <div class="mx-4">
            <label for="">Sort by</label>
            <select name="" id="" class="block border rounded w-full p-2" wire:model="sortBy">
                <option value="asc">ASC</option>
                <option value="desc">DESC</option>
            </select>
        </div>
    </div>
    @if(count($materials))
        <div class="p-6">
            {{$materials->links('livewire-pagination-links')}}
        </div>
    @endif
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
                <tr class="odd:bg-gray-100">
                    <td class="p-2">{{$material->SKU}}</td>
                    <td class="p-2">{{$material->Name}}</td>
                    <td class="p-2 text-center">{{$material->materialUnitSizes->Unit_Size}}</td>
                    <td>{{($material->$pb_column && ($material->$pb_status_column == 'Active' || $material->$pb_status_column == 'New')) ? "$" . number_format($material->$pb_column * ($discount), 2) : 'QUOTE'}}</td>
                    <td>{{$material->PB_FY24_1_Status}}</td>
                    <td class="p-2 text-center">{{($material->Discountable) ? "Yes" : "No"}}</td>
                    <td class="p-2 text-center">{{$material->materialCategories->Name}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    </div>
</div>