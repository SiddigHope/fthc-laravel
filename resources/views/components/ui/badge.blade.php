@props([
    'type' => 'primary',    // primary, secondary, success, danger, warning, info, light, dark
    'pill' => false,
    'soft' => false,
    'size' => '',          // sm, lg
    'icon' => null,
    'iconPosition' => 'start', // start, end
    'href' => null
])

@php
    $baseClass = 'badge';
    $variantClass = $soft ? "bg-soft-{$type} text-{$type}" : "bg-{$type}";
    $pillClass = $pill ? 'rounded-pill' : '';
    $sizeClass = $size ? "badge-{$size}" : '';
    $classes = trim("$baseClass $variantClass $pillClass $sizeClass " . ($attributes->get('class') ?? ''));
@endphp

@if($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
        @if($icon && $iconPosition === 'start')
            <i class="{{ $icon }} me-1"></i>
        @endif
        {{ $slot }}
        @if($icon && $iconPosition === 'end')
            <i class="{{ $icon }} ms-1"></i>
        @endif
    </a>
@else
    <span {{ $attributes->merge(['class' => $classes]) }}>
        @if($icon && $iconPosition === 'start')
            <i class="{{ $icon }} me-1"></i>
        @endif
        {{ $slot }}
        @if($icon && $iconPosition === 'end')
            <i class="{{ $icon }} ms-1"></i>
        @endif
    </span>
@endif
