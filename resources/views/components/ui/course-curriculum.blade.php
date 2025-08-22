@props([
    'sections' => [],        // Array of course sections
    'progress' => null,      // Student's progress data
    'preview' => false,      // Allow preview of some lectures
    'enrolled' => false,     // Whether user is enrolled
    'layout' => 'default',   // default, compact
    'expandAll' => false,    // Show all sections expanded
    'showDuration' => true,  // Show lecture durations
    'showProgress' => true   // Show progress indicators
])

@php
    $totalLectures = 0;
    $totalDuration = 0;
    $completedLectures = 0;

    foreach ($sections as $section) {
        $totalLectures += count($section['lectures'] ?? []);
        foreach ($section['lectures'] ?? [] as $lecture) {
            $totalDuration += $lecture['duration'] ?? 0;
            if (isset($progress['completed_lectures']) && in_array($lecture['id'], $progress['completed_lectures'])) {
                $completedLectures++;
            }
        }
    }

    $progressPercentage = $totalLectures > 0 ? ($completedLectures / $totalLectures) * 100 : 0;

    $formatDuration = function($minutes) {
        $hours = floor($minutes / 60);
        $mins = $minutes % 60;
        if ($hours > 0) {
            return $hours . 'h ' . ($mins > 0 ? $mins . 'm' : '');
        }
        return $mins . 'm';
    };
@endphp

<div class="course-curriculum {{ $layout }} {{ $attributes->get('class') }}">
    @if($showProgress && $enrolled && $progress)
        <div class="course-progress card card-body mb-4">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <h6 class="mb-0">Your Progress</h6>
                <span class="text-primary">{{ number_format($progressPercentage, 0) }}% Complete</span>
            </div>
            <div class="progress bg-primary-soft" style="height: 8px;">
                <div class="progress-bar bg-primary"
                     role="progressbar"
                     style="width: {{ $progressPercentage }}%"
                     aria-valuenow="{{ $progressPercentage }}"
                     aria-valuemin="0"
                     aria-valuemax="100"></div>
            </div>
            <div class="d-flex justify-content-between align-items-center mt-2 small text-muted">
                <span>{{ $completedLectures }}/{{ $totalLectures }} Lectures</span>
                <span>{{ $formatDuration($totalDuration) }} Total Length</span>
            </div>
        </div>
    @endif

    <div class="accordion" id="courseCurriculum">
        @foreach($sections as $sectionIndex => $section)
            <div class="accordion-item">
                <h2 class="accordion-header" id="section{{ $sectionIndex }}">
                    <button class="accordion-button {{ !$expandAll && $sectionIndex !== 0 ? 'collapsed' : '' }}"
                            type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#sectionContent{{ $sectionIndex }}"
                            aria-expanded="{{ $expandAll || $sectionIndex === 0 ? 'true' : 'false' }}"
                            aria-controls="sectionContent{{ $sectionIndex }}">
                        <div class="d-flex justify-content-between align-items-center w-100">
                            <div>
                                <h6 class="mb-0">{{ $section['title'] }}</h6>
                                <p class="mb-0 small text-muted">
                                    {{ count($section['lectures'] ?? []) }} lectures
                                    @if($showDuration && isset($section['duration']))
                                        • {{ $formatDuration($section['duration']) }}
                                    @endif
                                </p>
                            </div>
                            @if($showProgress && $enrolled && $progress)
                                @php
                                    $sectionCompletedLectures = 0;
                                    foreach ($section['lectures'] ?? [] as $lecture) {
                                        if (isset($progress['completed_lectures']) && in_array($lecture['id'], $progress['completed_lectures'])) {
                                            $sectionCompletedLectures++;
                                        }
                                    }
                                    $sectionProgress = count($section['lectures'] ?? []) > 0
                                        ? ($sectionCompletedLectures / count($section['lectures'])) * 100
                                        : 0;
                                @endphp
                                <div class="d-flex align-items-center">
                                    <div class="progress bg-primary-soft me-2" style="width: 50px; height: 4px;">
                                        <div class="progress-bar bg-primary"
                                             style="width: {{ $sectionProgress }}%"
                                             role="progressbar"
                                             aria-valuenow="{{ $sectionProgress }}"
                                             aria-valuemin="0"
                                             aria-valuemax="100"></div>
                                    </div>
                                    <span class="small text-muted">{{ number_format($sectionProgress, 0) }}%</span>
                                </div>
                            @endif
                        </div>
                    </button>
                </h2>

                <div id="sectionContent{{ $sectionIndex }}"
                     class="accordion-collapse collapse {{ $expandAll || $sectionIndex === 0 ? 'show' : '' }}"
                     aria-labelledby="section{{ $sectionIndex }}">
                    <div class="accordion-body p-0">
                        <div class="list-group list-group-flush">
                            @foreach($section['lectures'] ?? [] as $lectureIndex => $lecture)
                                <div class="list-group-item list-group-item-action d-flex justify-content-between align-items-center py-3 {{ $layout === 'compact' ? 'px-3' : 'px-4' }}">
                                    <div class="d-flex align-items-center">
                                        @if($enrolled)
                                            <div class="form-check">
                                                <input type="checkbox"
                                                       class="form-check-input"
                                                       id="lecture{{ $lecture['id'] }}"
                                                       {{ isset($progress['completed_lectures']) && in_array($lecture['id'], $progress['completed_lectures']) ? 'checked' : '' }}
                                                       disabled>
                                            </div>
                                        @endif

                                        <div class="ms-{{ $enrolled ? 3 : 0 }}">
                                            <div class="d-flex align-items-center">
                                                @if($lecture['type'] === 'video')
                                                    <i class="fas fa-play-circle text-primary me-2"></i>
                                                @elseif($lecture['type'] === 'quiz')
                                                    <i class="fas fa-question-circle text-warning me-2"></i>
                                                @elseif($lecture['type'] === 'assignment')
                                                    <i class="fas fa-file-alt text-info me-2"></i>
                                                @endif

                                                @if($enrolled || ($preview && $lecture['preview']))
                                                    <a href="{{ $lecture['url'] }}" class="text-body">
                                                        {{ $lecture['title'] }}
                                                    </a>
                                                @else
                                                    <span>{{ $lecture['title'] }}</span>
                                                @endif

                                                @if($preview && $lecture['preview'])
                                                    <span class="badge bg-success-soft text-success ms-2">Preview</span>
                                                @endif
                                            </div>

                                            @if($layout !== 'compact' && !empty($lecture['description']))
                                                <p class="mb-0 small text-muted mt-1">{{ $lecture['description'] }}</p>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="d-flex align-items-center">
                                        @if($showDuration && isset($lecture['duration']))
                                            <span class="text-muted small">{{ $formatDuration($lecture['duration']) }}</span>
                                        @endif

                                        @if(!$enrolled && !($preview && $lecture['preview']))
                                            <i class="fas fa-lock text-muted ms-3"></i>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

@push('styles')
<style>
    .course-curriculum .accordion-button::after {
        margin-left: 1rem;
        order: 2;
    }

    .course-curriculum .list-group-item:hover {
        background-color: var(--bs-light);
    }

    .course-curriculum.compact .accordion-button {
        padding: 0.75rem 1rem;
    }

    .course-curriculum.compact .list-group-item {
        padding-top: 0.5rem;
        padding-bottom: 0.5rem;
    }
</style>
@endpush

{{-- Usage Example:
@php
    $courseSections = [
        [
            'title' => 'Getting Started',
            'duration' => 120,
            'lectures' => [
                [
                    'id' => 1,
                    'title' => 'Course Introduction',
                    'type' => 'video',
                    'duration' => 15,
                    'preview' => true,
                    'url' => '/course/lecture/1',
                    'description' => 'A brief introduction to the course content and objectives.'
                ],
                [
                    'id' => 2,
                    'title' => 'Setting Up Your Environment',
                    'type' => 'video',
                    'duration' => 25,
                    'preview' => false,
                    'url' => '/course/lecture/2'
                ]
            ]
        ],
        [
            'title' => 'Basic Concepts',
            'duration' => 180,
            'lectures' => [
                [
                    'id' => 3,
                    'title' => 'Understanding the Basics',
                    'type' => 'video',
                    'duration' => 30,
                    'preview' => false,
                    'url' => '/course/lecture/3'
                ],
                [
                    'id' => 4,
                    'title' => 'Chapter Quiz',
                    'type' => 'quiz',
                    'duration' => 20,
                    'preview' => false,
                    'url' => '/course/quiz/1'
                ]
            ]
        ]
    ];

    $progress = [
        'completed_lectures' => [1, 2]
    ];
@endphp

<!-- Default Course Curriculum -->
<x-ui.course-curriculum
    :sections="$courseSections"
    :preview="true"
/>

<!-- Course Curriculum with Progress -->
<x-ui.course-curriculum
    :sections="$courseSections"
    :progress="$progress"
    :enrolled="true"
    :expandAll="true"
/>

<!-- Compact Course Curriculum -->
<x-ui.course-curriculum
    :sections="$courseSections"
    layout="compact"
    :showDuration="false"
/>
--}}
