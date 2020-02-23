@if ($paginator->hasPages())
    <div class="catalogue-block-pagination">
        <div class="pagination-wrapper">
            <div class="pagination-block">
                <ul class="page-numbers">
                    @foreach ($elements as $element)
                        @if (is_string($element))
                            <li><span class="page-numbers dots">...</span></li>
                        @endif
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    <li><span class="page-numbers current">{{$page}}</span></li>
                                @else
                                    <li><a href="{{ PaginateRoute::pageUrl($page) }}" class="page-numbers">{{ $page }}</a></li>
                                @endif
                            @endforeach
                        @endif
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endif
