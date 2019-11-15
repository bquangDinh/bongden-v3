@if ($paginator->hasPages())
    <ul class="pagination" role="navigation">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="disabled" aria-disabled="true"><span>Trước</span></li>
        @else
            <li><a href="{{ $paginator->previousPageUrl() }}" rel="prev">Trước</a></li>
        @endif

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li><a href="{{ $paginator->nextPageUrl() }}" rel="next">Sau</a></li>
        @else
            <li class="disabled" aria-disabled="true"><span>Sau</span></li>
        @endif
    </ul>
@endif
