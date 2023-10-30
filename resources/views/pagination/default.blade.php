<!-- <ul>
  <li class="prev"><a href="javascript:void(0);"><i class="fa fa-chevron-left"></i></a></li>
  <li class="active">1</li>
  <li><a href="javascript:void(0);">2</a></li>
  <li><a href="javascript:void(0);">3</a></li>
  <li><a href="javascript:void(0);">4</a></li>
  <li class="dotted"><a href="javascript:void(0);">..</a></li>
  <li><a href="javascript:void(0);">6</a></li>
  <li class="next"><a href="javascript:void(0);"><i class="fa fa-chevron-right"></i></a></li>
</ul> -->

@if ($paginator->hasPages())
    <ul>
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="prev"><a href="javascript:void(0);"><i class="fa fa-chevron-left"></i></a></li>
        @else
            <li class="prev"><a href="{{ $paginator->previousPageUrl() }}"><i class="fa fa-chevron-left"></i></a></li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class="dotted"><a href="javascript:void(0);">{{ $element }}</a></li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="active">{{ $page }}</li>
                    @else
                        <li><a href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li class="next"><a href="{{ $paginator->nextPageUrl() }}"><i class="fa fa-chevron-right"></i></a></li>
        @else
            <li class="next"><a href="javascript:void(0);"><i class="fa fa-chevron-right"></i></a></li>
        @endif
    </ul>
@endif