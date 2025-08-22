@props([
    'title' => '',           // Category title
    'description' => '',     // Category description
    'icon' => null,         // Category icon (FontAwesome class or image URL)
    'courses' => 0,         // Number of courses in category
    'students' => 0,        // Number of students in category
    'url' => '#',           // Category URL
    'image' => null,        // Background or feature image URL
    'color' => null,        // Theme color for the card
    'variant' => 'default', // default, minimal, overlay
    'size' => 'md',         // sm, md, lg
    'hover' => true         // Enable hover effects
])

@php
    $cardClasses = [
        'card category-card h-100',
        $variant === 'minimal' ? 'border-0 bg-light' : '',
        $variant === 'overlay' ? 'card-overlay-bottom' : '',
        $hover ? 'card-hover-shadow' : '',
        'card-size-' . $size,
        $attributes->get('class')
    ];

    $iconClasses = [
        'category-icon',
        'display-6',
        $color ? "text-{$color}" : 'text-primary',
        $variant === 'overlay' ? 'text-white' : ''
    ];

    $textColorClass = $variant === 'overlay' ? 'text-white' : '';

    $statsTextClass = array_filter([
        'text-muted',
        $variant === 'overlay' ? 'text-white' : ''
    ]);
@endphp

<div class="{{ implode(' ', array_filter($cardClasses)) }}">
    @if($variant === 'overlay' && $image)
        <div class="card-img-overlay-bg">
            <img src="{{ asset($image) }}" class="card-img" alt="{{ $title }}">
        </div>
    @endif

    <a href="{{ $url }}" class="card-body p-4">
        <div class="d-flex align-items-center mb-3">
            @if($icon)
                @if(str_contains($icon, 'fa-'))
                    <i class="{{ $icon }} {{ implode(' ', $iconClasses) }}"></i>
                @else
                    <img src="{{ asset($icon) }}" class="category-icon me-2" alt="">
                @endif
            @endif

            @if(!$variant === 'overlay' && $image)
                <img src="{{ asset($image) }}"
                     class="rounded {{ $size === 'sm' ? 'w-50px' : 'w-80px' }} me-3"
                     alt="{{ $title }}">
            @endif
        </div>

        <h5 class="card-title {{ $textColorClass }}">{{ $title }}</h5>

        @if($description)
            <p class="card-text mb-3 {{ implode(' ', $statsTextClass) }}">
                {{ $description }}
            </p>
        @endif

        <div class="d-flex align-items-center {{ $size === 'sm' ? 'small' : '' }}">
            @if($courses > 0)
                <div class="me-3 {{ implode(' ', $statsTextClass) }}">
                    <i class="fas fa-book-open me-1 opacity-50"></i>
                    {{ $courses }} {{ Str::plural('Course', $courses) }}
                </div>
            @endif

            @if($students > 0)
                <div class="{{ implode(' ', $statsTextClass) }}">
                    <i class="fas fa-user-graduate me-1 opacity-50"></i>
                    {{ number_format($students) }} {{ Str::plural('Student', $students) }}
                </div>
            @endif
        </div>
    </a>
</div>

@push('styles')
<style>
    .category-card {
        transition: all 0.3s ease;
    }

    .category-card.card-hover-shadow:hover {
        transform: translateY(-5px);
    }

    .category-card .category-icon {
        width: 60px;
        height: 60px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 1rem;
    }

    .category-card.card-size-sm .category-icon {
        width: 40px;
        height: 40px;
        font-size: 1.25rem;
    }

    .category-card.card-size-lg .category-icon {
        width: 80px;
        height: 80px;
        font-size: 2.5rem;
    }

    .category-card.card-overlay-bottom {
        position: relative;
        overflow: hidden;
    }

    .category-card.card-overlay-bottom .card-img-overlay-bg {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
    }

    .category-card.card-overlay-bottom .card-img-overlay-bg::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(180deg, rgba(0,0,0,0) 0%, rgba(0,0,0,0.8) 100%);
    }

    .category-card.card-overlay-bottom .card-img {
        height: 100%;
        object-fit: cover;
    }

    .category-card.card-overlay-bottom .card-body {
        position: relative;
        z-index: 1;
    }

    .w-50px { width: 50px !important; }
    .w-80px { width: 80px !important; }
</style>
@endpush

{{-- Usage Examples:
<!-- Default Category Card -->
<x-ui.category-card
    title="Web Development"
    description="Learn modern web development technologies"
    icon="fas fa-code"
    :courses="125"
    :students="12500"
    url="/categories/web-development"
    color="primary"
/>

<!-- Minimal Category Card -->
<x-ui.category-card
    title="Digital Marketing"
    icon="fas fa-bullhorn"
    :courses="85"
    :students="9800"
    variant="minimal"
    size="sm"
/>

<!-- Overlay Category Card with Image -->
<x-ui.category-card
    title="Photography"
    description="Master the art of photography"
    :courses="45"
    :students="5600"
    image="images/categories/photography.jpg"
    variant="overlay"
    size="lg"
/>

<!-- Category Card with Custom Image Icon -->
<x-ui.category-card
    title="Data Science"
    description="Explore data analysis and machine learning"
    icon="images/icons/data-science.svg"
    :courses="95"
    :students="15800"
    color="info"
/>
--}}
