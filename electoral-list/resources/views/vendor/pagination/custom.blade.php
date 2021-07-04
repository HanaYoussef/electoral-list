
@if ($paginator->hasPages())
    <ul class="pager">
       
        @if ($paginator->onFirstPage())
            <li class="disabled"><span>← Older</span></li>
        @else
        <li class="next"><a href="{{ $paginator->previousPageUrl() }}"> Older <span aria-hidden="true">&rarr;</span></a></li>
        @endif


        
        @if ($paginator->hasMorePages())
        <li class="previous "><a href="{{ $paginator->nextPageUrl() }}"><span aria-hidden="true">&larr;</span> Newer</a></li>
        @else

            <li class="disabled"><span>Newer →</span></li>
        @endif
    </ul>
@endif 