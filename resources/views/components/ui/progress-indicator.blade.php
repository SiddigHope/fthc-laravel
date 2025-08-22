@props([
    'progress' => 0,           // Progress percentage (0-100)
    'variant' => 'default',    // default, circular, minimal, detailed
    'size' => 'md',           // sm, md, lg
    'show_label' => true,      // Show progress label
    'show_icon' => true,       // Show status icon
    'animate' => true,         // Enable animation
    'color_scheme' => 'auto',  // auto, success, warning, danger, info
    'status_text' => null,     // Custom status text
    'total_items' => null,     // Total number of items
    'completed_items' => null  // Number of completed items
])

@php
    // Ensure progress is within valid range
    $progress = max(0, min(100, $progress));

    // Determine color based on progress or specified color scheme
    $color = $color_scheme === 'auto'
        ? ($progress >= 100 ? 'success'
            : ($progress >= 70 ? 'info'
                : ($progress >= 30 ? 'warning' : 'danger')))
        : $color_scheme;

    // Generate status text if not provided
    $status = $status_text ?? ($progress >= 100 ? 'Completed'
        : ($progress >= 70 ? 'In Progress'
            : ($progress > 0 ? 'Started' : 'Not Started')));

    $containerClasses = [
        'progress-indicator',
        'variant-' . $variant,
        'size-' . $size,
        $animate ? 'animate' : '',
        $attributes->get('class')
    ];

    $getStatusIcon = function() use ($progress) {
        if ($progress >= 100) return 'fa-check-circle';
        if ($progress >= 70) return 'fa-running';
        if ($progress > 0) return 'fa-walking';
        return 'fa-circle';
    };
@endphp

<div class="{{ implode(' ', array_filter($containerClasses)) }}">
    @switch($variant)
        @case('circular')
            <div class="circular-progress">
                <svg viewBox="0 0 36 36" class="circular-chart">
                    <path class="circle-bg"
                        d="M18 2.0845
                        a 15.9155 15.9155 0 0 1 0 31.831
                        a 15.9155 15.9155 0 0 1 0 -31.831"
                    />
                    <path class="circle text-{{ $color }}"
                        stroke-dasharray="{{ $progress }}, 100"
                        d="M18 2.0845
                        a 15.9155 15.9155 0 0 1 0 31.831
                        a 15.9155 15.9155 0 0 1 0 -31.831"
                    />
                    <text x="18" y="20.35" class="percentage">{{ $progress }}%</text>
                </svg>
                @if($show_label)
                    <div class="status-text text-{{ $color }} mt-2">{{ $status }}</div>
                @endif
            </div>
            @break

        @case('minimal')
            <div class="d-flex align-items-center">
                @if($show_icon)
                    <i class="fas {{ $getStatusIcon() }} text-{{ $color }} me-2"></i>
                @endif
                <div class="progress flex-grow-1" style="height: 4px;">
                    <div class="progress-bar bg-{{ $color }}"
                         role="progressbar"
                         style="width: {{ $progress }}%"
                         aria-valuenow="{{ $progress }}"
                         aria-valuemin="0"
                         aria-valuemax="100">
                    </div>
                </div>
                @if($show_label)
                    <span class="ms-2 small">{{ $progress }}%</span>
                @endif
            </div>
            @break

        @case('detailed')
            <div class="detailed-progress">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <div class="d-flex align-items-center">
                        @if($show_icon)
                            <i class="fas {{ $getStatusIcon() }} text-{{ $color }} me-2"></i>
                        @endif
                        <span class="status-text text-{{ $color }}">{{ $status }}</span>
                    </div>
                    @if($show_label)
                        <span class="progress-text">{{ $progress }}%</span>
                    @endif
                </div>
                <div class="progress" style="height: 8px;">
                    <div class="progress-bar bg-{{ $color }}"
                         role="progressbar"
                         style="width: {{ $progress }}%"
                         aria-valuenow="{{ $progress }}"
                         aria-valuemin="0"
                         aria-valuemax="100">
                    </div>
                </div>
                @if($total_items && $completed_items !== null)
                    <div class="items-info small text-muted mt-2">
                        {{ $completed_items }}/{{ $total_items }} items completed
                    </div>
                @endif
            </div>
            @break

        @default
            <div class="standard-progress">
                <div class="d-flex justify-content-between align-items-center mb-1">
                    @if($show_icon)
                        <div class="d-flex align-items-center">
                            <i class="fas {{ $getStatusIcon() }} text-{{ $color }} me-2"></i>
                            <span class="status-text">{{ $status }}</span>
                        </div>
                    @endif
                    @if($show_label)
                        <span class="progress-text">{{ $progress }}%</span>
                    @endif
                </div>
                <div class="progress" style="height: 6px;">
                    <div class="progress-bar bg-{{ $color }}"
                         role="progressbar"
                         style="width: {{ $progress }}%"
                         aria-valuenow="{{ $progress }}"
                         aria-valuemin="0"
                         aria-valuemax="100">
                    </div>
                </div>
            </div>
    @endswitch
</div>

@push('styles')
<style>
    .progress-indicator {
        --progress-height: 6px;
        --icon-size: 1rem;
    }

    /* Size Variants */
    .progress-indicator.size-sm {
        --progress-height: 4px;
        --icon-size: 0.875rem;
        font-size: 0.875rem;
    }

    .progress-indicator.size-lg {
        --progress-height: 8px;
        --icon-size: 1.25rem;
        font-size: 1.125rem;
    }

    /* Progress Bar Styles */
    .progress-indicator .progress {
        background-color: var(--bs-gray-200);
        border-radius: calc(var(--progress-height) / 2);
    }

    .progress-indicator .progress-bar {
        transition: width 0.6s ease;
        border-radius: calc(var(--progress-height) / 2);
    }

    /* Circular Progress Styles */
    .progress-indicator .circular-chart {
        width: 100px;
        height: 100px;
    }

    .progress-indicator.size-sm .circular-chart {
        width: 80px;
        height: 80px;
    }

    .progress-indicator.size-lg .circular-chart {
        width: 120px;
        height: 120px;
    }

    .progress-indicator .circle-bg {
        fill: none;
        stroke: var(--bs-gray-200);
        stroke-width: 2.8;
    }

    .progress-indicator .circle {
        fill: none;
        stroke-width: 2.8;
        stroke-linecap: round;
        animation: progress 1s ease-out forwards;
    }

    .progress-indicator .percentage {
        fill: var(--bs-gray-700);
        font-size: 0.5em;
        text-anchor: middle;
        font-weight: bold;
    }

    /* Animation */
    @keyframes progress {
        0% {
            stroke-dasharray: 0 100;
        }
    }

    .progress-indicator.animate .progress-bar {
        animation: progressAnimation 1s ease-in-out;
    }

    @keyframes progressAnimation {
        0% {
            width: 0;
        }
    }

    /* Status Icons */
    .progress-indicator i {
        font-size: var(--icon-size);
    }

    /* Detailed Variant Specific */
    .progress-indicator.variant-detailed .items-info {
        color: var(--bs-gray-600);
    }

    /* Minimal Variant Specific */
    .progress-indicator.variant-minimal {
        min-width: 100px;
    }
</style>
@endpush

{{-- Usage Examples:
<!-- Default Progress Indicator -->
<x-ui.progress-indicator
    :progress="65"
/>

<!-- Circular Progress Indicator -->
<x-ui.progress-indicator
    :progress="80"
    variant="circular"
    size="lg"
    color_scheme="success"
/>

<!-- Minimal Progress Indicator -->
<x-ui.progress-indicator
    :progress="30"
    variant="minimal"
    :show_label="true"
    :show_icon="true"
/>

<!-- Detailed Progress Indicator with Items -->
<x-ui.progress-indicator
    :progress="45"
    variant="detailed"
    :total_items="10"
    :completed_items="4"
    status_text="Module 2 in progress"
/>
--}}
