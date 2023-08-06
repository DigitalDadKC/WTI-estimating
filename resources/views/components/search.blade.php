@props(['search'])

<div class="flex">
    <div class="relative w-full">
        <input type="search" name="search" id="search-dropdown" value="{{request()->query('search')}}" class="block p-2 w-full z-20 text-sm text-black bg-gray-50 rounded border-l-2 border border-gray-300" placeholder="{{$search}}">
    </div>
</div>