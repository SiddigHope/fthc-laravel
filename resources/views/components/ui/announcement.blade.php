@props([
    'title' => '',           // Announcement title
    'content' => '',         // Announcement content
    'type' => 'info',       // info, success, warning, danger
    'author' => null,        // Author details
    'created_at' => null,    // Creation date
    'expires_at' => null,    // Expiration date
    'image' => null,         // Optional image
    'link' => null,          // Optional CTA link
    'linkText' => 'Learn More', // CTA text
    'dismissible' => true,   // Whether announcement can be dismissed
    'variant' => 'default',  // default, compact, banner
    'priority' => 'normal'   // low, normal, high
])

@php
    $typeColors = [
        'info' => 'primary',
        'success' => 'success',
        'warning' => 'warning',
        'danger' => 'danger'
    ];

    $color = $typeColors[$type] ?? 'primary';

    $cardClasses = [
        'announcement-card',
        $variant === 'banner' ? 'announcement-banner' : 'card',
        $variant === 'compact' ? 'announcement-compact' : '',
        $priority === 'high' ? 'announcement-priority' : '',
        "border-{$color}",
        $attributes->get('class')
    ];

    $isExpired = $expires_at && \Carbon\Carbon::parse($expires_at)->isPast();
    $isNew = $created_at && \Carbon\Carbon::parse($created_at)->diffInHours() < 24;
@endphp

<div class="{{ implode(' ', array_filter($cardClasses)) }}"
     role="alert"
     data-announcement-id="{{ Str::random(8) }}">

    @if($variant === 'banner')
        <div class="announcement-banner-content bg-{{ $color }} bg-opacity-10 py-3">
            <div class="container">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-bullhorn text-{{ $color }} me-2"></i>
                        <div class="announcement-text">
                            <strong>{{ $title }}</strong>
                            @if($content && $variant !== 'compact')
                                <span class="ms-2">{{ $content }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="d-flex align-items-center">
                        @if($link)
                            <a href="{{ $link }}" class="btn btn-sm btn-{{ $color }} me-2">
                                {{ $linkText }}
                            </a>
                        @endif
                        @if($dismissible)
                            <button type="button"
                                    class="btn-close"
                                    data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="card-body">
            <div class="d-flex">
                <!-- Priority Indicator -->
                @if($priority === 'high')
                    <div class="priority-indicator bg-{{ $color }} me-3"></div>
                @endif

                <div class="flex-grow-1">
                    <!-- Announcement Header -->
                    <div class="announcement-header d-flex align-items-start justify-content-between mb-3">
                        <div>
                            <div class="d-flex align-items-center mb-2">
                                <h5 class="announcement-title mb-0">{{ $title }}</h5>
                                @if($isNew)
                                    <span class="badge bg-success ms-2">New</span>
                                @endif
                            </div>

                            @if($author || $created_at)
                                <div class="announcement-meta small text-muted">
                                    @if($author)
                                        <span class="me-3">
                                            <img src="{{ asset($author['avatar'] ?? 'images/avatar/placeholder.jpg') }}"
                                                 class="avatar-xs rounded-circle me-1"
                                                 alt="{{ $author['name'] }}">
                                            {{ $author['name'] }}
                                        </span>
                                    @endif

                                    @if($created_at)
                                        <span title="{{ $created_at }}">
                                            <i class="far fa-clock me-1"></i>
                                            {{ \Carbon\Carbon::parse($created_at)->diffForHumans() }}
                                        </span>
                                    @endif
                                </div>
                            @endif
                        </div>

                        @if($dismissible)
                            <button type="button"
                                    class="btn-close"
                                    data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                        @endif
                    </div>

                    <!-- Announcement Content -->
                    @if($content && $variant !== 'compact')
                        <div class="announcement-content mb-3">
                            {{ $content }}
                        </div>
                    @endif

                    <!-- Announcement Image -->
                    @if($image && $variant !== 'compact')
                        <div class="announcement-image mb-3">
                            <img src="{{ asset($image) }}"
                                 class="img-fluid rounded"
                                 alt="Announcement image">
                        </div>
                    @endif

                    <!-- Announcement Footer -->
                    <div class="announcement-footer d-flex align-items-center justify-content-between">
                        <div class="announcement-status small">
                            @if($expires_at)
                                <span class="text-{{ $isExpired ? 'danger' : 'muted' }}">
                                    <i class="far fa-calendar-alt me-1"></i>
                                    {{ $isExpired ? 'Expired' : 'Expires' }}
                                    {{ \Carbon\Carbon::parse($expires_at)->diffForHumans() }}
                                </span>
                            @endif
                        </div>

                        @if($link)
                            <a href="{{ $link }}" class="btn btn-sm btn-{{ $color }}">
                                {{ $linkText }}
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>

@push('styles')
<style>
    .announcement-card {
        position: relative;
        transition: all 0.3s ease;
    }

    .announcement-card:not(.announcement-banner) {
        border-width: 0;
        border-left-width: 4px;
    }

    .announcement-priority:not(.announcement-banner) {
        background-color: var(--bs-light);
    }

    .priority-indicator {
        width: 4px;
        border-radius: 2px;
    }

    .announcement-banner {
        width: 100%;
    }

    .announcement-banner .btn-close {
        padding: 0.5rem;
    }

    .announcement-compact .announcement-content,
    .announcement-compact .announcement-image {
        display: none;
    }

    .avatar-xs {
        width: 24px;
        height: 24px;
    }

    .announcement-image img {
        max-height: 300px;
        object-fit: cover;
        width: 100%;
    }
</style>
@endpush

{{-- Usage Examples:
<!-- Default Announcement -->
<x-ui.announcement
    title="New Course Released: Advanced Laravel Development"
    content="Learn advanced Laravel techniques including custom packages, service containers, and more."
    type="info"
    :author="[
        'name' => 'John Doe',
        'avatar' => 'images/avatars/john.jpg'
    ]"
    created_at="2023-06-20 09:00:00"
    link="/courses/advanced-laravel"
    linkText="Enroll Now"
/>

<!-- High Priority Warning Banner -->
<x-ui.announcement
    title="Scheduled Maintenance"
    content="The platform will be unavailable on Sunday, June 25th, from 2 AM to 4 AM UTC for system upgrades."
    type="warning"
    variant="banner"
    priority="high"
    :dismissible="false"
    created_at="2023-06-19 10:00:00"
    expires_at="2023-06-25 04:00:00"
/>

<!-- Compact Success Announcement -->
<x-ui.announcement
    title="Achievement Unlocked: Course Creator"
    type="success"
    variant="compact"
    created_at="2023-06-18 15:30:00"
/>

<!-- Announcement with Image -->
<x-ui.announcement
    title="Summer Learning Festival"
    content="Join our biggest learning event of the year! Get access to exclusive workshops, live sessions, and special discounts."
    type="info"
    image="images/announcements/summer-festival.jpg"
    link="/events/summer-festival"
    linkText="Register Now"
    :author="[
        'name' => 'Event Team',
        'avatar' => 'images/avatars/team.jpg'
    ]"
    created_at="2023-06-15 12:00:00"
    expires_at="2023-07-15 23:59:59"
    priority="high"
/>
--}}
