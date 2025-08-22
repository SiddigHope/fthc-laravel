@props([
    'paginator',
    'size' => '',       // sm, lg
    'alignment' => '',  // start, center, end
    'rounded' => false,
    'withNumbers' => true
])

@php
    $elements = $paginator->elements();
    $alignment = match($alignment) {
        'center' => 'justify-content-center',
        'end' => 'justify-content-end',
        default => ''
    };
    $sizeClass = $size ? "pagination-{$size}" : '';
    $roundedClass = $rounded ? 'pagination-pill' : '';
@endphp

@if ($paginator->hasPages())
    <nav aria-label="Page navigation">
        <ul class="pagination {{ $alignment }} {{ $sizeClass }} {{ $roundedClass }} {{ $attributes->get('class') }}">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled" aria-disabled="true">
                    <span class="page-link" aria-hidden="true">
                        <i class="fas fa-angle-double-left"></i>
                    </span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev">
                        <i class="fas fa-angle-double-left"></i>
                    </a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @if($withNumbers)
                @foreach ($elements as $element)
                    {{-- "Three Dots" Separator --}}
                    @if (is_string($element))
                        <li class="page-item disabled" aria-disabled="true">
                            <span class="page-link">{{ $element }}</span>
                        </li>
                    @endif

                    {{-- Array Of Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <li class="page-item active" aria-current="page">
                                    <span class="page-link">{{ $page }}</span>
                                </li>
                            @else
                                <li class="page-item">
                                    <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                </li>
                            @endif
                        @endforeach
                    @endif
                @endforeach
            @endif

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next">
                        <i class="fas fa-angle-double-right"></i>
                    </a>
                </li>
            @else
                <li class="page-item disabled" aria-disabled="true">
                    <span class="page-link" aria-hidden="true">
                        <i class="fas fa-angle-double-right"></i>
                    </span>
                </li>
            @endif
        </ul>
    </nav>

    @if(!$withNumbers)
        <div class="d-flex justify-content-center mt-3">
            <p class="text-muted">
                Showing {{ $paginator->firstItem() ?? 0 }} to {{ $paginator->lastItem() ?? 0 }} of {{ $paginator->total() }} results
            </p>
        </div>
    @endif
@endif

{{-- Usage Example:
@if($posts instanceof \Illuminate\Pagination\LengthAwarePaginator)
    <x-ui.pagination :paginator="$posts" alignment="center" rounded />
@endif
--}}
