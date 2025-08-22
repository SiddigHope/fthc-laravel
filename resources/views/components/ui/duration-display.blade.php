@props([
    'duration' => null,        // Duration in minutes or timestamp string
    'format' => 'auto',       // auto, minutes, hours, detailed
    'variant' => 'default',   // default, compact, icon-only, badge
    'size' => 'md',          // sm, md, lg
    'show_icon' => true,     // Show clock icon
    'color_scheme' => null,   // Bootstrap color classes
    'with_tooltip' => false,  // Show detailed duration in tooltip
    'custom_text' => null     // Custom duration text
])

@php
    // Helper function to format duration
    function formatDuration($minutes) {
        if ($minutes < 1) return '< 1 min';

        $hours = floor($minutes / 60);
        $mins = $minutes % 60;

        if ($hours > 0) {
            return $mins > 0 ? "{$hours}h {$mins}m" : "{$hours}h";
        }
        return "{$minutes}m";
    }

    // Process duration input
    $minutes = 0;
    if (is_numeric($duration)) {
        $minutes = (int) $duration;
    } elseif (is_string($duration) && strpos($duration, ':') !== false) {
        $parts = explode(':', $duration);
        if (count($parts) === 2) { // HH:MM format
            $minutes = (int) $parts[0] * 60 + (int) $parts[1];
        } elseif (count($parts) === 3) { // HH:MM:SS format
            $minutes = (int) $parts[0] * 60 + (int) $parts[1];
        }
    }

    // Determine display format
    $displayText = $custom_text ?? match($format) {
        'minutes' => $minutes . ' min',
        'hours' => number_format($minutes / 60, 1) . ' hours',
        'detailed' => formatDuration($minutes),
        default => formatDuration($minutes)
    };

    // Build classes
    $containerClasses = [
        'duration-display',
        'variant-' . $variant,
        'size-' . $size,
        $color_scheme ? 'text-' . $color_scheme : '',
        $attributes->get('class')
    ];

    $tooltipText = $with_tooltip
        ? "Total duration: " . floor($minutes / 60) . " hours " . ($minutes % 60) . " minutes"
        : '';
@endphp

<div class="{{ implode(' ', array_filter($containerClasses)) }}"
     @if($with_tooltip) data-bs-toggle="tooltip" title="{{ $tooltipText }}" @endif>
    @switch($variant)
        @case('badge')
            <span class="badge {{ $color_scheme ? 'bg-'.$color_scheme : 'bg-light text-dark' }}">
                @if($show_icon)
                    <i class="far fa-clock me-1"></i>
                @endif
                {{ $displayText }}
            </span>
            @break

        @case('icon-only')
            <span class="icon-only" data-bs-toggle="tooltip" title="{{ $displayText }}">
                <i class="far fa-clock"></i>
            </span>
            @break

        @case('compact')
            <span class="d-inline-flex align-items-center">
                @if($show_icon)
                    <i class="far fa-clock me-1"></i>
                @endif
                {{ $displayText }}
            </span>
            @break

        @default
            <div class="d-flex align-items-center">
                @if($show_icon)
                    <div class="duration-icon me-2">
                        <i class="far fa-clock"></i>
                    </div>
                @endif
                <div class="duration-content">
                    <span class="duration-text">{{ $displayText }}</span>
                    @if($format === 'detailed' && $minutes >= 60)
                        <span class="duration-breakdown text-muted small d-block">
                            ({{ floor($minutes / 60) }} hours {{ $minutes % 60 }} minutes)
                        </span>
                    @endif
                </div>
            </div>
    @endswitch
</div>

@push('styles')
<style>
    .duration-display {
        --duration-icon-size: 1rem;
        display: inline-block;
    }

    /* Size Variants */
    .duration-display.size-sm {
        --duration-icon-size: 0.875rem;
        font-size: 0.875rem;
    }

    .duration-display.size-lg {
        --duration-icon-size: 1.25rem;
        font-size: 1.125rem;
    }

    /* Icon Styles */
    .duration-display .duration-icon i,
    .duration-display .icon-only i {
        font-size: var(--duration-icon-size);
    }

    /* Badge Variant */
    .duration-display.variant-badge .badge {
        font-weight: 500;
        padding: 0.5em 0.85em;
    }

    /* Icon Only Variant */
    .duration-display.variant-icon-only {
        width: var(--duration-icon-size);
        height: var(--duration-icon-size);
        line-height: 1;
    }

    .duration-display .icon-only {
        cursor: help;
    }

    /* Hover Effects */
    .duration-display .duration-icon {
        transition: transform 0.2s ease;
    }

    .duration-display:hover .duration-icon {
        transform: scale(1.1);
    }

    /* Tooltip Enhancement */
    .duration-display[data-bs-toggle="tooltip"] {
        cursor: help;
    }

    /* Duration Breakdown */
    .duration-display .duration-breakdown {
        font-size: 0.85em;
        opacity: 0.8;
    }
</style>
@endpush

{{-- Usage Examples:
<!-- Default Duration Display -->
<x-ui.duration-display
    :duration="90"
/>

<!-- Badge Style with Hours Format -->
<x-ui.duration-display
    duration="2:30:00"
    variant="badge"
    format="hours"
    color_scheme="primary"
/>

<!-- Compact Style with Custom Text -->
<x-ui.duration-display
    :duration="45"
    variant="compact"
    custom_text="45 min study time"
    size="sm"
/>

<!-- Detailed Format with Tooltip -->
<x-ui.duration-display
    duration="1:45:00"
    format="detailed"
    :with_tooltip="true"
    size="lg"
/>

<!-- Icon Only with Tooltip -->
<x-ui.duration-display
    :duration="120"
    variant="icon-only"
    color_scheme="info"
/>
--}}
