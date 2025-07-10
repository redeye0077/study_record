@if ($paginator->hasPages())
    <nav>
        <ul class="pagination justify-content-center simple-pagination">
            {{-- 最初のページ --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled"><span class="page-link">◀︎◀︎</span></li>
            @else
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->url(1) }}">◀︎◀︎</a>
                </li>
            @endif

            {{-- 前のページ --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled"><span class="page-link">◀</span></li>
            @else
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev">◀</a>
                </li>
            @endif

            {{-- 現在のページ番号 --}}
            <li class="page-item active">
                <span class="page-link">{{ $paginator->currentPage() }}</span>
            </li>

            {{-- 次のページ --}}
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next">▶</a>
                </li>
            @else
                <li class="page-item disabled"><span class="page-link">▶</span></li>
            @endif

            {{-- 最後のページ --}}
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->url($paginator->lastPage()) }}">▶︎▶︎</a>
                </li>
            @else
                <li class="page-item disabled"><span class="page-link">▶︎▶︎</span></li>
            @endif
        </ul>
    </nav>
@endif
