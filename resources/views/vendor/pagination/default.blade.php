@if ($paginator->hasPages())
    <nav class="pagination is-centered">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <a class="pagination-previous button is-disabled">Previous</a>
        @else
            <a class="pagination-previous button is-primary" href="{{ $paginator->previousPageUrl() }}" rel="prev">Previous</a>
        @endif

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a class="pagination-next button is-primary" href="{{ $paginator->nextPageUrl() }}" rel="next">Next page</a>
        @else
            <a class="pagination-next button is-disabled">Next page</a>
        @endif

        {{-- Pagination Elements --}}
        <ul class="pagination-list">
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li><span class="pagination-ellipsis">{{ $element }}</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li><a class="pagination-link button is-primary is-current" href="{{ $url }}">{{ $page }}</a></li>
                        @else
                            <li><a class="pagination-link button" href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach
        </ul>
    </nav>
@endif
