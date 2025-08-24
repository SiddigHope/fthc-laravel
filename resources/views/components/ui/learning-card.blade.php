@props(['registration', 'type'])

<div class="col-sm-6 col-lg-4 col-xl-3">
    <div class="card shadow h-100">
        <!-- Image -->
        <img src="{{ asset($registration->course->crsImage ?? 'assets/images/courses/4by3/01.jpg') }}"
             class="card-img-top"
             alt="{{ app()->getLocale() == 'en' ? $registration->course->crsNameEn : $registration->course->crsNameAr }}">

        <!-- Card body -->
        <div class="card-body pb-0">
            <!-- Badge and status -->
            <div class="d-flex justify-content-between mb-2">
                @switch($type)
                    @case('completed')
                        <span class="badge bg-success bg-opacity-10 text-success">
                            {{ __('messages.completed') }}
                        </span>
                        @break
                    @case('in-progress')
                        <span class="badge bg-info bg-opacity-10 text-info">
                            {{ __('messages.in_progress') }}
                        </span>
                        @break
                    @case('upcoming')
                        <span class="badge bg-purple bg-opacity-10 text-purple">
                            {{ __('messages.upcoming') }}
                        </span>
                        @break
                    @case('pending')
                        <span class="badge bg-warning bg-opacity-10 text-warning">
                            {{ __('messages.pending_approval') }}
                        </span>
                        @break
                @endswitch

                @if($type === 'pending')
                    <span class="text-primary small">
                        {{ $registration->created_at->format('d M Y') }}
                    </span>
                @endif
            </div>

            <!-- Title -->
            <h5 class="card-title fw-normal mb-2">
                {{ app()->getLocale() == 'en' ? $registration->course->crsNameEn : $registration->course->crsNameAr }}
            </h5>

            <!-- Progress bar -->
            @if($type === 'in-progress' && $registration->course->inPersonDetails)
                @php
                    $startDate = $registration->course->inPersonDetails->lctDateStart;
                    $endDate = $registration->course->inPersonDetails->lctDateEnd;
                    $totalDays = $startDate->diffInDays($endDate);
                    $passedDays = $startDate->diffInDays(now());
                    $progress = min(100, round(($passedDays / $totalDays) * 100));
                @endphp
                <div class="progress mb-3" style="height: 6px;">
                    <div class="progress-bar bg-primary" role="progressbar" style="width: {{ $progress }}%"></div>
                </div>
                <p class="mb-2 small text-end">{{ $progress }}% {{ __('messages.completed') }}</p>
            @endif
        </div>

        <!-- Card footer -->
        <div class="card-footer pt-0 pb-3">
            <hr>
            <div class="d-flex justify-content-between align-items-center">
                <!-- Schedule -->
                <div class="d-flex align-items-center">
                    <i class="far fa-calendar-alt text-primary me-2"></i>
                    <span class="text-truncate small">
                        @if($registration->course->inPersonDetails)
                            {{ $registration->course->inPersonDetails->lctDateStart->format('d M Y') }}
                        @else
                            {{ __('messages.date_tbd') }}
                        @endif
                    </span>
                </div>

                <!-- Actions dropdown -->
                <div class="dropdown">
                    <a href="#" class="btn btn-sm btn-light" role="button" id="dropdownAction{{ $registration->regId }}" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-ellipsis-v"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownAction{{ $registration->regId }}">
                        @if($type === 'completed')
                            <li>
                                <a class="dropdown-item" href="{{ route('courses.certificate.download', $registration->regId) }}">
                                    <i class="fas fa-certificate text-success me-2"></i>
                                    {{ __('messages.download_certificate') }}
                                </a>
                            </li>
                        @endif
                        <li>
                            <a class="dropdown-item" href="{{ route('courses.invoice.download', $registration->regId) }}">
                                <i class="fas fa-file-invoice text-primary me-2"></i>
                                {{ __('messages.download_invoice') }}
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('courses.show', $registration->course->crsId) }}">
                                <i class="fas fa-info-circle text-info me-2"></i>
                                {{ __('messages.course_details') }}
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
