@props([
    'rating' => 0,           // Rating value (0-5)
    'total_ratings' => null, // Total number of ratings
    'variant' => 'default',  // default, compact, detailed, minimal
    'size' => 'md',         // sm, md, lg
    'show_count' => true,    // Show ratings count
    'show_text' => true,     // Show rating text
    'color_scheme' => null,  // Custom color scheme
    'interactive' => false,  // Allow rating interaction
    'half_stars' => true,    // Allow half star ratings
    'with_animation' => true // Enable hover animations
])

@php
    // Ensure rating is within valid range
    $rating = max(0, min(5, $rating));

    // Format rating for display
    $displayRating = number_format($rating, 1);

    // Calculate filled stars (including half stars)
    $filledStars = floor($rating);
    $hasHalfStar = $half_stars && ($rating - $filledStars) >= 0.5;
    $emptyStars = 5 - $filledStars - ($hasHalfStar ? 1 : 0);

    // Generate rating text
    $ratingText = match(true) {
        $rating >= 4.5 => 'Excellent',
        $rating >= 4.0 => 'Very Good',
        $rating >= 3.0 => 'Good',
        $rating >= 2.0 => 'Fair',
        $rating > 0 => 'Poor',
        default => 'Not Rated'
    };

    // Generate color based on rating
    $ratingColor = $color_scheme ?? match(true) {
        $rating >= 4.5 => 'success',
        $rating >= 4.0 => 'primary',
        $rating >= 3.0 => 'info',
        $rating >= 2.0 => 'warning',
        $rating > 0 => 'danger',
        default => 'secondary'
    };

    // Container classes
    $containerClasses = [
        'rating-display',
        'variant-' . $variant,
        'size-' . $size,
        $interactive ? 'interactive' : '',
        $with_animation ? 'animated' : '',
        $attributes->get('class')
    ];
@endphp

<div class="{{ implode(' ', array_filter($containerClasses)) }}">
    @switch($variant)
        @case('compact')
            <div class="d-inline-flex align-items-center">
                <div class="stars me-1">
                    <i class="fas fa-star text-{{ $ratingColor }}"></i>
                </div>
                <span class="rating-value text-{{ $ratingColor }}">{{ $displayRating }}</span>
                @if($show_count && $total_ratings)
                    <span class="rating-count text-muted ms-1">({{ $total_ratings }})</span>
                @endif
            </div>
            @break

        @case('detailed')
            <div class="detailed-rating">
                <div class="rating-header d-flex align-items-center mb-2">
                    <span class="rating-value h4 mb-0 text-{{ $ratingColor }}">{{ $displayRating }}</span>
                    @if($show_text)
                        <span class="rating-text ms-2">{{ $ratingText }}</span>
                    @endif
                </div>
                <div class="stars-container mb-1">
                    @for($i = 0; $i < $filledStars; $i++)
                        <i class="fas fa-star text-{{ $ratingColor }}"></i>
                    @endfor
                    @if($hasHalfStar)
                        <i class="fas fa-star-half-alt text-{{ $ratingColor }}"></i>
                    @endif
                    @for($i = 0; $i < $emptyStars; $i++)
                        <i class="far fa-star text-{{ $ratingColor }}"></i>
                    @endfor
                </div>
                @if($show_count && $total_ratings)
                    <div class="rating-meta text-muted small">
                        Based on {{ number_format($total_ratings) }} ratings
                    </div>
                @endif
            </div>
            @break

        @case('minimal')
            <div class="minimal-rating d-inline-flex align-items-center"
                 data-bs-toggle="tooltip"
                 title="{{ $ratingText }} - {{ $displayRating }} out of 5">
                <i class="fas fa-star text-{{ $ratingColor }} me-1"></i>
                <span class="rating-value">{{ $displayRating }}</span>
            </div>
            @break

        @default
            <div class="standard-rating d-flex align-items-center">
                <div class="stars-container me-2" @if($interactive) role="button" @endif>
                    @for($i = 0; $i < $filledStars; $i++)
                        <i class="fas fa-star text-{{ $ratingColor }}" data-rating="{{ $i + 1 }}"></i>
                    @endfor
                    @if($hasHalfStar)
                        <i class="fas fa-star-half-alt text-{{ $ratingColor }}" data-rating="{{ $filledStars + 0.5 }}"></i>
                    @endif
                    @for($i = 0; $i < $emptyStars; $i++)
                        <i class="far fa-star text-{{ $ratingColor }}" data-rating="{{ $filledStars + ($hasHalfStar ? 1 : 0) + $i + 1 }}"></i>
                    @endfor
                </div>
                @if($show_text)
                    <span class="rating-text">{{ $ratingText }}</span>
                @endif
                @if($show_count && $total_ratings)
                    <span class="rating-count text-muted ms-2">({{ number_format($total_ratings) }})</span>
                @endif
            </div>
    @endswitch
</div>

@push('styles')
<style>
    .rating-display {
        --star-size: 1rem;
        --star-spacing: 0.125rem;
    }

    /* Size Variants */
    .rating-display.size-sm {
        --star-size: 0.875rem;
        font-size: 0.875rem;
    }

    .rating-display.size-lg {
        --star-size: 1.25rem;
        font-size: 1.125rem;
    }

    /* Star Styles */
    .rating-display .stars-container {
        display: inline-flex;
        align-items: center;
    }

    .rating-display .stars-container i {
        font-size: var(--star-size);
        margin-right: var(--star-spacing);
    }

    /* Interactive Styles */
    .rating-display.interactive .stars-container {
        cursor: pointer;
    }

    .rating-display.interactive.animated .stars-container i {
        transition: transform 0.2s ease, color 0.2s ease;
    }

    .rating-display.interactive.animated .stars-container:hover i {
        transform: scale(1.1);
    }

    /* Detailed Variant */
    .rating-display.variant-detailed .rating-value {
        line-height: 1;
    }

    .rating-display.variant-detailed .rating-text {
        font-size: 0.9em;
        color: var(--bs-gray-600);
    }

    /* Minimal Variant */
    .rating-display.variant-minimal {
        cursor: help;
    }

    /* Animation */
    @keyframes starPulse {
        0% { transform: scale(1); }
        50% { transform: scale(1.2); }
        100% { transform: scale(1); }
    }

    .rating-display.animated .stars-container i {
        animation: starPulse 1s ease-in-out;
        animation-fill-mode: both;
    }

    .rating-display.animated .stars-container i:nth-child(1) { animation-delay: 0.1s; }
    .rating-display.animated .stars-container i:nth-child(2) { animation-delay: 0.2s; }
    .rating-display.animated .stars-container i:nth-child(3) { animation-delay: 0.3s; }
    .rating-display.animated .stars-container i:nth-child(4) { animation-delay: 0.4s; }
    .rating-display.animated .stars-container i:nth-child(5) { animation-delay: 0.5s; }
</style>
@endpush

@push('scripts')
@if($interactive)
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ratingContainers = document.querySelectorAll('.rating-display.interactive');

        ratingContainers.forEach(container => {
            const stars = container.querySelectorAll('.stars-container i');

            stars.forEach(star => {
                star.addEventListener('click', function() {
                    const rating = this.dataset.rating;
                    // Emit custom event for rating change
                    const event = new CustomEvent('rating-changed', {
                        detail: { rating: parseFloat(rating) }
                    });
                    container.dispatchEvent(event);
                });

                if (container.classList.contains('animated')) {
                    star.addEventListener('mouseenter', function() {
                        const rating = this.dataset.rating;
                        updateStarsDisplay(stars, rating);
                    });
                }
            });

            if (container.classList.contains('animated')) {
                container.querySelector('.stars-container').addEventListener('mouseleave', function() {
                    updateStarsDisplay(stars, {{ $rating }});
                });
            }
        });

        function updateStarsDisplay(stars, rating) {
            stars.forEach(star => {
                const starRating = parseFloat(star.dataset.rating);
                if (starRating <= rating) {
                    star.classList.remove('far');
                    star.classList.add('fas');
                } else {
                    star.classList.remove('fas');
                    star.classList.add('far');
                }
            });
        }
    });
</script>
@endif
@endpush

{{-- Usage Examples:
<!-- Default Rating Display -->
<x-ui.rating-display
    :rating="4.5"
    :total_ratings="128"
/>

<!-- Compact Rating Display -->
<x-ui.rating-display
    :rating="4.2"
    variant="compact"
    size="sm"
    color_scheme="primary"
/>

<!-- Detailed Rating Display -->
<x-ui.rating-display
    :rating="4.8"
    :total_ratings="256"
    variant="detailed"
    size="lg"
/>

<!-- Interactive Rating Display -->
<x-ui.rating-display
    :rating="3.5"
    :interactive="true"
    :half_stars="false"
/>

<!-- Minimal Rating Display -->
<x-ui.rating-display
    :rating="4.0"
    variant="minimal"
    :show_count="false"
    :show_text="false"
/>
--}}
