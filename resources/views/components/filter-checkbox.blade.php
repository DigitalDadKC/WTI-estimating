@props(['filter', 'selected'])

<ul>
    <li class="text-left">
        <input type="hidden" name="filter-checkbox[]" value="0">
        <input type="checkbox" id="filter-checkbox-select-all" name="filter-checkbox[]" value="BOOK"
        @checked($selected == null || !in_array(0, $selected))
        >
        <label for="filter-checkbox-select-all"> SELECT ALL</label>
    </li>
    @foreach($filter as $key=>$category)
        <li class="text-left whitespace-nowrap">
            <input type="hidden" name="filter-checkbox[{{$key}}]" value="0">
            <input type="checkbox" class="checkbox-filter" id="filter-cb-{{$category->id}}" name="filter-checkbox[{{$key}}]" value="{{$category->id}}" 
            @checked($selected == null || $selected[$key] != 0)
            >
            <label for="filter-cb-{{$category->id}}">{{$category->Name}}</label>
        </li>
    @endforeach
</ul>