@if ($paginator->hasPages())
    <ul id="pagination">
        @if ($paginator->onFirstPage())
            <li><a class="" href="#">«</a></li>
        @else
            <li><a class="" href="{{ $paginator->previousPageUrl() }}">«</a></li>
        @endif
        @foreach ($elements as $element)
            @if (is_string($element))
                <li><a class="" href="#">{{ $element }}</a></li>
            @endif
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li><a class="active" href="#">{{ $page }}</a></li>
                    @else
                        <li><a class="" href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach
        @if ($paginator->hasMorePages())
            <li><a class="" href="{{ $paginator->nextPageUrl() }}">»</a></li>
        @else
            <li><a class="" href="#">»</a></li>
        @endif
    </ul>
@endif
