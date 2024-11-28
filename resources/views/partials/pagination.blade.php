@if ($paginator->lastPage() > 1)
    <nav>
        <ul class="pagination">
            {{-- Link Anterior --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled" aria-disabled="true" aria-label="« Anterior">
                    <span class="page-link" aria-hidden="true">‹</span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev"
                        aria-label="« Anterior">‹</a>
                </li>
            @endif

            {{-- Links de páginas --}}
            @php
                $maxLinks = 4;
                $halfMaxLinks = floor($maxLinks / 2);
                $startPage = max($paginator->currentPage() - $halfMaxLinks, 1);
                $endPage = min($startPage + $maxLinks - 1, $paginator->lastPage());
            @endphp

            @for ($i = $startPage; $i <= $endPage; $i++)
                @if ($i == $paginator->currentPage())
                    <li class="page-item active" aria-current="page"><span class="page-link">{{ $i }}</span>
                    </li>
                @else
                    <li class="page-item"><a class="page-link" href="{{ $paginator->url($i) }}">{{ $i }}</a>
                    </li>
                @endif
            @endfor

            {{-- Link Próximo --}}
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next"
                        aria-label="Próximo »">›</a>
                </li>
            @else
                <li class="page-item disabled" aria-disabled="true" aria-label="Próximo »">
                    <span class="page-link" aria-hidden="true">›</span>
                </li>
            @endif
        </ul>
    </nav>
@endif
