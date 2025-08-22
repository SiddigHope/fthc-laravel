@props([
    'level' => 'beginner',      // beginner, intermediate, advanced, expert
    'variant' => 'default',     // default, compact, badge, icon
    'show_description' => true, // Show level description
    'size' => 'md',            // sm, md, lg
    'color_scheme' => 'default' // default, monochrome, custom
])

@php
    $levels = [
        'beginner' => [
            'icon' => 'fa-seedling',
            'color' => 'success',
            'description' => 'Perfect for beginners, no prior knowledge required',
            'progress' => 25
        ],
        'intermediate' => [
            'icon' => 'fa-book-reader',
            'color' => 'info',
            'description' => 'Basic knowledge required, builds on fundamentals',
            'progress' => 50
        ],
        'advanced' => [
            'icon' => 'fa-graduation-cap',
            'color' => 'warning',
            'description' => 'Comprehensive knowledge required, covers complex topics',
            'progress' => 75
        ],
        'expert' => [
            'icon' => 'fa-award',
            'color' => 'danger',
            'description' => 'Deep expertise required, advanced concepts covered',
            'progress' => 100
        ]
    ];

    $levelInfo = $levels[$level] ?? $levels['beginner'];
    $color = $color_scheme === 'monochrome' ? 'dark' : $levelInfo['color'];

    $containerClasses = [
        'difficulty-level',
        'difficulty-' . $level,
        'size-' . $size,
        'variant-' . $variant,
        $attributes->get('class')
    ];

    $iconClasses = [
        'fas',
        $levelInfo['icon'],
        'text-' . $color
    ];
@endphp

<div class="{{ implode(' ', array_filter($containerClasses)) }}">
    @switch($variant)
        @case('badge')
            <span class="badge bg-{{ $color }} bg-opacity-10 text-{{ $color }} px-3 py-2">
                <i class="{{ implode(' ', $iconClasses) }} me-1"></i>
                {{ ucfirst($level) }}
            </span>
            @break

        @case('icon')
            <div class="difficulty-icon" data-bs-toggle="tooltip" title="{{ ucfirst($level) }}">
                <i class="{{ implode(' ', $iconClasses) }}"></i>
            </div>
            @break

        @case('compact')
            <div class="d-flex align-items-center">
                <i class="{{ implode(' ', $iconClasses) }} me-2"></i>
                <span class="difficulty-text text-{{ $color }}">{{ ucfirst($level) }}</span>
            </div>
            @break

        @default
            <div class="difficulty-container">
                <div class="difficulty-header d-flex align-items-center mb-2">
                    <i class="{{ implode(' ', $iconClasses) }} me-2"></i>
                    <span class="difficulty-text fw-bold text-{{ $color }}">{{ ucfirst($level) }}</span>
                </div>

                @if($show_description)
                    <p class="difficulty-description text-muted small mb-2">
                        {{ $levelInfo['description'] }}
                    </p>
                @endif

                <div class="difficulty-meter">
                    <div class="progress" style="height: 4px;">
                        <div class="progress-bar bg-{{ $color }}"
                             role="progressbar"
                             style="width: {{ $levelInfo['progress'] }}%"
                             aria-valuenow="{{ $levelInfo['progress'] }}"
                             aria-valuemin="0"
                             aria-valuemax="100">
                        </div>
                    </div>
                </div>
            </div>
    @endswitch
</div>

@push('styles')
<style>
    .difficulty-level {
        display: inline-block;
    }

    .difficulty-level.size-sm {
        font-size: 0.875rem;
    }

    .difficulty-level.size-lg {
        font-size: 1.25rem;
    }

    .difficulty-level .difficulty-icon {
        width: 32px;
        height: 32px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        background-color: var(--bs-gray-100);
        transition: all 0.3s ease;
    }

    .difficulty-level.size-sm .difficulty-icon {
        width: 24px;
        height: 24px;
    }

    .difficulty-level.size-lg .difficulty-icon {
        width: 40px;
        height: 40px;
    }

    .difficulty-level .difficulty-icon:hover {
        transform: scale(1.1);
    }

    .difficulty-level .difficulty-meter {
        width: 100px;
    }

    .difficulty-level.size-sm .difficulty-meter {
        width: 80px;
    }

    .difficulty-level.size-lg .difficulty-meter {
        width: 120px;
    }

    .difficulty-level .progress {
        background-color: var(--bs-gray-200);
        border-radius: 2px;
    }

    .difficulty-level .progress-bar {
        transition: width 0.5s ease;
    }

    .difficulty-level .badge {
        font-weight: 500;
    }
</style>
@endpush

{{-- Usage Examples:
<!-- Default Difficulty Level -->
<x-ui.difficulty-level
    level="intermediate"
    show_description="true"
/>

<!-- Compact Difficulty Level -->
<x-ui.difficulty-level
    level="advanced"
    variant="compact"
    size="lg"
/>

<!-- Badge Style Difficulty Level -->
<x-ui.difficulty-level
    level="expert"
    variant="badge"
    color_scheme="monochrome"
/>

<!-- Icon Only Difficulty Level -->
<x-ui.difficulty-level
    level="beginner"
    variant="icon"
    size="sm"
/>
--}}
