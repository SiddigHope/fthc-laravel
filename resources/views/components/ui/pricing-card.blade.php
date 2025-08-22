@props([
    'title' => '',           // Plan title
    'price' => 0,           // Plan price
    'period' => 'monthly',  // Billing period (monthly, yearly, lifetime, one-time)
    'currency' => '$',      // Currency symbol
    'features' => [],       // Array of features
    'popular' => false,     // Popular/highlighted plan
    'buttonText' => 'Get Started', // CTA button text
    'buttonUrl' => '#',     // CTA button URL
    'discount' => null,     // Discount percentage or amount
    'originalPrice' => null, // Original price before discount
    'trial' => null,        // Trial period (e.g., '7 days')
    'variant' => 'default', // default, outline, minimal
    'layout' => 'default'   // default, compact, horizontal
])

@php
    $cardClasses = [
        'card pricing-card h-100',
        $variant === 'outline' ? 'border-2' : '',
        $popular ? 'border-primary shadow' : '',
        $variant === 'minimal' ? 'border-0 shadow-sm' : '',
        $layout === 'horizontal' ? 'pricing-card-horizontal' : '',
        $attributes->get('class')
    ];

    $buttonClasses = [
        'btn',
        $popular ? 'btn-primary' : 'btn-outline-primary',
        $layout === 'compact' ? 'btn-sm' : ''
    ];

    $formatPrice = function($amount) use ($currency) {
        if ($amount >= 1000) {
            return $currency . number_format($amount / 1000, 1) . 'k';
        }
        return $currency . number_format($amount, 2);
    };

    $periods = [
        'monthly' => '/mo',
        'yearly' => '/yr',
        'lifetime' => '',
        'one-time' => ''
    ];
@endphp

<div class="{{ implode(' ', array_filter($cardClasses)) }}">
    @if($popular)
        <div class="card-header border-0 pb-0">
            <div class="ribbon ribbon-top-right">
                <span class="bg-primary">Popular</span>
            </div>
        </div>
    @endif

    <div class="card-body {{ $layout === 'horizontal' ? 'row align-items-center' : '' }}">
        <div class="{{ $layout === 'horizontal' ? 'col-md-4' : '' }}">
            <!-- Plan Title & Price -->
            <div class="text-{{ $layout === 'horizontal' ? 'start' : 'center' }} mb-{{ $layout === 'horizontal' ? '0' : '4' }}">
                <h5 class="mb-2">{{ $title }}</h5>
                <div class="pricing-amount mb-2">
                    @if($discount)
                        <span class="h6 text-decoration-line-through text-muted me-2">
                            {{ $formatPrice($originalPrice) }}
                        </span>
                    @endif
                    <span class="h2 mb-0 fw-bold">
                        {{ $formatPrice($price) }}
                    </span>
                    @if($period !== 'one-time' && $period !== 'lifetime')
                        <span class="fs-6 text-muted">{{ $periods[$period] }}</span>
                    @endif
                </div>
                @if($discount)
                    <span class="badge bg-danger-soft text-danger mb-2">
                        Save {{ is_numeric($discount) ? $discount . '%' : $discount }}
                    </span>
                @endif
                @if($trial)
                    <div class="text-muted small">
                        {{ $trial }} free trial
                    </div>
                @endif
            </div>
        </div>

        <div class="{{ $layout === 'horizontal' ? 'col-md-8' : '' }}">
            <!-- Features List -->
            <ul class="list-unstyled mb-4">
                @foreach($features as $feature)
                    <li class="mb-2 {{ $layout === 'compact' ? 'small' : '' }}">
                        @if(is_array($feature))
                            <div class="d-flex align-items-center">
                                @if($feature['included'])
                                    <i class="fas fa-check text-success me-2"></i>
                                @else
                                    <i class="fas fa-times text-danger me-2"></i>
                                @endif
                                <span class="{{ !$feature['included'] ? 'text-muted' : '' }}">
                                    {{ $feature['text'] }}
                                    @if(!empty($feature['tooltip']))
                                        <i class="fas fa-info-circle ms-1 text-muted"
                                           data-bs-toggle="tooltip"
                                           data-bs-placement="top"
                                           title="{{ $feature['tooltip'] }}"></i>
                                    @endif
                                </span>
                            </div>
                        @else
                            <div class="d-flex align-items-center">
                                <i class="fas fa-check text-success me-2"></i>
                                <span>{{ $feature }}</span>
                            </div>
                        @endif
                    </li>
                @endforeach
            </ul>

            <!-- CTA Button -->
            <div class="text-{{ $layout === 'horizontal' ? 'end' : 'center' }}">
                <a href="{{ $buttonUrl }}" class="{{ implode(' ', $buttonClasses) }}">
                    {{ $buttonText }}
                </a>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .pricing-card .ribbon {
        width: 150px;
        height: 150px;
        position: absolute;
        top: -10px;
        right: -10px;
        overflow: hidden;
    }

    .pricing-card .ribbon span {
        position: absolute;
        display: block;
        width: 225px;
        padding: 8px 0;
        background-color: var(--bs-primary);
        color: #fff;
        text-align: center;
        transform: rotate(45deg);
        right: -45px;
        top: 30px;
        text-transform: uppercase;
        font-size: 12px;
        font-weight: 700;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    .pricing-card-horizontal .pricing-amount {
        white-space: nowrap;
    }

    .pricing-card.border-primary .card-header {
        background-color: transparent;
    }
</style>
@endpush

{{-- Usage Example:
<!-- Default Pricing Card -->
<x-ui.pricing-card
    title="Basic Plan"
    :price="29.99"
    period="monthly"
    :features="[
        'Access to all basic courses',
        'Limited downloads',
        ['text' => 'Community support', 'included' => true],
        ['text' => 'Certificate of completion', 'included' => false]
    ]"
/>

<!-- Popular Pricing Card with Discount -->
<x-ui.pricing-card
    title="Pro Plan"
    :price="199.99"
    :originalPrice="299.99"
    period="yearly"
    :discount="33"
    :popular="true"
    trial="14 days"
    buttonText="Start Free Trial"
    :features="[
        'Access to all courses',
        'Unlimited downloads',
        ['text' => 'Priority support', 'included' => true, 'tooltip' => '24/7 email and chat support'],
        'Course completion certificate',
        'Ad-free experience'
    ]"
/>

<!-- Minimal Compact Pricing Card -->
<x-ui.pricing-card
    title="Lifetime Access"
    :price="499"
    period="lifetime"
    variant="minimal"
    layout="compact"
    :features="[
        'One-time payment',
        'Access to all current and future courses',
        'Downloadable resources',
        'Premium support'
    ]"
/>

<!-- Horizontal Pricing Card -->
<x-ui.pricing-card
    title="Team Plan"
    :price="99.99"
    period="monthly"
    layout="horizontal"
    buttonText="Contact Sales"
    :features="[
        'Up to 10 team members',
        'Team progress tracking',
        'Dedicated account manager',
        'Custom learning paths'
    ]"
/>
--}}
