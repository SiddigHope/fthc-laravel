@props(['course'])

<div class="col-sm-6 col-lg-4 col-xl-3">
    <div class="card shadow h-100" onclick="window.location.href='{{ route('courses.show', $course->crsId) }}'" style="cursor: pointer;">
        <!-- Image -->
        <img src="{{ asset($course->crsImage ?? 'assets/images/courses/4by3/01.jpg') }}" class="card-img-top" alt="{{ app()->getLocale() == 'en' ? $course->crsNameEn : $course->crsNameAr }}">
        <!-- Card body -->
        <div class="card-body pb-0">
            <!-- Badge and favorite -->
            <div class="d-flex justify-content-between mb-2">
                <span class="badge bg-success bg-opacity-10 text-success">
                    {{ $course->crsStatus }}
                </span>
                <a href="#" class="h6 mb-0" onclick="event.stopPropagation();">
                    <i class="far fa-heart"></i>
                </a>
            </div>
            <!-- Title -->
            <h5 class="card-title fw-normal">
                {{ app()->getLocale() == 'en' ? $course->crsNameEn : $course->crsNameAr }}
            </h5>
            <p class="mb-2 text-truncate-2">
                {{ app()->getLocale() == 'en' ? $course->crsDescriptionEn : $course->crsDescriptionAr }}
            </p>
            <!-- Rating stars -->
            <ul class="list-inline mb-0">
                @php
                    $rating = $course->averageRating ?? 0;
                    $fullStars = floor($rating);
                    $halfStar = $rating - $fullStars >= 0.5;
                @endphp

                @for($i = 1; $i <= 5; $i++)
                    <li class="list-inline-item me-0 small">
                        @if($i <= $fullStars)
                            <i class="fas fa-star text-warning"></i>
                        @elseif($i == $fullStars + 1 && $halfStar)
                            <i class="fas fa-star-half-alt text-warning"></i>
                        @else
                            <i class="far fa-star text-warning"></i>
                        @endif
                    </li>
                @endfor
                <li class="list-inline-item ms-2 h6 fw-light mb-0">
                    {{ number_format($rating, 1) }}/5.0
                </li>
            </ul>
        </h5>

        </div>
        <!-- Card footer -->
        <div class="card-footer pt-0 pb-3">
            <hr>
            <div class="d-flex justify-content-between">
                <span class="h6 fw-light mb-0">
                    <i class="far fa-clock text-danger me-2"></i>{{ $course->crsDuration }} {{ __('messages.hours') }}
                </span>
                <span class="h6 fw-light mb-0">
                    <i class="fas fa-user-graduate text-orange me-2"></i>{{ $course->registrations_count ?? 0 }} {{ __('messages.students') }}
                </span>
            </div>
        </div>
    </div>
</div>
