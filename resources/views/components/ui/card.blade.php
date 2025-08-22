@props([
    'title' => null,
    'subtitle' => null,
    'image' => null,
    'imageAlt' => '',
    'imagePosition' => 'top', // top, bottom, overlay
    'footer' => null,
    'hover' => false,
    'shadow' => true,
    'border' => true,
    'rounded' => true,
    'padding' => true
])

@php
    $classes = [
        'card',
        $hover ? 'card-hover' : '',
        $shadow ? 'shadow' : '',
        !$border ? 'border-0' : '',
        $rounded ? 'rounded-3' : '',
        $padding ? '' : 'p-0',
        $attributes->get('class')
    ];
@endphp

<div {{ $attributes->merge(['class' => implode(' ', array_filter($classes))]) }}>
    @if($image && $imagePosition === 'top')
        <img src="{{ $image }}" class="card-img-top" alt="{{ $imageAlt }}">
    @endif

    @if($image && $imagePosition === 'overlay')
        <div class="card-img-overlay d-flex flex-column">
    @endif

    @if($title || $subtitle || $slot->isNotEmpty())
        <div @class(['card-body', 'p-0' => !$padding])>
            @if($title)
                <h5 class="card-title">{{ $title }}</h5>
            @endif

            @if($subtitle)
                <h6 class="card-subtitle mb-2 text-muted">{{ $subtitle }}</h6>
            @endif

            <div class="card-text">
                {{ $slot }}
            </div>
        </div>
    @endif

    @if($image && $imagePosition === 'overlay')
        </div>
        <img src="{{ $image }}" class="card-img" alt="{{ $imageAlt }}">
    @endif

    @if($footer)
        <div class="card-footer">
            {{ $footer }}
        </div>
    @endif

    @if($image && $imagePosition === 'bottom')
        <img src="{{ $image }}" class="card-img-bottom" alt="{{ $imageAlt }}">
    @endif
</div>
