@props([
    'value' => 0,          // Current rating value (0-5)
    'readonly' => false,   // Read-only mode
    'size' => 'md',        // sm, md, lg
    'showValue' => true,   // Show numeric value
    'showCount' => false,  // Show ratings count
    'count' => 0,          // Number of ratings
    'interactive' => true, // Allow hover effects
    'name' => null,        // Input name for forms
    'id' => null           // Input ID for forms
])

@php
    $id = $id ?? str_replace('.', '_', uniqid('rating_', true));
    $starSizes = [
        'sm' => 'fs-6',
        'md' => 'fs-5',
        'lg' => 'fs-4'
    ];
    $starSize = $starSizes[$size] ?? $starSizes['md'];
    $value = min(5, max(0, $value));
    $fullStars = floor($value);
    $hasHalfStar = ($value - $fullStars) >= 0.5;
@endphp

<div class="rating-wrapper d-inline-flex align-items-center">
    @if(!$readonly && $interactive)
        <div class="rating-input">
            <input type="hidden" name="{{ $name }}" id="{{ $id }}" value="{{ $value }}">

            <div class="rating-stars d-inline-flex" role="radiogroup" aria-label="Rating stars">
                @for($i = 1; $i <= 5; $i++)
                    <span class="star-wrapper"
                          data-rating="{{ $i }}"
                          role="radio"
                          aria-checked="{{ $i <= $value ? 'true' : 'false' }}"
                          tabindex="0">
                        <i class="far fa-star {{ $starSize }} text-warning star-default"></i>
                        <i class="fas fa-star {{ $starSize }} text-warning star-filled"></i>
                    </span>
                @endfor
            </div>
        </div>
    @else
        <div class="rating-display">
            @for($i = 1; $i <= 5; $i++)
                @if($i <= $fullStars)
                    <i class="fas fa-star {{ $starSize }} text-warning"></i>
                @elseif($i == $fullStars + 1 && $hasHalfStar)
                    <i class="fas fa-star-half-alt {{ $starSize }} text-warning"></i>
                @else
                    <i class="far fa-star {{ $starSize }} text-warning"></i>
                @endif
            @endfor
        </div>
    @endif

    @if($showValue || $showCount)
        <div class="rating-info ms-2">
            @if($showValue)
                <span class="rating-value">{{ number_format($value, 1) }}</span>
            @endif
            @if($showCount)
                <span class="rating-count text-muted ms-1">({{ number_format($count) }} ratings)</span>
            @endif
        </div>
    @endif
</div>

@if(!$readonly && $interactive)
@push('styles')
<style>
    .rating-wrapper .rating-stars {
        position: relative;
        display: inline-flex;
        cursor: pointer;
    }
    .rating-wrapper .star-wrapper {
        position: relative;
        padding: 0 2px;
    }
    .rating-wrapper .star-filled {
        position: absolute;
        top: 0;
        left: 2px;
        opacity: 0;
        transition: opacity 0.2s ease;
    }
    .rating-wrapper .rating-stars:hover .star-filled,
    .rating-wrapper .star-wrapper:hover ~ .star-wrapper .star-filled {
        opacity: 0;
    }
    .rating-wrapper .star-wrapper:hover .star-filled,
    .rating-wrapper .star-wrapper:hover ~ .star-wrapper .star-filled {
        opacity: 1;
    }
    .rating-wrapper .rating-stars[data-rating] .star-wrapper:nth-child(-n + var(--rating)) .star-filled {
        opacity: 1;
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ratingWrapper = document.querySelector('#{{ $id }}').closest('.rating-wrapper');
        const ratingInput = document.querySelector('#{{ $id }}');
        const stars = ratingWrapper.querySelectorAll('.star-wrapper');

        stars.forEach(star => {
            star.addEventListener('click', () => {
                const rating = star.dataset.rating;
                ratingInput.value = rating;
                ratingWrapper.querySelector('.rating-stars').style.setProperty('--rating', rating);
                ratingWrapper.dispatchEvent(new CustomEvent('rating-changed', { detail: { rating } }));
            });

            // Keyboard navigation
            star.addEventListener('keydown', (e) => {
                if (e.key === ' ' || e.key === 'Enter') {
                    e.preventDefault();
                    star.click();
                }
            });
        });
    });
</script>
@endpush
@endif

{{-- Usage Example:
<!-- Read-only Rating Display -->
<x-ui.rating
    :value="4.5"
    readonly
    size="lg"
    :count="1234"
    showCount
/>

<!-- Interactive Rating Input -->
<form action="/rate" method="POST">
    @csrf
    <x-ui.rating
        name="course_rating"
        :value="0"
        size="lg"
        :interactive="true"
    />
    <button type="submit" class="btn btn-primary mt-3">Submit Rating</button>
</form>
--}}
