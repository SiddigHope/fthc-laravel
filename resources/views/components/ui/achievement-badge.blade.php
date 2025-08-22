@props([
    'title' => '',           // Achievement title
    'description' => '',     // Achievement description
    'icon' => null,         // Achievement icon (FontAwesome class)
    'image' => null,        // Achievement image/badge URL
    'progress' => null,     // Progress percentage (0-100)
    'earned' => false,      // Whether the achievement is earned
    'earnedDate' => null,   // Date when achievement was earned
    'points' => null,       // Points awarded for achievement
    'variant' => 'default', // default, minimal, compact
    'size' => 'md',         // sm, md, lg
    'animate' => true       // Enable animation when earned
])

@php
    $cardClasses = [
        'achievement-badge card h-100',
        $variant === 'minimal' ? 'border-0 bg-light' : '',
        $variant === 'compact' ? 'achievement-badge-compact' : '',
        $earned ? 'achievement-earned' : 'achievement-locked',
        $animate && $earned ? 'achievement-animate' : '',
        'achievement-' . $size,
        $attributes->get('class')
    ];

    $iconClasses = [
        'achievement-icon',
        $earned ? 'text-warning' : 'text-muted opacity-50',
        $size === 'sm' ? 'fs-4' : 'fs-2'
    ];

    $progressColor = match(true) {
        $progress >= 75 => 'success',
        $progress >= 50 => 'info',
        $progress >= 25 => 'warning',
        default => 'danger'
    };
@endphp

<div class="{{ implode(' ', array_filter($cardClasses)) }}">
    <div class="card-body">
        <div class="achievement-content">
            <div class="achievement-media mb-3 text-center">
                @if($image)
                    <img src="{{ asset($image) }}"
                         class="achievement-image {{ !$earned ? 'grayscale' : '' }}"
                         alt="{{ $title }}">
                @elseif($icon)
                    <i class="{{ $icon }} {{ implode(' ', $iconClasses) }}"></i>
                @endif

                @if($earned)
                    <div class="achievement-check">
                        <i class="fas fa-check-circle text-success"></i>
                    </div>
                @endif
            </div>

            <div class="achievement-info {{ $variant === 'compact' ? 'text-center' : '' }}">
                <h6 class="achievement-title mb-1">{{ $title }}</h6>

                @if($description && $variant !== 'compact')
                    <p class="achievement-description small text-muted mb-2">
                        {{ $description }}
                    </p>
                @endif

                @if($points && $earned)
                    <div class="achievement-points text-warning small mb-2">
                        <i class="fas fa-star me-1"></i> {{ $points }} points
                    </div>
                @endif

                @if($progress !== null && !$earned)
                    <div class="achievement-progress mt-2">
                        <div class="progress" style="height: 5px;">
                            <div class="progress-bar bg-{{ $progressColor }}"
                                 role="progressbar"
                                 style="width: {{ $progress }}%"
                                 aria-valuenow="{{ $progress }}"
                                 aria-valuemin="0"
                                 aria-valuemax="100">
                            </div>
                        </div>
                        <div class="small text-muted mt-1">
                            Progress: {{ $progress }}%
                        </div>
                    </div>
                @endif

                @if($earnedDate && $earned && $variant !== 'compact')
                    <div class="achievement-date small text-muted mt-2">
                        <i class="fas fa-calendar-check me-1"></i>
                        Earned {{ \Carbon\Carbon::parse($earnedDate)->diffForHumans() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .achievement-badge {
        position: relative;
        transition: all 0.3s ease;
    }

    .achievement-media {
        position: relative;
    }

    .achievement-image {
        max-width: 100%;
        height: auto;
        transition: all 0.3s ease;
    }

    .achievement-image.grayscale {
        filter: grayscale(100%) opacity(50%);
    }

    .achievement-check {
        position: absolute;
        top: -5px;
        right: -5px;
        background: white;
        border-radius: 50%;
        padding: 2px;
    }

    .achievement-badge-compact .achievement-media {
        margin-bottom: 0.5rem;
    }

    .achievement-badge-compact .achievement-title {
        font-size: 0.875rem;
    }

    .achievement-sm .achievement-image {
        max-width: 60px;
    }

    .achievement-lg .achievement-image {
        max-width: 120px;
    }

    .achievement-animate {
        animation: achievementEarned 1s ease-out;
    }

    @keyframes achievementEarned {
        0% {
            transform: scale(1);
        }
        50% {
            transform: scale(1.05);
        }
        100% {
            transform: scale(1);
        }
    }

    .achievement-locked .achievement-title {
        color: var(--bs-gray-600);
    }

    .achievement-earned .achievement-title {
        color: var(--bs-primary);
    }
</style>
@endpush

{{-- Usage Examples:
<!-- Default Achievement Badge -->
<x-ui.achievement-badge
    title="Course Completion Master"
    description="Complete 10 courses"
    icon="fas fa-graduation-cap"
    :progress="60"
/>

<!-- Earned Achievement with Image -->
<x-ui.achievement-badge
    title="Python Expert"
    description="Complete all Python courses"
    image="images/badges/python-expert.png"
    :earned="true"
    earnedDate="2023-06-15"
    :points="500"
/>

<!-- Minimal Achievement Badge -->
<x-ui.achievement-badge
    title="First Assignment"
    description="Submit your first assignment"
    icon="fas fa-tasks"
    :earned="true"
    variant="minimal"
    size="sm"
/>

<!-- Compact Achievement Badge -->
<x-ui.achievement-badge
    title="Discussion Starter"
    icon="fas fa-comments"
    :progress="30"
    variant="compact"
    :animate="false"
/>
--}}
