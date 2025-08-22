@props([
    'rating' => 0,          // Overall rating
    'totalReviews' => 0,    // Total number of reviews
    'ratingBreakdown' => [], // Rating breakdown by stars
    'reviews' => [],        // Array of review objects
    'canReview' => false,   // Whether user can add a review
    'layout' => 'default',  // default, compact
    'showFilters' => true,  // Show rating filters
    'showPagination' => true, // Show pagination
    'perPage' => 5          // Reviews per page
])

@php
    // Calculate rating percentages
    $ratingPercentages = [];
    for ($i = 5; $i >= 1; $i--) {
        $count = $ratingBreakdown[$i] ?? 0;
        $percentage = $totalReviews > 0 ? ($count / $totalReviews) * 100 : 0;
        $ratingPercentages[$i] = [
            'count' => $count,
            'percentage' => $percentage
        ];
    }
@endphp

<div class="course-reviews {{ $layout }} {{ $attributes->get('class') }}">
    <!-- Rating Overview -->
    <div class="row g-4 align-items-center">
        <div class="col-md-4 text-center">
            <h2 class="mb-0">{{ number_format($rating, 1) }}</h2>
            <div class="d-flex justify-content-center align-items-center mb-2">
                @for($i = 1; $i <= 5; $i++)
                    @if($i <= floor($rating))
                        <i class="fas fa-star text-warning"></i>
                    @elseif($i - 0.5 <= $rating)
                        <i class="fas fa-star-half-alt text-warning"></i>
                    @else
                        <i class="far fa-star text-warning"></i>
                    @endif
                @endfor
            </div>
            <p class="mb-0">{{ number_format($totalReviews) }} Reviews</p>
        </div>

        <div class="col-md-8">
            <!-- Rating Breakdown -->
            @for($i = 5; $i >= 1; $i--)
                <div class="d-flex align-items-center mb-2">
                    <div class="text-nowrap me-3">
                        <i class="fas fa-star text-warning me-1"></i>
                        {{ $i }}
                    </div>
                    <div class="w-100">
                        <div class="progress" style="height: 8px;">
                            <div class="progress-bar bg-warning"
                                 role="progressbar"
                                 style="width: {{ $ratingPercentages[$i]['percentage'] }}%"
                                 aria-valuenow="{{ $ratingPercentages[$i]['percentage'] }}"
                                 aria-valuemin="0"
                                 aria-valuemax="100"></div>
                        </div>
                    </div>
                    <div class="text-nowrap ms-3">
                        {{ number_format($ratingPercentages[$i]['count']) }}
                    </div>
                </div>
            @endfor
        </div>
    </div>

    @if($canReview)
        <!-- Add Review Form -->
        <div class="add-review mt-4">
            <h5>Add Your Review</h5>
            <form action="{{ route('courses.reviews.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Your Rating</label>
                    <div class="rating-input">
                        <x-ui.rating name="rating" :value="0" size="lg" />
                    </div>
                </div>
                <div class="mb-3">
                    <label for="reviewTitle" class="form-label">Title</label>
                    <input type="text"
                           class="form-control"
                           id="reviewTitle"
                           name="title"
                           placeholder="Summarize your review"
                           required>
                </div>
                <div class="mb-3">
                    <label for="reviewContent" class="form-label">Review</label>
                    <textarea class="form-control"
                              id="reviewContent"
                              name="content"
                              rows="4"
                              placeholder="Tell us your experience with this course"
                              required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Submit Review</button>
            </form>
        </div>
    @endif

    <!-- Reviews List -->
    @if(!empty($reviews))
        <div class="reviews-list mt-4">
            @if($showFilters)
                <div class="reviews-filter mb-3">
                    <select class="form-select w-auto">
                        <option value="recent">Most Recent</option>
                        <option value="helpful">Most Helpful</option>
                        <option value="highest">Highest Rated</option>
                        <option value="lowest">Lowest Rated</option>
                    </select>
                </div>
            @endif

            @foreach($reviews as $review)
                <div class="review-item card card-body {{ !$loop->last ? 'mb-3' : '' }}">
                    <div class="d-flex mb-3">
                        <div class="flex-shrink-0">
                            @if($review['user']['avatar'])
                                <img src="{{ asset($review['user']['avatar']) }}"
                                     class="avatar avatar-sm rounded-circle"
                                     alt="{{ $review['user']['name'] }}">
                            @else
                                <div class="avatar avatar-sm bg-primary-soft text-primary rounded-circle">
                                    {{ Str::upper(Str::substr($review['user']['name'], 0, 2)) }}
                                </div>
                            @endif
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="mb-0">{{ $review['user']['name'] }}</h6>
                                    <div class="d-flex align-items-center small">
                                        @for($i = 1; $i <= 5; $i++)
                                            <i class="{{ $i <= $review['rating'] ? 'fas' : 'far' }} fa-star text-warning"></i>
                                        @endfor
                                        <span class="ms-2 text-muted">{{ $review['created_at']->diffForHumans() }}</span>
                                    </div>
                                </div>
                                @if($review['verified_purchase'])
                                    <div class="badge bg-success-soft text-success">
                                        <i class="fas fa-check-circle me-1"></i> Verified Purchase
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    @if($review['title'])
                        <h6 class="mb-2">{{ $review['title'] }}</h6>
                    @endif

                    <p class="mb-2">{{ $review['content'] }}</p>

                    <div class="d-flex align-items-center">
                        <button class="btn btn-sm btn-light me-2" title="Helpful">
                            <i class="far fa-thumbs-up me-1"></i>
                            {{ number_format($review['helpful_count']) }}
                        </button>
                        @if($review['instructor_response'])
                            <span class="badge bg-light text-dark">
                                <i class="fas fa-comment-dots me-1"></i> Instructor Responded
                            </span>
                        @endif
                    </div>

                    @if($review['instructor_response'])
                        <div class="instructor-response bg-light rounded p-3 mt-3">
                            <div class="d-flex mb-2">
                                <div class="flex-shrink-0">
                                    @if($review['instructor_response']['avatar'])
                                        <img src="{{ asset($review['instructor_response']['avatar']) }}"
                                             class="avatar avatar-xs rounded-circle"
                                             alt="{{ $review['instructor_response']['name'] }}">
                                    @else
                                        <div class="avatar avatar-xs bg-info-soft text-info rounded-circle">
                                            {{ Str::upper(Str::substr($review['instructor_response']['name'], 0, 2)) }}
                                        </div>
                                    @endif
                                </div>
                                <div class="flex-grow-1 ms-2">
                                    <h6 class="mb-0 small">{{ $review['instructor_response']['name'] }}</h6>
                                    <span class="small text-muted">Instructor</span>
                                </div>
                            </div>
                            <p class="mb-0 small">{{ $review['instructor_response']['content'] }}</p>
                        </div>
                    @endif
                </div>
            @endforeach

            @if($showPagination && method_exists($reviews, 'links'))
                <div class="mt-4">
                    {{ $reviews->links() }}
                </div>
            @endif
        </div>
    @else
        <div class="text-center py-5">
            <i class="fas fa-comment-alt fa-3x text-muted mb-3"></i>
            <h5>No Reviews Yet</h5>
            <p class="mb-0">Be the first to review this course</p>
        </div>
    @endif
</div>

@push('styles')
<style>
    .course-reviews .progress {
        background-color: var(--bs-gray-200);
    }

    .course-reviews.compact .review-item {
        padding: 1rem;
    }

    .course-reviews.compact .avatar {
        width: 2rem;
        height: 2rem;
    }

    .course-reviews .instructor-response {
        border-left: 3px solid var(--bs-info);
    }
</style>
@endpush

{{-- Usage Example:
@php
    $reviews = [
        [
            'id' => 1,
            'rating' => 5,
            'title' => 'Excellent Course!',
            'content' => 'This course exceeded my expectations. The content is well-structured and the instructor explains everything clearly.',
            'created_at' => now()->subDays(2),
            'helpful_count' => 15,
            'verified_purchase' => true,
            'user' => [
                'name' => 'John Doe',
                'avatar' => null
            ],
            'instructor_response' => [
                'name' => 'Jane Smith',
                'avatar' => 'path/to/avatar.jpg',
                'content' => 'Thank you for your kind words! I'm glad you found the course helpful.'
            ]
        ]
    ];

    $ratingBreakdown = [
        5 => 150,
        4 => 80,
        3 => 20,
        2 => 5,
        1 => 2
    ];
@endphp

<!-- Default Course Reviews -->
<x-ui.course-reviews
    :rating="4.5"
    :totalReviews="257"
    :ratingBreakdown="$ratingBreakdown"
    :reviews="$reviews"
    :canReview="true"
/>

<!-- Compact Course Reviews -->
<x-ui.course-reviews
    :rating="4.5"
    :totalReviews="257"
    :ratingBreakdown="$ratingBreakdown"
    :reviews="$reviews"
    layout="compact"
    :showFilters="false"
/>
--}}
