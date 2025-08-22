@props([
    'type' => 'learn',      // learn, requirements, includes, description
    'items' => [],          // Array of items/points
    'description' => '',     // Course description text
    'expandable' => true,    // Allow expand/collapse
    'expanded' => false,     // Initially expanded
    'maxHeight' => 300,      // Max height before collapse
    'layout' => 'default',   // default, compact
    'columns' => 1          // Number of columns (1 or 2)
])

@php
    $icons = [
        'learn' => 'fas fa-check-circle text-success',
        'requirements' => 'fas fa-info-circle text-info',
        'includes' => 'fas fa-box-open text-primary'
    ];

    $titles = [
        'learn' => 'What you\'ll learn',
        'requirements' => 'Requirements',
        'includes' => 'Course includes',
        'description' => 'Course description'
    ];

    $containerClasses = [
        'course-info',
        $layout === 'compact' ? 'course-info-compact' : '',
        $type === 'description' ? 'course-description' : '',
        $attributes->get('class')
    ];

    $contentClasses = [
        'course-info-content',
        $expandable ? 'expandable' : '',
        $expanded ? 'expanded' : ''
    ];
@endphp

<div class="{{ implode(' ', array_filter($containerClasses)) }}">
    <h5 class="mb-3">{{ $titles[$type] }}</h5>

    <div class="{{ implode(' ', array_filter($contentClasses)) }}"
         style="{{ $expandable && !$expanded ? '--max-height: ' . $maxHeight . 'px' : '' }}">
        @if($type === 'description')
            <div class="course-description-content">
                {!! $description !!}
            </div>
        @else
            <div class="row {{ $columns === 2 ? 'row-cols-1 row-cols-sm-2' : '' }} g-4">
                @foreach($items as $item)
                    <div class="col">
                        <div class="d-flex">
                            <div class="flex-shrink-0">
                                <i class="{{ $icons[$type] }} mt-1"></i>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                {{ $item }}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    @if($expandable)
        <button class="expand-button btn btn-link w-100 text-body p-0 mt-2"
                type="button"
                data-expanded="{{ $expanded ? 'true' : 'false' }}">
            <span class="expand-text">Show more</span>
            <span class="collapse-text">Show less</span>
            <i class="fas fa-chevron-down ms-2"></i>
        </button>
    @endif
</div>

@push('styles')
<style>
    .course-info-content.expandable {
        position: relative;
        overflow: hidden;
        transition: max-height 0.3s ease-in-out;
    }

    .course-info-content.expandable:not(.expanded) {
        max-height: var(--max-height);
    }

    .course-info-content.expandable:not(.expanded)::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 60px;
        background: linear-gradient(to bottom, transparent, var(--bs-body-bg));
        pointer-events: none;
    }

    .course-info .expand-button {
        text-decoration: none;
    }

    .course-info .expand-button:hover {
        color: var(--bs-primary) !important;
    }

    .course-info .expand-button i {
        transition: transform 0.3s ease;
    }

    .course-info .expand-button[data-expanded="true"] i {
        transform: rotate(180deg);
    }

    .course-info .expand-button .collapse-text,
    .course-info .expand-button[data-expanded="true"] .expand-text {
        display: none;
    }

    .course-info .expand-button[data-expanded="true"] .collapse-text {
        display: inline;
    }

    .course-info-compact .course-info-content {
        font-size: 0.875rem;
    }

    .course-info-compact i {
        font-size: 0.875rem;
    }

    .course-description-content {
        line-height: 1.7;
    }

    .course-description-content p:last-child {
        margin-bottom: 0;
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.course-info .expand-button').forEach(button => {
            button.addEventListener('click', function() {
                const content = this.previousElementSibling;
                const isExpanded = this.getAttribute('data-expanded') === 'true';

                if (isExpanded) {
                    content.style.maxHeight = content.scrollHeight + 'px';
                    requestAnimationFrame(() => {
                        content.style.maxHeight = var(--max-height) + 'px';
                        content.classList.remove('expanded');
                    });
                } else {
                    content.style.maxHeight = content.scrollHeight + 'px';
                    content.classList.add('expanded');
                }

                this.setAttribute('data-expanded', !isExpanded);
            });
        });
    });
</script>
@endpush

{{-- Usage Example:
<!-- What You'll Learn Section -->
<x-ui.course-info
    type="learn"
    :items="[
        'Build responsive websites using HTML5, CSS3, and Bootstrap 5',
        'Create interactive web applications with JavaScript and jQuery',
        'Understand modern web development principles and best practices',
        'Deploy websites to production environments'
    ]"
    :columns="2"
/>

<!-- Course Requirements Section -->
<x-ui.course-info
    type="requirements"
    :items="[
        'Basic understanding of HTML and CSS',
        'A computer with internet access',
        'Text editor (VS Code recommended)',
        'No prior programming experience required'
    ]"
/>

<!-- Course Includes Section -->
<x-ui.course-info
    type="includes"
    :items="[
        '10 hours of video content',
        'Downloadable resources',
        'Access on mobile and desktop',
        'Certificate of completion'
    ]"
    layout="compact"
/>

<!-- Course Description Section -->
<x-ui.course-info
    type="description"
    description="<p>This comprehensive course will take you from beginner to advanced level in web development. You'll learn everything from basic HTML to modern JavaScript frameworks.</p><p>Through hands-on projects and real-world examples, you'll gain practical experience that you can immediately apply to your own projects.</p>"
    :expandable="true"
    :maxHeight="200"
/>
--}}
