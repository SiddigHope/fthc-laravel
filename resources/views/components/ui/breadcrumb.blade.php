@props([
    'items' => [],           // Array of ['title' => 'Home', 'url' => '/'] items
    'divider' => null,       // Custom divider (optional)
    'background' => false,   // Add background color
    'rounded' => false,      // Add rounded corners
    'withHomeIcon' => true   // Show home icon for first item
])

@php
    $classes = [
        'breadcrumb',
        $background ? 'bg-light p-2 px-3' : '',
        $rounded ? 'rounded-3' : '',
        $attributes->get('class')
    ];
@endphp

<nav aria-label="breadcrumb">
    <ol class="{{ implode(' ', array_filter($classes)) }}" @if($divider) style="--bs-breadcrumb-divider: '{{ $divider }}'" @endif>
        @foreach($items as $index => $item)
            <li class="breadcrumb-item {{ !isset($item['url']) || ($loop->last) ? 'active' : '' }}"
                @if($loop->last) aria-current="page" @endif>

                @if(isset($item['url']) && !$loop->last)
                    <a href="{{ $item['url'] }}" class="text-decoration-none">
                        @if($loop->first && $withHomeIcon)
                            <i class="fas fa-home me-1"></i>
                        @endif
                        {{ $item['title'] }}
                    </a>
                @else
                    @if($loop->first && $withHomeIcon)
                        <i class="fas fa-home me-1"></i>
                    @endif
                    {{ $item['title'] }}
                @endif
            </li>
        @endforeach
    </ol>
</nav>

{{-- Usage Example:
@php
    $breadcrumbItems = [
        ['title' => 'Home', 'url' => route('home')],
        ['title' => 'Courses', 'url' => route('courses.index')],
        ['title' => 'Web Development']
    ];
@endphp

<x-ui.breadcrumb
    :items="$breadcrumbItems"
    background
    rounded
/>
--}}
