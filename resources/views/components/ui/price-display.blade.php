@props([
    'price' => 0,             // Current price
    'original_price' => null, // Original price for discount display
    'currency' => 'USD',      // Currency code
    'variant' => 'default',   // default, compact, detailed, minimal
    'size' => 'md',          // sm, md, lg
    'show_discount' => true,  // Show discount percentage
    'show_currency' => true,  // Show currency symbol/code
    'free_text' => 'Free',    // Text to display for free courses
    'sale_badge' => true,     // Show sale badge
    'subscription' => false,   // Show as subscription price
    'billing_period' => null, // Subscription billing period
    'color_scheme' => null    // Custom color scheme
])

@php
    // Format currency and price
    $currencies = [
        'USD' => ['symbol' => '$', 'position' => 'before'],
        'EUR' => ['symbol' => '€', 'position' => 'after'],
        'GBP' => ['symbol' => '£', 'position' => 'before'],
        'JPY' => ['symbol' => '¥', 'position' => 'before'],
        'INR' => ['symbol' => '₹', 'position' => 'before']
    ];

    $currencyInfo = $currencies[$currency] ?? ['symbol' => $currency, 'position' => 'before'];

    // Calculate discount percentage
    $discountPercentage = $original_price ? round((($original_price - $price) / $original_price) * 100) : 0;

    // Format price display
    $formatPrice = function($amount) use ($currencyInfo) {
        if ($amount == 0) return null;
        $formattedPrice = number_format($amount, 2);
        return $currencyInfo['position'] === 'before'
            ? $currencyInfo['symbol'] . $formattedPrice
            : $formattedPrice . $currencyInfo['symbol'];
    };

    $displayPrice = $price == 0 ? $free_text : $formatPrice($price);
    $displayOriginalPrice = $formatPrice($original_price);

    // Container classes
    $containerClasses = [
        'price-display',
        'variant-' . $variant,
        'size-' . $size,
        $price == 0 ? 'is-free' : '',
        $original_price ? 'has-discount' : '',
        $subscription ? 'is-subscription' : '',
        $attributes->get('class')
    ];

    // Color scheme
    $priceColor = $color_scheme ?? ($price == 0 ? 'success' : 'primary');
@endphp

<div class="{{ implode(' ', array_filter($containerClasses)) }}">
    @switch($variant)
        @case('compact')
            <div class="d-inline-flex align-items-center">
                <span class="current-price text-{{ $priceColor }}">{{ $displayPrice }}</span>
                @if($original_price && $show_discount)
                    <span class="original-price text-decoration-line-through text-muted ms-2">{{ $displayOriginalPrice }}</span>
                @endif
            </div>
            @break

        @case('detailed')
            <div class="detailed-price">
                <div class="price-header d-flex align-items-center gap-2">
                    <span class="current-price h4 mb-0 text-{{ $priceColor }}">{{ $displayPrice }}</span>
                    @if($subscription && $billing_period)
                        <span class="billing-period text-muted">/ {{ $billing_period }}</span>
                    @endif
                    @if($original_price && $sale_badge)
                        <span class="badge bg-danger">Sale</span>
                    @endif
                </div>
                @if($original_price)
                    <div class="price-details mt-1">
                        <span class="original-price text-decoration-line-through text-muted">{{ $displayOriginalPrice }}</span>
                        @if($show_discount)
                            <span class="discount-badge badge bg-success ms-2">Save {{ $discountPercentage }}%</span>
                        @endif
                    </div>
                @endif
            </div>
            @break

        @case('minimal')
            <span class="minimal-price text-{{ $priceColor }}"
                  @if($original_price)
                  data-bs-toggle="tooltip"
                  title="Original price: {{ $displayOriginalPrice }}"
                  @endif>
                {{ $displayPrice }}
            </span>
            @break

        @default
            <div class="standard-price d-flex align-items-center gap-2">
                <span class="current-price text-{{ $priceColor }}">{{ $displayPrice }}</span>
                @if($subscription && $billing_period)
                    <span class="billing-period text-muted small">/ {{ $billing_period }}</span>
                @endif
                @if($original_price)
                    <span class="original-price text-decoration-line-through text-muted">{{ $displayOriginalPrice }}</span>
                    @if($show_discount)
                        <span class="discount-percentage text-success">({{ $discountPercentage }}% off)</span>
                    @endif
                @endif
            </div>
    @endswitch
</div>

@push('styles')
<style>
    .price-display {
        --price-font-size: 1rem;
    }

    /* Size Variants */
    .price-display.size-sm {
        --price-font-size: 0.875rem;
    }

    .price-display.size-lg {
        --price-font-size: 1.25rem;
    }

    /* Price Styles */
    .price-display .current-price {
        font-size: var(--price-font-size);
        font-weight: 600;
    }

    .price-display .original-price {
        font-size: calc(var(--price-font-size) * 0.85);
    }

    /* Free Price Styling */
    .price-display.is-free .current-price {
        font-weight: 500;
    }

    /* Subscription Styling */
    .price-display.is-subscription .billing-period {
        font-size: calc(var(--price-font-size) * 0.75);
        opacity: 0.8;
    }

    /* Detailed Variant */
    .price-display.variant-detailed .current-price {
        font-size: calc(var(--price-font-size) * 1.5);
    }

    .price-display.variant-detailed .price-details {
        font-size: calc(var(--price-font-size) * 0.85);
    }

    /* Badge Styling */
    .price-display .badge {
        font-size: calc(var(--price-font-size) * 0.75);
        padding: 0.25em 0.5em;
    }

    /* Discount Animation */
    .price-display .discount-badge {
        animation: badgePulse 2s infinite;
    }

    @keyframes badgePulse {
        0% { transform: scale(1); }
        50% { transform: scale(1.05); }
        100% { transform: scale(1); }
    }

    /* Tooltip Enhancement */
    .price-display [data-bs-toggle="tooltip"] {
        cursor: help;
    }

    /* Hover Effects */
    .price-display.has-discount .current-price {
        transition: color 0.2s ease;
    }

    .price-display.has-discount:hover .current-price {
        color: var(--bs-danger);
    }
</style>
@endpush

{{-- Usage Examples:
<!-- Default Price Display -->
<x-ui.price-display
    :price="29.99"
    :original_price="49.99"
/>

<!-- Subscription Price Display -->
<x-ui.price-display
    :price="15.99"
    :subscription="true"
    billing_period="month"
    variant="detailed"
    size="lg"
/>

<!-- Free Course Display -->
<x-ui.price-display
    :price="0"
    variant="compact"
    free_text="Free Course"
/>

<!-- Minimal Price Display with Custom Currency -->
<x-ui.price-display
    :price="99.99"
    currency="EUR"
    variant="minimal"
    :show_currency="true"
/>

<!-- Detailed Price Display with Sale -->
<x-ui.price-display
    :price="79.99"
    :original_price="199.99"
    variant="detailed"
    :sale_badge="true"
    color_scheme="danger"
/>
--}}
