@props([
    'type' => 'button',
    'variant' => 'primary',  // primary, secondary, success, danger, warning, info, light, dark
    'size' => '',           // sm, lg
    'outline' => false,
    'rounded' => false,
    'block' => false,
    'disabled' => false,
    'href' => null,
    'icon' => null,
    'iconPosition' => 'start' // start, end
])

@php
    $baseClass = 'btn';
    $variantClass = $outline ? "btn-outline-{$variant}" : "btn-{$variant}";
    $sizeClass = $size ? "btn-{$size}" : '';
    $roundedClass = $rounded ? 'rounded-pill' : '';
    $blockClass = $block ? 'w-100' : '';
    $classes = trim("$baseClass $variantClass $sizeClass $roundedClass $blockClass " . ($attributes->get('class') ?? ''));
@endphp

@if($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
        @if($icon && $iconPosition === 'start')
            <i class="{{ $icon }} me-2"></i>
        @endif
        {{ $slot }}
        @if($icon && $iconPosition === 'end')
            <i class="{{ $icon }} ms-2"></i>
        @endif
    </a>
@else
    <button type="{{ $type }}" {{ $attributes->merge(['class' => $classes]) }} @if($disabled)disabled @endif>
        @if($icon && $iconPosition === 'start')
            <i class="{{ $icon }} me-2"></i>
        @endif
        {{ $slot }}
        @if($icon && $iconPosition === 'end')
            <i class="{{ $icon }} ms-2"></i>
        @endif
    </button>
@endif
