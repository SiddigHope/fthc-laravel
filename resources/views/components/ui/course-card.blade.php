@props([
    'course',           // Course model/array with required attributes
    'hover' => true,    // Hover effect
    'horizontal' => false, // Horizontal layout
    'showRating' => true,
    'showPrice' => true,
    'showInstructor' => true,
    'showStats' => true
])

@php
    $cardClasses = [
        'card',
        'h-100',
        $hover ? 'card-hover' : '',
        $horizontal ? 'card-horizontal' : '',
        $attributes->get('class')
    ];
@endphp

<div class="{{ implode(' ', array_filter($cardClasses)) }}">
    <!-- Image -->
    <div class="position-relative">
        <img class="card-img-top" src="{{ $course['image'] ?? asset('assets/images/courses/default.jpg') }}" alt="{{ $course['title'] }}">
        <!-- Overlay buttons -->
        <div class="card-img-overlay d-flex align-items-start flex-column p-3">
            <!-- Card overlay Top -->
            <div class="w-100 mb-auto d-flex justify-content-end">
                <x-ui.badge type="danger" class="ms-2" pill>
                    <i class="fas fa-heart"></i>
                </x-ui.badge>
            </div>
            <!-- Card overlay bottom -->
            <div class="w-100 mt-auto">
                @if(isset($course['level']))
                    <x-ui.badge type="info" soft pill>
                        {{ $course['level'] }}
                    </x-ui.badge>
                @endif
            </div>
        </div>
    </div>

    <!-- Card body -->
    <div class="card-body pb-0">
        <!-- Title -->
        <h5 class="card-title fw-normal">
            <a href="{{ route('courses.show', $course['slug']) }}" class="text-decoration-none text-dark">
                {{ $course['title'] }}
            </a>
        </h5>

        <!-- Rating and Price -->
        <div class="d-flex justify-content-between mb-2">
            @if($showRating && isset($course['rating']))
                <div class="rating-star">
                    <span class="text-warning">
                        @for($i = 1; $i <= 5; $i++)
                            <i class="fas fa-star{{ $i <= $course['rating'] ? '' : '-half-alt' }}"></i>
                        @endfor
                    </span>
                    <span class="text-muted ms-2">({{ $course['reviews_count'] ?? 0 }})</span>
                </div>
            @endif

            @if($showPrice)
                <div class="price text-end">
                    @if(isset($course['original_price']) && $course['original_price'] > $course['price'])
                        <span class="text-decoration-line-through text-muted me-2">
                            ${{ number_format($course['original_price'], 2) }}
                        </span>
                    @endif
                    <span class="text-success">${{ number_format($course['price'] ?? 0, 2) }}</span>
                </div>
            @endif
        </div>

        <!-- Instructor info -->
        @if($showInstructor && isset($course['instructor']))
            <div class="d-flex align-items-center mb-3">
                <div class="avatar avatar-sm">
                    <img class="avatar-img rounded-circle"
                         src="{{ $course['instructor']['avatar'] ?? asset('assets/images/avatar/default.jpg') }}"
                         alt="{{ $course['instructor']['name'] }}">
                </div>
                <div class="ms-2">
                    <h6 class="mb-0"><a href="#" class="text-decoration-none">{{ $course['instructor']['name'] }}</a></h6>
                </div>
            </div>
        @endif
    </div>

    <!-- Card footer -->
    @if($showStats)
        <div class="card-footer pt-0 pb-3">
            <hr>
            <div class="d-flex justify-content-between">
                <span class="h6 fw-light mb-0">
                    <i class="far fa-clock text-danger me-2"></i>
                    {{ $course['duration'] ?? '0h 0m' }}
                </span>
                <span class="h6 fw-light mb-0">
                    <i class="fas fa-table text-orange me-2"></i>
                    {{ $course['lessons_count'] ?? 0 }} lessons
                </span>
                <span class="h6 fw-light mb-0">
                    <i class="fas fa-signal text-success me-2"></i>
                    {{ $course['level'] ?? 'All levels' }}
                </span>
            </div>
        </div>
    @endif
</div>

{{-- Usage Example:
@php
    $course = [
        'title' => 'The Complete Web Development Course',
        'slug' => 'complete-web-development',
        'image' => 'path/to/image.jpg',
        'price' => 99.99,
        'original_price' => 199.99,
        'rating' => 4.5,
        'reviews_count' => 2350,
        'duration' => '12h 30m',
        'lessons_count' => 150,
        'level' => 'Intermediate',
        'instructor' => [
            'name' => 'John Doe',
            'avatar' => 'path/to/avatar.jpg'
        ]
    ];
@endphp

<x-ui.course-card :course="$course" />
--}}
