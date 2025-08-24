@extends('layouts.app')

@section('title', $course->crsNameEn . ' - ' . __('messages.site_title'))

@section('content')
<!-- =======================
Course detail START -->
<section class="pt-5">
    <div class="container">
        <div class="row">
            <!-- Main content START -->
            <div class="col-lg-8">
                <div class="card shadow rounded-2 p-0">
                    <!-- Image -->
                    @if($course->inPersonDetails && $course->inPersonDetails->crsInImageEn)
                    <img src="{{ asset('storage/' . $course->inPersonDetails->crsInImageEn) }}" class="card-img-top" alt="{{ $course->crsNameEn }}">
                    @else
                    <img src="{{ asset('assets/images/courses/default.jpg') }}" class="card-img-top" alt="{{ $course->crsNameEn }}">
                    @endif

                    <!-- Card body -->
                    <div class="card-body pb-0">
                        <!-- Title -->
                        <h1 class="card-title">{{ app()->getLocale() == 'en' ? $course->crsNameEn : $course->crsNameAr }}</h1>

                        <!-- Course info -->
                        <ul class="list-inline mb-4">
                            <li class="list-inline-item h6 fw-light mb-1 mb-sm-0">
                                <i class="fas fa-graduation-cap text-primary me-2"></i>
                                {{ $course->specialization->spcNameEn }} - {{ $course->subSpecialization->spcSubNameEn }}
                            </li>
                            <li class="list-inline-item h6 fw-light mb-1 mb-sm-0">
                                <i class="fas fa-calendar text-primary me-2"></i>
                                {{ $course->crsDate->format('d M Y') }}
                            </li>
                            <li class="list-inline-item h6 fw-light mb-1 mb-sm-0">
                                <i class="fas fa-tag text-primary me-2"></i>
                                {{ $course->type->typNameEn }}
                            </li>
                        </ul>

                        <!-- Description -->
                        <h4 class="mb-3">{{ __('messages.description') }}</h4>
                        <p class="mb-4">{{ app()->getLocale() == 'en' ? $course->crsDescriptionEn : $course->crsDescriptionAr }}</p>

                        @if($course->inPersonDetails)
                        <!-- Course details for in-person courses -->
                        <h4 class="mb-3">{{ __('messages.course_details') }}</h4>
                        <p class="mb-4">{{ app()->getLocale() == 'en' ? $course->inPersonDetails->crsInDetailsEn : $course->inPersonDetails->crsInDetailsAr }}</p>

                        <!-- Location and schedule -->
                        <h4 class="mb-3">{{ __('messages.location_and_schedule') }}</h4>
                        <ul class="list-group list-group-borderless mb-4">
                            <li class="list-group-item">
                                <i class="fas fa-map-marker-alt text-primary me-2"></i>
                                {{ $course->inPersonDetails->crsInLocation }}
                            </li>
                            <li class="list-group-item">
                                <i class="fas fa-calendar-alt text-primary me-2"></i>
                                {{ $course->inPersonDetails->lctDateStart->format('d M Y') }} - {{ $course->inPersonDetails->lctDateEnd->format('d M Y') }}
                            </li>
                            <li class="list-group-item">
                                <i class="fas fa-clock text-primary me-2"></i>
                                {{ $course->inPersonDetails->lctTimeStart }} - {{ $course->inPersonDetails->lctTimeEnd }}
                            </li>
                        </ul>
                        @endif
                    </div>
                </div>
            </div>
            <!-- Main content END -->

            <!-- Right sidebar START -->
            <div class="col-lg-4">
                <div class="card card-body shadow p-4">
                    <!-- Price and cart -->
                    <div class="mb-3">
                        <h3 class="mb-0">{{ $course->crsPrice }} SAR</h3>
                    </div>

                    <!-- Button -->
                    <div class="d-grid">
                        <a href="#" class="btn btn-lg btn-primary mb-2">{{ __('messages.enroll_now') }}</a>
                    </div>

                    <!-- Course includes -->
                    @if($course->inPersonDetails)
                    <ul class="list-group list-group-borderless mt-4">
                        @if($course->inPersonDetails->crsInCreditHoursNumber)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span><i class="fas fa-clock text-primary me-2"></i>{{ __('messages.credit_hours') }}</span>
                            <span>{{ $course->inPersonDetails->crsInCreditHoursNumber }}</span>
                        </li>
                        @endif
                        @if($course->inPersonDetails->crsInAccreditationNumber)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span><i class="fas fa-certificate text-primary me-2"></i>{{ __('messages.accreditation_number') }}</span>
                            <span>{{ $course->inPersonDetails->crsInAccreditationNumber }}</span>
                        </li>
                        @endif
                    </ul>
                    @endif
                </div>
            </div>
            <!-- Right sidebar END -->
        </div>
    </div>
</section>
<!-- =======================
Course detail END -->
@endsection
