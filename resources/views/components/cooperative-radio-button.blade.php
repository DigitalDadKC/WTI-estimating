@props(['cooperative' => 'BOOK', 'date', 'selected'])

<input type="radio" id="{{$cooperative}}" name="filter-radio" value="{{$cooperative}}" class="hidden peer" @checked("{{$cooperative}}" == "{{$selected}}")>
<label for="{{$cooperative}}" class="inline-flex items-center justify-center w-full p-2 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-white dark:border-gray-700 dark:peer-checked:text-white peer-checked:border-black peer-checked:text-black dark:peer-checked:bg-emerald-500 hover:text-gray-600 hover:bg-gray-100 dark:text-black dark:bg-emerald-600 dark:hover:bg-emerald-700">                           
    <div class="block">
        <div class="w-full text-lg font-semibold">{{$cooperative}}</div>
        <div class="w-full">{{$date}}</div>
    </div>
</label>