@if($paginator->hasPages())
    <ul class="grid grid-flow-col justify-stretch text-sm">
        
        {{-- Prev --}}
        @if($paginator->onFirstPage())
            <a href="javascript:;"><li class="flex items-center justify-center px-3 h-8 ml-0 leading-tight text-gray-500 bg-white border border-gray-300 rounded-l-lg dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 disabled"><span>Prev</span></li></a>
        @else
            <li class="flex items-center justify-center px-3 h-8 ml-0 leading-tight text-gray-500 bg-white border border-gray-300 rounded-l-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"><a href="javascript:;" wire:click="previousPage" rel="prev"><span>Prev</span></a></li>
        @endif
        
        @foreach($elements as $element)
            {{-- Icon to indicate LOTS of pages --}}
            @if(is_string($element))
                <li class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 disabled"><a class="page-link"><span>{{$element}}</span></a></li>
            @endif

            {{-- Pages Links --}}
            @if(is_array($element))
                @foreach($element as $page=>$url)
                    @if($page==$paginator->currentPage())
                        <li class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-500 active" aria-current="page"><span>{{$page}}</span></li>
                    @else
                        <a href="javascript:;" wire:click="gotoPage({{$page}})"><li class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-300 dark:hover:bg-gray-700 dark:hover:text-white"><span>{{$page}}</span></li></a>
                    @endif
                @endforeach
            @endif
        @endforeach

        @if($paginator->hasMorePages())
            <li class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 rounded-r-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"><a href="javascript:;" wire:click="nextPage" rel="next" class="page-link"><span>Next</span></a></li>
        @else
            <li class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 rounded-r-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white disabled"><a href="javascript:;" class="page-link"><span>Next</span></a></li>
        @endif
    </ul>
@endif