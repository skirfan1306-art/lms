@if ($paginator->hasPages())
<div class="pagination-area">
    <ul class="pagination">

        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="page-item disabled"><span class="page-link"><i class="fas fa-arrow-left"></i></span></li>
        @else
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->previousPageUrl() }}"><i class="fas fa-arrow-left"></i></a>
            </li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($paginator->links()->elements[0] as $page => $url)
            @if ($page == $paginator->currentPage())
                <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
            @else
                <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->nextPageUrl() }}"><i class="fas fa-arrow-right"></i></a>
            </li>
        @else
            <li class="page-item disabled"><span class="page-link"><i class="fas fa-arrow-right"></i></span></li>
        @endif

    </ul>
</div>
@endif


 