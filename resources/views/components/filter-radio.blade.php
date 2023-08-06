@props(['filter', 'selected'])

<ul>
    <li class="text-left">
        <input type="radio" id="filter-BOOK" name="filter-radio" value="BOOK" 
        @checked($selected == null || $selected == "BOOK")
        >
        <label for="filter-BOOK"> BOOK</label>
    </li>
    @foreach($filter as $key=>$option)
        @if($key<8)
            <li class="text-left">
                <input type="radio" id="filter-{{$option->Name}}" name="filter-radio" value="{{$option->Name}}" 
                @if($option->Name == $selected)
                    checked
                @endif
                >
                <label for="filter-{{$option->Name}}"> {{$option->Name}}</label>
            </li>
        @endif
    @endforeach
</ul>