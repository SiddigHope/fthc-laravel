@props([
    'is_wishlisted' => false,  // Current wishlist state
    'variant' => 'default',    // default, icon-only, text-only, outline
    'size' => 'md',           // sm, md, lg
    'position' => 'relative',  // relative, absolute-top-right
    'show_count' => false,    // Show wishlist count
    'wishlist_count' => 0,    // Number of times wishlisted
    'animate' => true,        // Enable animation
    'disabled' => false       // Disable button
])

@php
    $buttonClasses = [
        'wishlist-btn',
        'btn',
        $variant === 'outline' ? 'btn-outline-danger' : 'btn-light',
        'size-' . $size,
        'position-' . $position,
        $is_wishlisted ? 'active' : '',
        $animate ? 'animate' : '',
        $attributes->get('class')
    ];

    $iconClasses = [
        'wishlist-icon',
        'fas',
        $is_wishlisted ? 'fa-heart' : 'fa-heart',
        $variant === 'icon-only' ? '' : 'me-2'
    ];
@endphp

<button type="button"
        {{ $attributes->merge(['class' => implode(' ', array_filter($buttonClasses))]) }}
        @if($disabled) disabled @endif>
    <i class="{{ implode(' ', array_filter($iconClasses)) }}"></i>
    @if($variant !== 'icon-only')
        <span class="wishlist-text">
            {{ $is_wishlisted ? 'Wishlisted' : 'Add to Wishlist' }}
        </span>
    @endif
    @if($show_count && $wishlist_count > 0)
        <span class="wishlist-count badge rounded-pill bg-danger ms-2">
            {{ $wishlist_count }}
        </span>
    @endif
</button>

@push('styles')
<style>
    .wishlist-btn {
        --heart-color: var(--bs-danger);
        --heart-fill: transparent;
        transition: all 0.3s ease;
    }

    .wishlist-btn.size-sm {
        font-size: 0.875rem;
        padding: 0.25rem 0.5rem;
    }

    .wishlist-btn.size-lg {
        font-size: 1.25rem;
        padding: 0.75rem 1.5rem;
    }

    .wishlist-btn.position-absolute-top-right {
        position: absolute;
        top: 1rem;
        right: 1rem;
        z-index: 10;
    }

    .wishlist-btn .wishlist-icon {
        color: var(--heart-color);
        transition: all 0.3s ease;
    }

    .wishlist-btn:not(.active) .wishlist-icon {
        font-weight: normal;
    }

    .wishlist-btn.active {
        background-color: var(--bs-danger);
        border-color: var(--bs-danger);
        color: white;
    }

    .wishlist-btn.active .wishlist-icon {
        color: white;
    }

    .wishlist-btn.btn-outline-danger.active .wishlist-icon {
        color: white;
    }

    /* Animation */
    .wishlist-btn.animate.active .wishlist-icon {
        animation: heartBeat 0.3s ease-in-out;
    }

    @keyframes heartBeat {
        0% {
            transform: scale(1);
        }
        50% {
            transform: scale(1.3);
        }
        100% {
            transform: scale(1);
        }
    }

    /* Hover Effects */
    .wishlist-btn:not(.active):hover {
        background-color: var(--bs-danger);
        border-color: var(--bs-danger);
        color: white;
    }

    .wishlist-btn:not(.active):hover .wishlist-icon {
        color: white;
    }

    /* Disabled State */
    .wishlist-btn:disabled {
        opacity: 0.6;
        cursor: not-allowed;
    }

    /* Count Badge */
    .wishlist-count {
        font-size: 0.75em;
        padding: 0.25em 0.6em;
    }

    /* Size Variants for Icon-Only */
    .wishlist-btn.size-sm.variant-icon-only {
        padding: 0.375rem;
        width: 32px;
        height: 32px;
    }

    .wishlist-btn.size-md.variant-icon-only {
        padding: 0.5rem;
        width: 38px;
        height: 38px;
    }

    .wishlist-btn.size-lg.variant-icon-only {
        padding: 0.75rem;
        width: 48px;
        height: 48px;
    }
</style>
@endpush

{{-- Usage Examples:
<!-- Default Wishlist Button -->
<x-ui.wishlist-button
    :is_wishlisted="false"
/>

<!-- Icon Only Wishlist Button -->
<x-ui.wishlist-button
    :is_wishlisted="true"
    variant="icon-only"
    position="absolute-top-right"
/>

<!-- Outline Wishlist Button with Count -->
<x-ui.wishlist-button
    :is_wishlisted="false"
    variant="outline"
    size="lg"
    :show_count="true"
    :wishlist_count="42"
/>

<!-- Disabled Wishlist Button -->
<x-ui.wishlist-button
    :is_wishlisted="false"
    :disabled="true"
    :animate="false"
/>
--}}
