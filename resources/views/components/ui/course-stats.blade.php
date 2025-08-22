@props([
    'students' => 0,         // Number of enrolled students
    'rating' => 0,          // Course rating
    'reviews' => 0,         // Number of reviews
    'lectures' => 0,        // Number of lectures
    'duration' => 0,        // Course duration in minutes
    'level' => null,        // Course level (Beginner, Intermediate, Advanced)
    'layout' => 'default',  // default, compact, detailed
    'showLabels' => true,   // Show stat labels
    'variant' => 'icon',    // icon, text, icon-text
    'size' => 'md',         // sm, md, lg
    'iconColor' => 'primary' // Icon color variant
])

@php
    $sizes = [
        'sm' => 'small',
        'md' => '',
        'lg' => 'fs-5'
    ];

    $icons = [
        'students' => 'fas fa-user-graduate',
        'rating' => 'fas fa-star',
        'reviews' => 'fas fa-comment-dots',
        'lectures' => 'fas fa-play-circle',
        'duration' => 'fas fa-clock',
        'level' => 'fas fa-signal'
    ];

    $labels = [
        'students' => 'Students',
        'rating' => 'Rating',
        'reviews' => 'Reviews',
        'lectures' => 'Lectures',
        'duration' => 'Duration',
        'level' => 'Level'
    ];

    $formatDuration = function($minutes) {
        $hours = floor($minutes / 60);
        $mins = $minutes % 60;
        if ($hours > 0) {
            return $hours . 'h ' . ($mins > 0 ? $mins . 'm' : '');
        }
        return $mins . 'm';
    };
@endphp

<div class="course-stats {{ $layout === 'compact' ? 'course-stats-compact' : '' }} {{ $attributes->get('class') }}">
    @if($layout === 'detailed')
        <div class="row g-4">
    @endif

    @if($students > 0)
        <div class="{{ $layout === 'detailed' ? 'col-sm-6 col-lg-4' : '' }} course-stat-item">
            <div class="d-flex align-items-center {{ $sizes[$size] }}">
                @if($variant !== 'text')
                    <i class="{{ $icons['students'] }} text-{{ $iconColor }} me-2"></i>
                @endif
                <span class="course-stat-value">{{ number_format($students) }}</span>
                @if($showLabels)
                    <span class="course-stat-label text-muted ms-1">{{ $labels['students'] }}</span>
                @endif
            </div>
        </div>
    @endif

    @if($rating > 0)
        <div class="{{ $layout === 'detailed' ? 'col-sm-6 col-lg-4' : '' }} course-stat-item">
            <div class="d-flex align-items-center {{ $sizes[$size] }}">
                @if($variant !== 'text')
                    <i class="{{ $icons['rating'] }} text-warning me-2"></i>
                @endif
                <span class="course-stat-value">{{ number_format($rating, 1) }}</span>
                @if($showLabels)
                    <span class="course-stat-label text-muted ms-1">
                        {{ $labels['rating'] }}
                        @if($reviews > 0)
                            ({{ number_format($reviews) }})
                        @endif
                    </span>
                @endif
            </div>
        </div>
    @endif

    @if($lectures > 0)
        <div class="{{ $layout === 'detailed' ? 'col-sm-6 col-lg-4' : '' }} course-stat-item">
            <div class="d-flex align-items-center {{ $sizes[$size] }}">
                @if($variant !== 'text')
                    <i class="{{ $icons['lectures'] }} text-{{ $iconColor }} me-2"></i>
                @endif
                <span class="course-stat-value">{{ number_format($lectures) }}</span>
                @if($showLabels)
                    <span class="course-stat-label text-muted ms-1">{{ $labels['lectures'] }}</span>
                @endif
            </div>
        </div>
    @endif

    @if($duration > 0)
        <div class="{{ $layout === 'detailed' ? 'col-sm-6 col-lg-4' : '' }} course-stat-item">
            <div class="d-flex align-items-center {{ $sizes[$size] }}">
                @if($variant !== 'text')
                    <i class="{{ $icons['duration'] }} text-{{ $iconColor }} me-2"></i>
                @endif
                <span class="course-stat-value">{{ $formatDuration($duration) }}</span>
                @if($showLabels)
                    <span class="course-stat-label text-muted ms-1">{{ $labels['duration'] }}</span>
                @endif
            </div>
        </div>
    @endif

    @if($level)
        <div class="{{ $layout === 'detailed' ? 'col-sm-6 col-lg-4' : '' }} course-stat-item">
            <div class="d-flex align-items-center {{ $sizes[$size] }}">
                @if($variant !== 'text')
                    <i class="{{ $icons['level'] }} text-{{ $iconColor }} me-2"></i>
                @endif
                <span class="course-stat-value">{{ $level }}</span>
                @if($showLabels)
                    <span class="course-stat-label text-muted ms-1">{{ $labels['level'] }}</span>
                @endif
            </div>
        </div>
    @endif

    @if($layout === 'detailed')
        </div>
    @endif
</div>

@push('styles')
<style>
    .course-stats:not(.course-stats-compact) .course-stat-item:not(:last-child) {
        margin-right: 1.5rem;
    }

    .course-stats-compact .course-stat-item:not(:last-child) {
        margin-right: 1rem;
    }

    .course-stats:not(.row) {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
    }

    .course-stat-value {
        font-weight: 500;
    }

    .course-stat-label {
        font-size: 0.875em;
    }

    /* Size Variants */
    .course-stats .small .course-stat-label {
        font-size: 0.75em;
    }

    .course-stats .fs-5 .course-stat-label {
        font-size: 1em;
    }
</style>
@endpush

{{-- Usage Example:
<!-- Default Course Stats -->
<x-ui.course-stats
    :students="1234"
    :rating="4.5"
    :reviews="100"
    :lectures="24"
    :duration="360"
    level="Intermediate"
/>

<!-- Compact Course Stats without Labels -->
<x-ui.course-stats
    :students="1234"
    :rating="4.5"
    :duration="360"
    layout="compact"
    :showLabels="false"
    size="sm"
/>

<!-- Detailed Course Stats with Custom Icon Color -->
<x-ui.course-stats
    :students="1234"
    :rating="4.5"
    :reviews="100"
    :lectures="24"
    :duration="360"
    level="Advanced"
    layout="detailed"
    iconColor="info"
    variant="icon-text"
    size="lg"
/>
--}}
