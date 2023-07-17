@if ($paginator->hasPages())
<ul class="pagination pagination-outline">
    @if (! $paginator->onFirstPage())
        <li class="page-item previous m-1">
            <a href="{{ $paginator->previousPageUrl() }}" class="page-link"><i class="previous"></i></a>
        </li>
    @endif
    @foreach ($elements as $element)
        @if (is_array($element))
            @foreach ($element as $page => $url)
                @if ($page == $paginator->currentPage())
                    <li class="page-item active m-1"><a data-pagenumber="{{ $page }}" class="page-link">{{ $page }}</a></li>
                @else
                    <li class="page-item m-1"><a data-pagenumber="{{ $page }}" href="{{ $url }}" class="page-link">{{ $page }}</a></li>
                @endif
            @endforeach
        @endif
    @endforeach
    @if ($paginator->hasMorePages())
        <li class="page-item next m-1">
            <a href="{{ $paginator->nextPageUrl() }}" class="page-link"><i class="next"></i></a>
        </li>
    @endif
</ul>
@endif
