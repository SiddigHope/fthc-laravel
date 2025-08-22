@props([
    'title' => '',           // Thread title
    'content' => '',         // Thread content
    'author' => null,        // Author details
    'created_at' => null,    // Creation date
    'updated_at' => null,    // Last update date
    'replies' => [],         // Array of reply objects
    'votes' => 0,           // Vote count
    'views' => 0,           // View count
    'tags' => [],           // Thread tags
    'solved' => false,      // Whether thread is marked as solved
    'pinned' => false,      // Whether thread is pinned
    'locked' => false,      // Whether thread is locked
    'variant' => 'default', // default, compact, detailed
    'can_reply' => true     // Whether user can reply
])

@php
    $threadClasses = [
        'discussion-thread card',
        $pinned ? 'thread-pinned' : '',
        $solved ? 'thread-solved' : '',
        $locked ? 'thread-locked' : '',
        $variant === 'compact' ? 'thread-compact' : '',
        $attributes->get('class')
    ];

    $formatDate = function($date) {
        return $date ? \Carbon\Carbon::parse($date)->diffForHumans() : '';
    };
@endphp

<div class="{{ implode(' ', array_filter($threadClasses)) }}">
    <div class="card-body">
        <!-- Thread Header -->
        <div class="thread-header d-flex align-items-start mb-3">
            <div class="thread-votes text-center me-3">
                <button class="btn btn-sm btn-light vote-up" title="Vote up">
                    <i class="fas fa-chevron-up"></i>
                </button>
                <div class="votes-count my-1 fw-bold {{ $votes > 0 ? 'text-success' : ($votes < 0 ? 'text-danger' : '') }}">
                    {{ $votes }}
                </div>
                <button class="btn btn-sm btn-light vote-down" title="Vote down">
                    <i class="fas fa-chevron-down"></i>
                </button>
            </div>

            <div class="thread-main flex-grow-1">
                <div class="d-flex align-items-center mb-2">
                    <h5 class="thread-title mb-0 me-2">{{ $title }}</h5>
                    <div class="thread-badges">
                        @if($pinned)
                            <span class="badge bg-warning" title="Pinned">
                                <i class="fas fa-thumbtack"></i>
                            </span>
                        @endif
                        @if($solved)
                            <span class="badge bg-success" title="Solved">
                                <i class="fas fa-check"></i>
                            </span>
                        @endif
                        @if($locked)
                            <span class="badge bg-secondary" title="Locked">
                                <i class="fas fa-lock"></i>
                            </span>
                        @endif
                    </div>
                </div>

                @if(count($tags) > 0)
                    <div class="thread-tags mb-2">
                        @foreach($tags as $tag)
                            <span class="badge bg-light text-dark me-1">{{ $tag }}</span>
                        @endforeach
                    </div>
                @endif

                @if($variant !== 'compact')
                    <div class="thread-content mb-3">
                        {{ $content }}
                    </div>
                @endif

                <div class="thread-meta d-flex align-items-center small text-muted">
                    @if($author)
                        <div class="thread-author me-3">
                            <img src="{{ asset($author['avatar'] ?? 'images/avatar/placeholder.jpg') }}"
                                 class="avatar-xs rounded-circle me-1"
                                 alt="{{ $author['name'] }}">
                            <span>{{ $author['name'] }}</span>
                            @if(!empty($author['role']))
                                <span class="badge bg-light text-dark ms-1">{{ $author['role'] }}</span>
                            @endif
                        </div>
                    @endif

                    @if($created_at)
                        <div class="thread-date me-3" title="Created {{ $created_at }}">
                            <i class="far fa-clock me-1"></i>
                            {{ $formatDate($created_at) }}
                        </div>
                    @endif

                    @if($views > 0)
                        <div class="thread-views me-3">
                            <i class="far fa-eye me-1"></i>
                            {{ $views }}
                        </div>
                    @endif

                    <div class="thread-replies">
                        <i class="far fa-comment me-1"></i>
                        {{ count($replies) }}
                    </div>
                </div>
            </div>
        </div>

        <!-- Thread Replies -->
        @if(count($replies) > 0 && $variant === 'detailed')
            <div class="thread-replies-section mt-4">
                <h6 class="replies-title mb-3">{{ count($replies) }} {{ Str::plural('Reply', count($replies)) }}</h6>

                <div class="replies-list">
                    @foreach($replies as $reply)
                        <div class="reply card mb-2">
                            <div class="card-body">
                                <div class="d-flex">
                                    @if(isset($reply['author']))
                                        <div class="reply-author me-3">
                                            <img src="{{ asset($reply['author']['avatar'] ?? 'images/avatar/placeholder.jpg') }}"
                                                 class="avatar-xs rounded-circle"
                                                 alt="{{ $reply['author']['name'] }}">
                                        </div>
                                    @endif

                                    <div class="reply-content flex-grow-1">
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <div class="reply-meta small">
                                                <span class="fw-bold">{{ $reply['author']['name'] ?? 'Anonymous' }}</span>
                                                @if(isset($reply['created_at']))
                                                    <span class="text-muted ms-2">{{ $formatDate($reply['created_at']) }}</span>
                                                @endif
                                            </div>
                                            @if(isset($reply['is_solution']) && $reply['is_solution'])
                                                <span class="badge bg-success">
                                                    <i class="fas fa-check me-1"></i> Solution
                                                </span>
                                            @endif
                                        </div>
                                        <div class="reply-text">
                                            {{ $reply['content'] }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Reply Form -->
        @if($can_reply && !$locked && $variant === 'detailed')
            <div class="reply-form mt-4">
                <h6 class="mb-3">Add a Reply</h6>
                <form>
                    <div class="mb-3">
                        <textarea class="form-control"
                                  rows="3"
                                  placeholder="Write your reply here..."></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">
                        Post Reply
                    </button>
                </form>
            </div>
        @endif
    </div>
</div>

@push('styles')
<style>
    .discussion-thread {
        border: 1px solid var(--bs-border-color);
        transition: all 0.2s ease;
    }

    .discussion-thread:hover {
        box-shadow: 0 .125rem .25rem rgba(0,0,0,.075);
    }

    .thread-pinned {
        border-left: 3px solid var(--bs-warning);
    }

    .thread-solved {
        border-left: 3px solid var(--bs-success);
    }

    .thread-locked {
        opacity: 0.8;
    }

    .thread-votes button {
        padding: 0.25rem 0.5rem;
    }

    .thread-votes button:hover {
        background-color: var(--bs-gray-200);
    }

    .thread-compact .thread-content {
        display: none;
    }

    .avatar-xs {
        width: 24px;
        height: 24px;
    }

    .replies-list .reply:last-child {
        margin-bottom: 0 !important;
    }

    .reply {
        background-color: var(--bs-light);
    }

    .reply-form textarea {
        resize: vertical;
    }
</style>
@endpush

{{-- Usage Examples:
<!-- Default Discussion Thread -->
<x-ui.discussion-thread
    title="How to implement authentication in Laravel?"
    content="I'm new to Laravel and trying to understand the authentication system. Can someone explain the basic steps?"
    :author="[
        'name' => 'John Smith',
        'avatar' => 'images/avatars/john.jpg',
        'role' => 'Student'
    ]"
    created_at="2023-06-20 10:30:00"
    :votes="5"
    :views="120"
    :tags="['Laravel', 'Authentication', 'Beginner']"
/>

<!-- Detailed Discussion Thread with Replies -->
<x-ui.discussion-thread
    title="Best practices for React component structure"
    content="What are the current best practices for structuring React components? Should we use functional or class components?"
    :author="[
        'name' => 'Sarah Johnson',
        'avatar' => 'images/avatars/sarah.jpg',
        'role' => 'Instructor'
    ]"
    created_at="2023-06-19 15:45:00"
    :votes="12"
    :views="350"
    :tags="['React', 'JavaScript', 'Best Practices']"
    :pinned="true"
    :solved="true"
    variant="detailed"
    :replies="[
        [
            'content' => 'Functional components with hooks are the way to go now.',
            'author' => ['name' => 'Mike Brown', 'avatar' => 'images/avatars/mike.jpg'],
            'created_at' => '2023-06-19 16:00:00',
            'is_solution' => true
        ],
        [
            'content' => 'Agree with Mike. Class components are still valid but hooks are more flexible.',
            'author' => ['name' => 'Emma Wilson', 'avatar' => 'images/avatars/emma.jpg'],
            'created_at' => '2023-06-19 16:30:00'
        ]
    ]"
/>

<!-- Compact Locked Thread -->
<x-ui.discussion-thread
    title="Course completion certificate issue"
    :author="[
        'name' => 'David Lee',
        'avatar' => 'images/avatars/david.jpg'
    ]"
    created_at="2023-06-18 09:15:00"
    :votes="-2"
    :views="45"
    :locked="true"
    variant="compact"
    :can_reply="false"
/>
--}}
