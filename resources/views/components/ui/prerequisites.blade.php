@props([
    'title' => 'Prerequisites',  // Section title
    'items' => [],             // Array of prerequisite items
    'user_status' => [],       // Array of user's completion status for each item
    'variant' => 'default',    // default, compact, detailed
    'layout' => 'vertical',    // vertical, horizontal
    'show_progress' => true,   // Whether to show overall progress
    'collapsible' => false,    // Whether section is collapsible
    'expanded' => true         // Initial expanded state if collapsible
])

@php
    $containerClasses = [
        'prerequisites-container',
        'prerequisites-' . $layout,
        $variant === 'compact' ? 'prerequisites-compact' : '',
        $attributes->get('class')
    ];

    $completedCount = count(array_filter($user_status, fn($status) => $status === 'completed'));
    $totalCount = count($items);
    $progressPercentage = $totalCount > 0 ? round(($completedCount / $totalCount) * 100) : 0;

    $sectionId = 'prerequisites-' . Str::random(8);
@endphp

<div class="{{ implode(' ', array_filter($containerClasses)) }}">
    <div class="card">
        <!-- Section Header -->
        <div class="card-header bg-transparent border-bottom-0 {{ $collapsible ? 'cursor-pointer' : '' }}"
             @if($collapsible)
             data-bs-toggle="collapse"
             data-bs-target="#{{ $sectionId }}"
             aria-expanded="{{ $expanded ? 'true' : 'false' }}"
             @endif>
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">{{ $title }}</h5>

                @if($show_progress)
                    <div class="prerequisites-progress d-flex align-items-center">
                        <div class="progress flex-grow-1 me-2" style="width: 100px; height: 6px;">
                            <div class="progress-bar {{ $progressPercentage === 100 ? 'bg-success' : '' }}"
                                 role="progressbar"
                                 style="width: {{ $progressPercentage }}%"
                                 aria-valuenow="{{ $progressPercentage }}"
                                 aria-valuemin="0"
                                 aria-valuemax="100">
                            </div>
                        </div>
                        <span class="small text-muted">{{ $progressPercentage }}%</span>
                    </div>
                @endif

                @if($collapsible)
                    <i class="fas fa-chevron-down toggle-icon"></i>
                @endif
            </div>
        </div>

        <!-- Prerequisites List -->
        <div id="{{ $sectionId }}"
             class="{{ $collapsible ? 'collapse' : '' }} {{ $expanded ? 'show' : '' }}">
            <div class="card-body">
                <div class="prerequisites-list {{ $layout === 'horizontal' ? 'row' : '' }}">
                    @foreach($items as $index => $item)
                        <div class="prerequisite-item {{ $layout === 'horizontal' ? 'col-md-6 col-lg-4' : '' }}
                                    {{ !$loop->last ? 'mb-3' : '' }}">
                            <div class="d-flex align-items-start">
                                <!-- Status Icon -->
                                <div class="status-icon me-3">
                                    @php
                                        $status = $user_status[$index] ?? 'pending';
                                        $statusIcon = match($status) {
                                            'completed' => 'fa-check-circle text-success',
                                            'in_progress' => 'fa-clock text-warning',
                                            'locked' => 'fa-lock text-secondary',
                                            default => 'fa-circle text-muted'
                                        };
                                    @endphp
                                    <i class="fas {{ $statusIcon }} fa-lg"></i>
                                </div>

                                <!-- Item Content -->
                                <div class="item-content flex-grow-1">
                                    <h6 class="item-title mb-1">
                                        {{ is_array($item) ? $item['title'] : $item }}
                                    </h6>

                                    @if(is_array($item) && isset($item['description']) && $variant !== 'compact')
                                        <p class="item-description text-muted small mb-2">
                                            {{ $item['description'] }}
                                        </p>
                                    @endif

                                    @if($variant === 'detailed' && is_array($item))
                                        <div class="item-details small">
                                            @if(isset($item['duration']))
                                                <span class="me-3">
                                                    <i class="fas fa-clock text-muted me-1"></i>
                                                    {{ $item['duration'] }}
                                                </span>
                                            @endif

                                            @if(isset($item['difficulty']))
                                                <span class="me-3">
                                                    <i class="fas fa-signal text-muted me-1"></i>
                                                    {{ $item['difficulty'] }}
                                                </span>
                                            @endif

                                            @if(isset($item['type']))
                                                <span>
                                                    <i class="fas fa-graduation-cap text-muted me-1"></i>
                                                    {{ $item['type'] }}
                                                </span>
                                            @endif
                                        </div>
                                    @endif

                                    @if(is_array($item) && isset($item['link']) && $status !== 'locked')
                                        <div class="item-action mt-2">
                                            <a href="{{ $item['link'] }}"
                                               class="btn btn-sm {{ $status === 'completed' ? 'btn-outline-success' : 'btn-primary' }}">
                                                @if($status === 'completed')
                                                    <i class="fas fa-redo me-1"></i> Review Again
                                                @else
                                                    <i class="fas fa-arrow-right me-1"></i> Start Now
                                                @endif
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .prerequisites-container {
        margin-bottom: 1.5rem;
    }

    .prerequisites-horizontal .prerequisites-list {
        margin: -0.5rem;
    }

    .prerequisites-horizontal .prerequisite-item {
        padding: 0.5rem;
    }

    .status-icon {
        width: 24px;
        text-align: center;
    }

    .cursor-pointer {
        cursor: pointer;
    }

    .cursor-pointer:hover {
        background-color: var(--bs-light);
    }

    .toggle-icon {
        transition: transform 0.2s ease;
    }

    .collapsed .toggle-icon {
        transform: rotate(-90deg);
    }

    .prerequisites-progress .progress {
        background-color: var(--bs-gray-200);
    }

    .prerequisites-compact .item-title {
        font-size: 0.9rem;
    }

    .prerequisites-compact .status-icon {
        width: 20px;
    }

    .prerequisites-compact .status-icon i {
        font-size: 1rem;
    }
</style>
@endpush

{{-- Usage Examples:
<!-- Default Prerequisites List -->
<x-ui.prerequisites
    title="Course Prerequisites"
    :items="[
        ['title' => 'HTML Basics', 'description' => 'Understanding of HTML structure and elements'],
        ['title' => 'CSS Fundamentals', 'description' => 'Knowledge of CSS styling and selectors'],
        ['title' => 'JavaScript Basics', 'description' => 'Basic programming concepts in JavaScript']
    ]"
    :user_status="['completed', 'in_progress', 'pending']"
/>

<!-- Detailed Prerequisites with Links -->
<x-ui.prerequisites
    title="Required Skills"
    variant="detailed"
    layout="horizontal"
    :items="[
        [
            'title' => 'Python Programming',
            'description' => 'Basic Python syntax and data structures',
            'duration' => '2 hours',
            'difficulty' => 'Beginner',
            'type' => 'Course',
            'link' => '/courses/python-basics'
        ],
        [
            'title' => 'Data Structures',
            'description' => 'Understanding of basic data structures',
            'duration' => '3 hours',
            'difficulty' => 'Intermediate',
            'type' => 'Course',
            'link' => '/courses/data-structures'
        ],
        [
            'title' => 'Algorithms',
            'description' => 'Basic algorithmic concepts',
            'duration' => '4 hours',
            'difficulty' => 'Advanced',
            'type' => 'Course',
            'link' => '/courses/algorithms'
        ]
    ]"
    :user_status="['completed', 'in_progress', 'locked']"
    :collapsible="true"
/>

<!-- Compact Prerequisites List -->
<x-ui.prerequisites
    title="Quick Prerequisites Check"
    variant="compact"
    :items="[
        'Git Version Control',
        'Command Line Basics',
        'Text Editor Proficiency'
    ]"
    :user_status="['completed', 'completed', 'pending']"
    :show_progress="false"
/>
--}}
