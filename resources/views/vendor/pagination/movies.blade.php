@if ($paginator->hasPages())
<!-- pagination -->
<section id="post-pages" class="pagination">
    <ul id="pages">
    @foreach ($elements as $element)
        {{-- Array Of Links --}}
        @if (is_array($element))
            @foreach ($element as $page => $url)
                @if ($page == $paginator->currentPage())
                    <li class="pagelines"><a class="active-page" id="DefaultPage">{{ $page }}</a></li>
                @else
                    <li class="pagelines"><a href="{{ $url }}">{{ $page }}</a></li>
                @endif
            @endforeach
        @endif
    @endforeach
    </ul>
</section>
@endif