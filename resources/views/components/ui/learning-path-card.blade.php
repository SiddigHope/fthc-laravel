@props([
    'title' => '',           // Learning path title
    'description' => '',     // Learning path description
    'courses' => [],         // Array of courses in the path
    'duration' => '',        // Total duration of the path
    'level' => '',          // Difficulty level
    'progress' => null,      // Overall progress percentage
    'image' => null,        // Path cover image
    'instructor' => null,    // Path instructor details
    'skills' => [],         // Skills to be learned
    'certificate' => false,  // Whether path offers certificate
    'enrolled' => false,    // Whether user is enrolled
    'variant' => 'default', // default, compact, detailed
    'layout' => 'vertical'  // vertical, horizontal
])

@php
    $cardClasses = [
        'card learning-path-card h-100',
        $layout === 'horizontal' ? 'card-horizontal' : '',
        $variant === 'compact' ? 'card-compact' : '',
        $enrolled ? 'path-enrolled' : '',
        $attributes->get('class')
    ];

    $imageClasses = [
        'path-image card-img-top',
        $layout === 'horizontal' ? 'card-img-start' : ''
    ];

    $levelColors = [
        'Beginner' => 'success',
        'Intermediate' => 'warning',
        'Advanced' => 'danger',
    ];

    $levelColor = $levelColors[$level] ?? 'primary';
@endphp

<div class="{{ implode(' ', array_filter($cardClasses)) }}">
    @if($image)
        <div class="position-relative">
            <img src="{{ asset($image) }}"
                 class="{{ implode(' ', $imageClasses) }}"
                 alt="{{ $title }}">
            @if($certificate)
                <div class="certificate-badge">
                    <i class="fas fa-certificate text-warning"
                       data-bs-toggle="tooltip"
                       title="Certificate upon completion"></i>
                </div>
            @endif
        </div>
    @endif

    <div class="card-body">
        <div class="path-header mb-3">
            @if($level)
                <div class="path-level badge bg-{{ $levelColor }}-soft text-{{ $levelColor }} mb-2">
                    {{ $level }}
                </div>
            @endif

            <h5 class="path-title card-title mb-1">{{ $title }}</h5>

            @if($description && $variant !== 'compact')
                <p class="path-description card-text text-muted">
                    {{ $description }}
                </p>
            @endif
        </div>

        @if($variant === 'detailed')
            <!-- Skills Section -->
            @if(count($skills) > 0)
                <div class="path-skills mb-3">
                    <h6 class="fw-bold small mb-2">Skills you'll gain:</h6>
                    <div class="d-flex flex-wrap gap-1">
                        @foreach($skills as $skill)
                            <span class="badge bg-light text-dark">{{ $skill }}</span>
                        @endforeach
                    </div>
                </div>
            @endif
        @endif

        <!-- Course List -->
        @if(count($courses) > 0 && $variant !== 'compact')
            <div class="path-courses mb-3">
                <h6 class="fw-bold small mb-2">Included Courses:</h6>
                <div class="list-group list-group-flush">
                    @foreach($courses as $index => $course)
                        @if($index < 3)
                            <div class="list-group-item border-0 px-0 py-1">
                                <div class="d-flex align-items-center">
                                    <div class="course-index me-2">
                                        {{ $index + 1 }}
                                    </div>
                                    <div class="course-info flex-grow-1">
                                        <h6 class="course-title mb-0 small">{{ $course['title'] }}</h6>
                                        @if($enrolled && isset($course['progress']))
                                            <div class="progress mt-1" style="height: 4px;">
                                                <div class="progress-bar"
                                                     role="progressbar"
                                                     style="width: {{ $course['progress'] }}%"
                                                     aria-valuenow="{{ $course['progress'] }}"
                                                     aria-valuemin="0"
                                                     aria-valuemax="100">
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                    @if(isset($course['duration']))
                                        <div class="course-duration small text-muted">
                                            {{ $course['duration'] }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endif
                    @endforeach
                    @if(count($courses) > 3)
                        <div class="list-group-item border-0 px-0 py-1 text-center">
                            <small class="text-muted">+{{ count($courses) - 3 }} more courses</small>
                        </div>
                    @endif
                </div>
            </div>
        @endif

        <!-- Path Footer -->
        <div class="path-footer">
            <div class="d-flex align-items-center justify-content-between">
                <div class="path-stats small">
                    @if($duration)
                        <span class="me-3">
                            <i class="fas fa-clock text-muted me-1"></i>
                            {{ $duration }}
                        </span>
                    @endif
                    <span>
                        <i class="fas fa-book-open text-muted me-1"></i>
                        {{ count($courses) }} {{ Str::plural('course', count($courses)) }}
                    </span>
                </div>

                @if($enrolled && $progress !== null)
                    <div class="path-progress small text-muted">
                        {{ $progress }}% complete
                    </div>
                @endif
            </div>

            @if($instructor && $variant === 'detailed')
                <div class="path-instructor mt-3 pt-3 border-top">
                    <div class="d-flex align-items-center">
                        @if(isset($instructor['avatar']))
                            <img src="{{ asset($instructor['avatar']) }}"
                                 class="rounded-circle me-2"
                                 width="32"
                                 alt="{{ $instructor['name'] }}">
                        @endif
                        <div>
                            <h6 class="mb-0 small">{{ $instructor['name'] }}</h6>
                            @if(isset($instructor['title']))
                                <small class="text-muted">{{ $instructor['title'] }}</small>
                            @endif
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

@push('styles')
<style>
    .learning-path-card {
        transition: all 0.3s ease;
    }

    .learning-path-card:hover {
        transform: translateY(-5px);
    }

    .learning-path-card .path-image {
        height: 200px;
        object-fit: cover;
    }

    .learning-path-card.card-horizontal {
        flex-direction: row;
    }

    .learning-path-card.card-horizontal .path-image {
        width: 200px;
        height: 100%;
    }

    .learning-path-card.card-compact .path-image {
        height: 150px;
    }

    .certificate-badge {
        position: absolute;
        top: 10px;
        right: 10px;
        background: rgba(255, 255, 255, 0.9);
        padding: 5px;
        border-radius: 50%;
    }

    .course-index {
        width: 24px;
        height: 24px;
        background-color: var(--bs-light);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 12px;
        color: var(--bs-gray-600);
    }

    .path-enrolled .course-index {
        background-color: var(--bs-primary-soft);
        color: var(--bs-primary);
    }
</style>
@endpush

{{-- Usage Examples:
<!-- Default Learning Path Card -->
<x-ui.learning-path-card
    title="Web Development Fundamentals"
    description="Master the basics of web development"
    image="images/paths/web-dev.jpg"
    level="Beginner"
    duration="3 months"
    :certificate="true"
    :courses="[
        ['title' => 'HTML & CSS Basics', 'duration' => '2h 30m'],
        ['title' => 'JavaScript Fundamentals', 'duration' => '4h'],
        ['title' => 'Responsive Web Design', 'duration' => '3h']
    ]"
/>

<!-- Detailed Learning Path Card with Progress -->
<x-ui.learning-path-card
    title="Full Stack Development"
    description="Become a full stack developer"
    image="images/paths/full-stack.jpg"
    level="Intermediate"
    duration="6 months"
    :progress="45"
    :enrolled="true"
    variant="detailed"
    :skills="['HTML', 'CSS', 'JavaScript', 'React', 'Node.js', 'MongoDB']"
    :instructor="[
        'name' => 'John Doe',
        'title' => 'Senior Developer',
        'avatar' => 'images/instructors/john.jpg'
    ]"
    :courses="[
        ['title' => 'Frontend Development', 'duration' => '8h', 'progress' => 100],
        ['title' => 'Backend Development', 'duration' => '10h', 'progress' => 60],
        ['title' => 'Database Management', 'duration' => '6h', 'progress' => 0]
    ]"
/>

<!-- Compact Horizontal Learning Path Card -->
<x-ui.learning-path-card
    title="Mobile App Development"
    image="images/paths/mobile-dev.jpg"
    level="Advanced"
    duration="4 months"
    variant="compact"
    layout="horizontal"
    :courses="[
        ['title' => 'iOS Development'],
        ['title' => 'Android Development'],
        ['title' => 'Cross-platform Development']
    ]"
/>
--}}
