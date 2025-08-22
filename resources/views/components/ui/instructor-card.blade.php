@props([
    'name' => '',            // Instructor name
    'title' => '',           // Job title or specialization
    'avatar' => null,        // Avatar image URL
    'rating' => 0,           // Rating out of 5
    'reviews' => 0,          // Number of reviews
    'students' => 0,         // Number of students
    'courses' => 0,          // Number of courses
    'description' => '',     // Short bio or description
    'social' => [],          // Social media links array
    'layout' => 'default',   // default, compact, horizontal
    'href' => null,          // Profile link
    'featured' => false      // Featured instructor
])

@php
    $cardClasses = [
        'card instructor-card h-100',
        $layout === 'horizontal' ? 'card-horizontal-hover-shadow' : 'card-hover-shadow',
        $featured ? 'border-primary' : '',
        $attributes->get('class')
    ];

    $defaultSocial = [
        'website' => null,
        'facebook' => null,
        'twitter' => null,
        'linkedin' => null,
        'youtube' => null,
        'instagram' => null
    ];

    $social = array_merge($defaultSocial, $social);

    $socialIcons = [
        'website' => 'fas fa-globe',
        'facebook' => 'fab fa-facebook-f',
        'twitter' => 'fab fa-twitter',
        'linkedin' => 'fab fa-linkedin-in',
        'youtube' => 'fab fa-youtube',
        'instagram' => 'fab fa-instagram'
    ];
@endphp

<div class="{{ implode(' ', array_filter($cardClasses)) }}">
    @if($featured)
        <div class="card-header border-0 pb-0">
            <div class="ribbon ribbon-top-right">
                <span class="bg-primary">Featured</span>
            </div>
        </div>
    @endif

    <div class="card-body {{ $layout === 'horizontal' ? 'd-sm-flex' : '' }}">
        <!-- Avatar -->
        <div class="{{ $layout === 'horizontal' ? 'mb-0 me-4 text-center' : 'text-center mb-3' }}">
            @if($href)
                <a href="{{ $href }}" class="avatar-link">
            @endif
                @if($avatar)
                    <img src="{{ asset($avatar) }}"
                         class="avatar avatar-xxl {{ $layout === 'horizontal' ? '' : 'mb-2' }}"
                         alt="{{ $name }}">
                @else
                    <div class="avatar avatar-xxl bg-primary-soft text-primary {{ $layout === 'horizontal' ? '' : 'mb-2' }}">
                        {{ Str::upper(Str::substr($name, 0, 2)) }}
                    </div>
                @endif
            @if($href)
                </a>
            @endif

            @if($layout === 'compact')
                <h5 class="mb-1">
                    @if($href)
                        <a href="{{ $href }}" class="text-reset">
                    @endif
                        {{ $name }}
                    @if($href)
                        </a>
                    @endif
                </h5>
                @if($title)
                    <p class="mb-2 text-muted small">{{ $title }}</p>
                @endif
            @endif
        </div>

        <!-- Info -->
        <div class="{{ $layout === 'horizontal' ? 'flex-grow-1' : '' }}">
            @if($layout !== 'compact')
                <h5 class="mb-1">
                    @if($href)
                        <a href="{{ $href }}" class="text-reset">
                    @endif
                        {{ $name }}
                    @if($href)
                        </a>
                    @endif
                </h5>
                @if($title)
                    <p class="mb-2 text-muted">{{ $title }}</p>
                @endif
            @endif

            <!-- Stats -->
            <div class="d-flex align-items-center mb-3">
                @if($rating > 0)
                    <div class="me-3" data-bs-toggle="tooltip" data-bs-placement="top" title="Rating">
                        <i class="fas fa-star text-warning me-1"></i>
                        <span class="h6 fw-light mb-0">{{ number_format($rating, 1) }}</span>
                        @if($reviews > 0)
                            <span class="text-muted small">({{ number_format($reviews) }})</span>
                        @endif
                    </div>
                @endif

                @if($students > 0)
                    <div class="me-3" data-bs-toggle="tooltip" data-bs-placement="top" title="Students">
                        <i class="fas fa-user-graduate text-primary me-1"></i>
                        <span class="h6 fw-light mb-0">{{ number_format($students) }}</span>
                    </div>
                @endif

                @if($courses > 0)
                    <div data-bs-toggle="tooltip" data-bs-placement="top" title="Courses">
                        <i class="fas fa-play-circle text-primary me-1"></i>
                        <span class="h6 fw-light mb-0">{{ number_format($courses) }}</span>
                    </div>
                @endif
            </div>

            @if($description && $layout !== 'compact')
                <p class="mb-3">{{ Str::limit($description, 150) }}</p>
            @endif

            <!-- Social Links -->
            @if(array_filter($social))
                <ul class="list-inline mb-0">
                    @foreach($social as $platform => $url)
                        @if($url)
                            <li class="list-inline-item">
                                <a class="btn btn-sm btn-light px-2"
                                   href="{{ $url }}"
                                   target="_blank"
                                   rel="noopener noreferrer"
                                   data-bs-toggle="tooltip"
                                   data-bs-placement="top"
                                   title="{{ ucfirst($platform) }}">
                                    <i class="{{ $socialIcons[$platform] }}"></i>
                                </a>
                            </li>
                        @endif
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
</div>

@push('styles')
<style>
    .instructor-card .avatar-xxl {
        width: 120px;
        height: 120px;
        object-fit: cover;
    }

    .instructor-card.card-horizontal-hover-shadow {
        transition: transform 0.2s ease-in-out;
    }

    .instructor-card.card-horizontal-hover-shadow:hover {
        transform: translateY(-5px);
    }

    .instructor-card .ribbon {
        width: 150px;
        height: 150px;
        position: absolute;
        top: -10px;
        right: -10px;
        overflow: hidden;
    }

    .instructor-card .ribbon span {
        position: absolute;
        display: block;
        width: 225px;
        padding: 8px 0;
        background-color: var(--bs-primary);
        color: #fff;
        text-align: center;
        transform: rotate(45deg);
        right: -45px;
        top: 30px;
        text-transform: uppercase;
        font-size: 12px;
        font-weight: 700;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
</style>
@endpush

{{-- Usage Example:
<!-- Default Instructor Card -->
<x-ui.instructor-card
    name="John Doe"
    title="Web Development Instructor"
    avatar="path/to/avatar.jpg"
    :rating="4.8"
    :reviews="150"
    :students="1234"
    :courses="12"
    description="Experienced web developer with 10+ years of teaching experience."
    :social="[
        'website' => 'https://example.com',
        'linkedin' => 'https://linkedin.com/in/johndoe',
        'twitter' => 'https://twitter.com/johndoe'
    ]"
    href="/instructors/john-doe"
/>

<!-- Compact Instructor Card -->
<x-ui.instructor-card
    name="Jane Smith"
    title="UX Design Expert"
    avatar="path/to/avatar.jpg"
    :rating="4.9"
    :students="2345"
    layout="compact"
    href="/instructors/jane-smith"
/>

<!-- Horizontal Featured Instructor Card -->
<x-ui.instructor-card
    name="Mike Johnson"
    title="Full Stack Developer"
    avatar="path/to/avatar.jpg"
    :rating="4.7"
    :reviews="200"
    :students="3456"
    :courses="15"
    description="Passionate about teaching modern web development technologies."
    layout="horizontal"
    :featured="true"
    href="/instructors/mike-johnson"
/>
--}}
