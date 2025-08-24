@extends('layouts.app')

@section('title', __('messages.courses_title'))

@section('content')
<!-- =======================
Page Banner START -->
<section class="bg-light py-5">
    <div class="container">
        <div class="row g-4 g-md-5 align-items-center">
            <div class="col-lg-6">
                <!-- Title -->
                <h1 class="mb-3">{{ __('messages.courses_page_title') }}</h1>
                <p class="mb-0">{{ __('messages.courses_page_description') }}</p>
            </div>

            <!-- Search box -->
            <div class="col-lg-6">
                <form class="bg-body shadow rounded p-3">
                    <div class="row g-3">
                        <!-- Search course -->
                        <div class="col-sm-8">
                            <input class="form-control border" type="search" placeholder="{{ __('messages.search_courses') }}">
                        </div>
                        <!-- Search button -->
                        <div class="col-sm-4 d-grid">
                            <button type="button" class="btn btn-primary mb-0">{{ __('messages.search') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<!-- =======================
Page Banner END -->

<!-- =======================
Courses START -->
<section class="pt-5">
    <div class="container">
        <!-- Filters START -->
        <div class="row mb-4 align-items-center">
            <!-- Filter buttons -->
            <div class="col-lg-8">
                <form class="bg-light border p-3 rounded-3">
                    <div class="row g-3">
                        <!-- Course type -->
                        <div class="col-sm-6 col-md-4">
                            <select class="form-select" id="courseType">
                                <option value="">{{ __('messages.all_types') }}</option>
                                @foreach($courseTypes as $type)
                                    <option value="{{ $type->typId }}">
                                        {{ app()->getLocale() === 'en' ? $type->typNameEn : $type->typNameAr }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Specialization -->
                        <div class="col-sm-6 col-md-4">
                            <select class="form-select" id="specialization">
                                <option value="">{{ __('messages.all_specializations') }}</option>
                                @foreach($specializations as $specialization)
                                    <option value="{{ $specialization->spcId }}">
                                        {{ app()->getLocale() === 'en' ? $specialization->spcNameEn : $specialization->spcNameAr }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Sort by -->
                        <div class="col-sm-12 col-md-4">
                            <select class="form-select" id="sortBy">
                                <option value="latest">{{ __('messages.sort_latest') }}</option>
                                <option value="oldest">{{ __('messages.sort_oldest') }}</option>
                                <option value="price_low">{{ __('messages.sort_price_low') }}</option>
                                <option value="price_high">{{ __('messages.sort_price_high') }}</option>
                            </select>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Grid layout -->
            <div class="col-lg-4 mt-3 mt-lg-0 text-end">
                <div class="btn-group" role="group" aria-label="Course List Layout">
                    <button type="button" class="btn btn-light active" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ __('messages.grid_view') }}">
                        <i class="bi bi-grid-3x3-gap"></i>
                    </button>
                    <button type="button" class="btn btn-light" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ __('messages.list_view') }}">
                        <i class="bi bi-list"></i>
                    </button>
                </div>
            </div>
        </div>
        <!-- Filters END -->

        <!-- Course Grid START -->
        <div class="row g-4">
            @forelse($courses as $course)
            <!-- Card item START -->
            <div class="col-sm-6 col-lg-4 col-xl-3">
                <div class="card shadow h-100">
                    <!-- Image -->
                    <div class="card-img-top overflow-hidden">
                            <img src="{{ $course->crsImage }}"
                                 class="img-fluid" alt="{{ $course->crsNameEn }}">
                    </div>
                    <!-- Card body -->
                    <div class="card-body pb-0">
                        <!-- Badge and favorite -->
                        <div class="d-flex justify-content-between mb-2">
                            <span class="badge bg-purple-soft">
                                <i class="fas fa-graduation-cap me-2"></i>
                                {{ app()->getLocale() === 'en' ? $course->type->typNameEn : $course->type->typNameAr }}
                            </span>
                            <span class="h6 fw-light mb-0">{{ number_format($course->crsPrice, 2) }} SAR</span>
                        </div>
                        <!-- Title -->
                        <h5 class="card-title">
                            <a href="{{ route('courses.show', $course->crsId) }}" class="text-decoration-none">
                                {{ app()->getLocale() === 'en' ? $course->crsNameEn : $course->crsNameAr }}
                            </a>
                        </h5>
                        <!-- Description -->
                        <p class="mb-2 text-truncate-2">
                            {{ app()->getLocale() === 'en' ? $course->crsDescriptionEn : $course->crsDescriptionAr }}
                        </p>
                    </div>
                    <!-- Card footer -->
                    <div class="card-footer pt-0 pb-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="h6 fw-light mb-0">
                                <i class="fas fa-calendar text-primary me-2"></i>
                                {{ $course->crsDate->format('d M Y') }}
                            </span>
                            <a href="{{ route('courses.show', $course->crsId) }}" class="btn btn-sm btn-primary-soft">
                                {{ __('messages.view_details') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Card item END -->
            @empty
            <div class="col-12">
                <div class="alert alert-info text-center">
                    {{ __('messages.no_courses_found') }}
                </div>
            </div>
            @endforelse
        </div>
        <!-- Course Grid END -->

        <!-- Pagination START -->
        <div class="col-12 mt-5">
            <nav class="d-flex justify-content-center" aria-label="Course pagination">
                {{ $courses->links() }}
            </nav>
        </div>
        <!-- Pagination END -->
    </div>
</section>
<!-- =======================
Courses END -->
@endsection

@push('styles')
<style>
    .text-truncate-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    });

    // Handle view switching
    const gridButton = document.querySelector('.btn-group .bi-grid-3x3-gap').closest('button');
    const listButton = document.querySelector('.btn-group .bi-list').closest('button');
    const courseGrid = document.querySelector('.row.g-4');

    gridButton.addEventListener('click', function() {
        gridButton.classList.add('active');
        listButton.classList.remove('active');
        courseGrid.classList.remove('list-view');
    });

    listButton.addEventListener('click', function() {
        listButton.classList.add('active');
        gridButton.classList.remove('active');
        courseGrid.classList.add('list-view');
    });

    // Handle filters
    const filters = document.querySelectorAll('select');
    filters.forEach(filter => {
        filter.addEventListener('change', function() {
            applyFilters();
        });
    });

    function applyFilters() {
        const type = document.getElementById('courseType').value;
        const specialization = document.getElementById('specialization').value;
        const sort = document.getElementById('sortBy').value;

        window.location.href = `{{ route('courses.index') }}?type=${type}&specialization=${specialization}&sort=${sort}`;
    }
});
</script>
@endpush
