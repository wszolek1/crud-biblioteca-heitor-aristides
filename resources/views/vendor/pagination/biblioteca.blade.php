@if ($paginator->total() > 0)
    <nav class="d-flex flex-wrap justify-content-between align-items-center">
        <div class="small text-muted mb-2">
            Mostrando
            <span class="fw-semibold">{{ $paginator->firstItem() }}</span>
            a
            <span class="fw-semibold">{{ $paginator->lastItem() }}</span>
            de
            <span class="fw-semibold">{{ $paginator->total() }}</span>
            registros
        </div>

        @if ($paginator->hasPages())
            <ul class="pagination pagination-sm mb-2">
                @if ($paginator->onFirstPage())
                    <li class="page-item disabled" aria-disabled="true"><span class="page-link">Primeira</span></li>
                    <li class="page-item disabled" aria-disabled="true"><span class="page-link">&laquo; Anterior</span></li>
                @else
                    <li class="page-item"><a class="page-link" href="{{ $paginator->url(1) }}">Primeira</a></li>
                    <li class="page-item"><a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev">&laquo; Anterior</a></li>
                @endif

                @foreach ($elements as $element)
                    @if (is_string($element))
                        <li class="page-item disabled" aria-disabled="true"><span class="page-link">{{ $element }}</span></li>
                    @endif

                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <li class="page-item active" aria-current="page"><span class="page-link">{{ $page }}</span></li>
                            @else
                                <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                @if ($paginator->hasMorePages())
                    <li class="page-item"><a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next">Próxima &raquo;</a></li>
                    <li class="page-item"><a class="page-link" href="{{ $paginator->url($paginator->lastPage()) }}">Última</a></li>
                @else
                    <li class="page-item disabled" aria-disabled="true"><span class="page-link">Próxima &raquo;</span></li>
                    <li class="page-item disabled" aria-disabled="true"><span class="page-link">Última</span></li>
                @endif
            </ul>
        @endif
    </nav>
@endif
