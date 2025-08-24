@extends('layouts.app')

@section('title', __('messages.my_learnings'))

@section('content')
<section class="pt-0">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card bg-transparent">
                    <!-- Card header START -->
                    <div class="card-header bg-transparent border-bottom">
                        <h3 class="mb-0">{{ __('messages.my_learnings') }}</h3>
                    </div>
                    <!-- Card header END -->

                    <!-- Card body START -->
                    <div class="card-body">
                        <!-- Tabs START -->
                        <ul class="nav nav-pills nav-pills-bg-soft justify-content-sm-start mb-4" id="course-pills-tab" role="tablist">
                            <!-- In Progress tab -->
                            <li class="nav-item me-2 me-sm-4">
                                <button class="nav-link mb-2 mb-md-0 active" id="course-pills-tab-1" data-bs-toggle="pill" data-bs-target="#course-pills-tabs-1" type="button" role="tab" aria-controls="course-pills-tabs-1" aria-selected="true">
                                    {{ __('messages.in_progress') }}
                                    @if($inProgressCourses->count() > 0)
                                        <span class="badge bg-primary ms-2">{{ $inProgressCourses->count() }}</span>
                                    @endif
                                </button>
                            </li>

                            <!-- Upcoming tab -->
                            <li class="nav-item me-2 me-sm-4">
                                <button class="nav-link mb-2 mb-md-0" id="course-pills-tab-2" data-bs-toggle="pill" data-bs-target="#course-pills-tabs-2" type="button" role="tab" aria-controls="course-pills-tabs-2" aria-selected="false">
                                    {{ __('messages.upcoming') }}
                                    @if($upcomingCourses->count() > 0)
                                        <span class="badge bg-primary ms-2">{{ $upcomingCourses->count() }}</span>
                                    @endif
                                </button>
                            </li>

                            <!-- Completed tab -->
                            <li class="nav-item me-2 me-sm-4">
                                <button class="nav-link mb-2 mb-md-0" id="course-pills-tab-3" data-bs-toggle="pill" data-bs-target="#course-pills-tabs-3" type="button" role="tab" aria-controls="course-pills-tabs-3" aria-selected="false">
                                    {{ __('messages.completed') }}
                                    @if($completedCourses->count() > 0)
                                        <span class="badge bg-primary ms-2">{{ $completedCourses->count() }}</span>
                                    @endif
                                </button>
                            </li>

                            <!-- Pending tab -->
                            <li class="nav-item">
                                <button class="nav-link mb-2 mb-md-0" id="course-pills-tab-4" data-bs-toggle="pill" data-bs-target="#course-pills-tabs-4" type="button" role="tab" aria-controls="course-pills-tabs-4" aria-selected="false">
                                    {{ __('messages.pending') }}
                                    @if($pendingCourses->count() > 0)
                                        <span class="badge bg-warning ms-2">{{ $pendingCourses->count() }}</span>
                                    @endif
                                </button>
                            </li>
                        </ul>
                        <!-- Tabs END -->

                        <!-- Tab contents START -->
                        <div class="tab-content" id="course-pills-tabContent">
                            <!-- In Progress courses START -->
                            <div class="tab-pane fade show active" id="course-pills-tabs-1" role="tabpanel" aria-labelledby="course-pills-tab-1">
                                <div class="row g-4">
                                    @forelse($inProgressCourses as $registration)
                                        <x-ui.learning-card
                                            :registration="$registration"
                                            type="in-progress"
                                        />
                                    @empty
                                        <div class="col-12">
                                            <x-ui.empty-state
                                                icon="fas fa-book-reader"
                                                :message="__('messages.no_in_progress_courses')"
                                            />
                                        </div>
                                    @endforelse
                                </div>
                            </div>
                            <!-- In Progress courses END -->

                            <!-- Upcoming courses START -->
                            <div class="tab-pane fade" id="course-pills-tabs-2" role="tabpanel" aria-labelledby="course-pills-tab-2">
                                <div class="row g-4">
                                    @forelse($upcomingCourses as $registration)
                                        <x-ui.learning-card
                                            :registration="$registration"
                                            type="upcoming"
                                        />
                                    @empty
                                        <div class="col-12">
                                            <x-ui.empty-state
                                                icon="fas fa-calendar-alt"
                                                :message="__('messages.no_upcoming_courses')"
                                            />
                                        </div>
                                    @endforelse
                                </div>
                            </div>
                            <!-- Upcoming courses END -->

                            <!-- Completed courses START -->
                            <div class="tab-pane fade" id="course-pills-tabs-3" role="tabpanel" aria-labelledby="course-pills-tab-3">
                                <div class="row g-4">
                                    @forelse($completedCourses as $registration)
                                        <x-ui.learning-card
                                            :registration="$registration"
                                            type="completed"
                                        />
                                    @empty
                                        <div class="col-12">
                                            <x-ui.empty-state
                                                icon="fas fa-graduation-cap"
                                                :message="__('messages.no_completed_courses')"
                                            />
                                        </div>
                                    @endforelse
                                </div>
                            </div>
                            <!-- Completed courses END -->

                            <!-- Pending courses START -->
                            <div class="tab-pane fade" id="course-pills-tabs-4" role="tabpanel" aria-labelledby="course-pills-tab-4">
                                <div class="row g-4">
                                    @forelse($pendingCourses as $registration)
                                        <x-ui.learning-card
                                            :registration="$registration"
                                            type="pending"
                                        />
                                    @empty
                                        <div class="col-12">
                                            <x-ui.empty-state
                                                icon="fas fa-clock"
                                                :message="__('messages.no_pending_courses')"
                                            />
                                        </div>
                                    @endforelse
                                </div>
                            </div>
                            <!-- Pending courses END -->
                        </div>
                        <!-- Tab contents END -->
                    </div>
                    <!-- Card body END -->
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
