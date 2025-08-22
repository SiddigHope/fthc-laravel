@extends('layouts.app')

@section('title', __('messages.site_title'))

@section('content')
<!-- =======================
Hero Banner START -->
<section class="position-relative overflow-hidden pt-5 pt-lg-3">
    <!-- SVG decoration -->
    <figure class="position-absolute top-50 start-0 translate-middle-y">
        <svg width="822.2" height="722.6" viewBox="0 0 822.2 722.6">
            <path class="fill-primary opacity-1" d="M752.5,51.9c-4.5,3.9-8.9,7.8-13.4,11.8c-51.5,45.3-104.8,92.2-171.7,101.4c-39.9,5.5-80.2-3.6-119.2-12.3 c-32.3-7.2-65.6-14.6-98-13.2c-31.1,1.4-60.6,10.4-89.2,20.3c-70.3,24.3-137.2,59.7-195.4,107.2c-23.2,19-45.4,41.2-62.3,66.2 c-30.3,44.7-33.2,102.4-34.6,157.3c-1.8,71.8-3.8,143.6-5.7,215.3c0.1,30.3,0.1,60.6,0.2,90.9c0,2.5,0.1,5,0.1,7.5h1013.3v-7.5 c0-30.3,0.1-60.6,0.2-90.9c-1.9-71.7-3.8-143.5-5.7-215.3c-1.4-54.9-4.3-112.6-34.6-157.3c-16.9-25-39.1-47.2-62.3-66.2 c-58.2-47.5-125.1-82.9-195.4-107.2c-28.6-9.9-58.1-18.9-89.2-20.3c-32.4-1.4-65.7,6-98,13.2c-39,8.7-79.3,17.8-119.2,12.3 C857.3,144,804,97.1,752.5,51.9z"></path>
        </svg>
    </figure>

    <div class="container position-relative">
        <div class="row align-items-center">
            <div class="col-md-6">
                <!-- Title -->
                <h1 class="mb-3">{{ __('messages.hero_title') }}</h1>
                <h2 class="mb-4 fs-3">{{ __('messages.hero_subtitle') }}</h2>
                <p class="mb-4">{{ __('messages.hero_description') }}</p>
                <!-- Button -->
                <div class="d-flex align-items-center mb-4">
                    <a href="#" class="btn btn-primary me-3">{{ __('messages.get_started') }}</a>
                    <a href="#" class="btn btn-outline-primary">{{ __('messages.view_courses') }}</a>
                </div>
                <!-- Counter START -->
                <div class="row g-3 mb-4">
                    <!-- Counter item -->
                    <div class="col-sm-6">
                        <div class="d-flex align-items-center">
                            <span class="h3 mb-0">10K+</span>
                            <span class="ms-2">{{ __('messages.counter_online_courses') }}</span>
                        </div>
                    </div>
                    <!-- Counter item -->
                    <div class="col-sm-6">
                        <div class="d-flex align-items-center">
                            <span class="h3 mb-0">200+</span>
                            <span class="ms-2">{{ __('messages.counter_expert_tutors') }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Image -->
            <div class="col-md-6 position-relative">
                <img src="{{ asset('assets/images/element/05.svg') }}" class="position-relative" alt="">
                <!-- Live courses -->
                <div class="position-absolute top-50 start-0 translate-middle-y ms-5">
                    <div class="d-flex align-items-center bg-white rounded-3 shadow p-3">
                        <span class="display-6 text-danger"><i class="fas fa-video"></i></span>
                        <div class="ms-3">
                            <h5 class="mb-0">{{ __('messages.live_courses') }}</h5>
                            <span>{{ __('messages.live_classes') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- =======================
Hero Banner END -->

<!-- =======================
Counter START -->
<section class="py-0 py-xl-5">
    <div class="container">
        <div class="row g-4">
            <!-- Counter item -->
            <div class="col-sm-6 col-xl-3">
                <div class="d-flex justify-content-center align-items-center p-4 bg-warning bg-opacity-15 rounded-3">
                    <span class="display-6 lh-1 text-warning mb-0"><i class="fas fa-tv"></i></span>
                    <div class="ms-4 h6 fw-normal mb-0">
                        <div class="d-flex">
                            <h5 class="purecounter mb-0 fw-bold" data-purecounter-start="0" data-purecounter-end="10" data-purecounter-delay="200">10</h5>
                            <span class="mb-0 h5">K</span>
                        </div>
                        <p class="mb-0">{{ __('messages.counter_online_courses') }}</p>
                    </div>
                </div>
            </div>
            <!-- Counter item -->
            <div class="col-sm-6 col-xl-3">
                <div class="d-flex justify-content-center align-items-center p-4 bg-blue bg-opacity-10 rounded-3">
                    <span class="display-6 lh-1 text-blue mb-0"><i class="fas fa-user-tie"></i></span>
                    <div class="ms-4 h6 fw-normal mb-0">
                        <div class="d-flex">
                            <h5 class="purecounter mb-0 fw-bold" data-purecounter-start="0" data-purecounter-end="200" data-purecounter-delay="200">200</h5>
                            <span class="mb-0 h5">+</span>
                        </div>
                        <p class="mb-0">{{ __('messages.counter_expert_tutors') }}</p>
                    </div>
                </div>
            </div>
            <!-- Counter item -->
            <div class="col-sm-6 col-xl-3">
                <div class="d-flex justify-content-center align-items-center p-4 bg-purple bg-opacity-10 rounded-3">
                    <span class="display-6 lh-1 text-purple mb-0"><i class="fas fa-user-graduate"></i></span>
                    <div class="ms-4 h6 fw-normal mb-0">
                        <div class="d-flex">
                            <h5 class="purecounter mb-0 fw-bold" data-purecounter-start="0" data-purecounter-end="60" data-purecounter-delay="200">60</h5>
                            <span class="mb-0 h5">K+</span>
                        </div>
                        <p class="mb-0">{{ __('messages.counter_online_students') }}</p>
                    </div>
                </div>
            </div>
            <!-- Counter item -->
            <div class="col-sm-6 col-xl-3">
                <div class="d-flex justify-content-center align-items-center p-4 bg-info bg-opacity-10 rounded-3">
                    <span class="display-6 lh-1 text-info mb-0"><i class="bi bi-patch-check-fill"></i></span>
                    <div class="ms-4 h6 fw-normal mb-0">
                        <div class="d-flex">
                            <h5 class="purecounter mb-0 fw-bold" data-purecounter-start="0" data-purecounter-end="6" data-purecounter-delay="300">6</h5>
                            <span class="mb-0 h5">K+</span>
                        </div>
                        <p class="mb-0">{{ __('messages.counter_certified_courses') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- =======================
Counter END -->

<!-- =======================
Popular course START -->
<section>
    <div class="container">
        <!-- Title -->
        <div class="row mb-4">
            <div class="col-lg-8 mx-auto text-center">
                <h2 class="fs-1">{{ __('messages.popular_courses_title') }}</h2>
                <p class="mb-0">{{ __('messages.popular_courses_subtitle') }}</p>
            </div>
        </div>

        <!-- Tabs START -->
        <ul class="nav nav-pills nav-pills-bg-soft justify-content-sm-center mb-4 px-3" id="course-pills-tab" role="tablist">
            <!-- Tab item -->
            <li class="nav-item me-2 me-sm-5">
                <button class="nav-link mb-2 mb-md-0 active" id="course-pills-tab-1" data-bs-toggle="pill" data-bs-target="#course-pills-tabs-1" type="button" role="tab" aria-controls="course-pills-tabs-1" aria-selected="true">{{ __('messages.web_design') }}</button>
            </li>
            <!-- Tab item -->
            <li class="nav-item me-2 me-sm-5">
                <button class="nav-link mb-2 mb-md-0" id="course-pills-tab-2" data-bs-toggle="pill" data-bs-target="#course-pills-tabs-2" type="button" role="tab" aria-controls="course-pills-tabs-2" aria-selected="false">{{ __('messages.development') }}</button>
            </li>
            <!-- Tab item -->
            <li class="nav-item me-2 me-sm-5">
                <button class="nav-link mb-2 mb-md-0" id="course-pills-tab-3" data-bs-toggle="pill" data-bs-target="#course-pills-tabs-3" type="button" role="tab" aria-controls="course-pills-tabs-3" aria-selected="false">{{ __('messages.graphic_design') }}</button>
            </li>
            <!-- Tab item -->
            <li class="nav-item me-2 me-sm-5">
                <button class="nav-link mb-2 mb-md-0" id="course-pills-tab-4" data-bs-toggle="pill" data-bs-target="#course-pills-tabs-4" type="button" role="tab" aria-controls="course-pills-tabs-4" aria-selected="false">{{ __('messages.marketing') }}</button>
            </li>
            <!-- Tab item -->
            <li class="nav-item me-2 me-sm-5">
                <button class="nav-link mb-2 mb-md-0" id="course-pills-tab-5" data-bs-toggle="pill" data-bs-target="#course-pills-tabs-5" type="button" role="tab" aria-controls="course-pills-tabs-5" aria-selected="false">{{ __('messages.finance') }}</button>
            </li>
        </ul>
        <!-- Tabs END -->

        <!-- Tabs content START -->
        <div class="tab-content" id="course-pills-tabContent">
            <!-- Content START -->
            <div class="tab-pane fade show active" id="course-pills-tabs-1" role="tabpanel" aria-labelledby="course-pills-tab-1">
                <div class="row g-4">
                    <!-- Card item START -->
                    <div class="col-sm-6 col-lg-4 col-xl-3">
                        <div class="card shadow h-100">
                            <!-- Image -->
                            <img src="{{ asset('assets/images/courses/4by3/08.jpg') }}" class="card-img-top" alt="course image">
                            <!-- Card body -->
                            <div class="card-body pb-0">
                                <!-- Badge and favorite -->
                                <div class="d-flex justify-content-between mb-2">
                                    <a href="#" class="badge bg-purple bg-opacity-10 text-purple">{{ __('messages.all_level') }}</a>
                                    <a href="#" class="h6 mb-0"><i class="far fa-heart"></i></a>
                                </div>
                                <!-- Title -->
                                <h5 class="card-title fw-normal"><a href="#">Sketch from A to Z: for app designer</a></h5>
                                <p class="mb-2 text-truncate-2">Proposal indulged no do sociable he throwing settling.</p>
                                <!-- Rating star -->
                                <ul class="list-inline mb-0">
                                    <li class="list-inline-item me-0 small"><i class="fas fa-star text-warning"></i></li>
                                    <li class="list-inline-item me-0 small"><i class="fas fa-star text-warning"></i></li>
                                    <li class="list-inline-item me-0 small"><i class="fas fa-star text-warning"></i></li>
                                    <li class="list-inline-item me-0 small"><i class="fas fa-star text-warning"></i></li>
                                    <li class="list-inline-item me-0 small"><i class="far fa-star text-warning"></i></li>
                                    <li class="list-inline-item ms-2 h6 fw-light mb-0">4.0/5.0</li>
                                </ul>
                            </div>
                            <!-- Card footer -->
                            <div class="card-footer pt-0 pb-3">
                                <hr>
                                <div class="d-flex justify-content-between">
                                    <span class="h6 fw-light mb-0"><i class="far fa-clock text-danger me-2"></i>12h 56m</span>
                                    <span class="h6 fw-light mb-0"><i class="fas fa-table text-orange me-2"></i>15 lectures</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Card item END -->

                    <!-- Card item START -->
                    <div class="col-sm-6 col-lg-4 col-xl-3">
                        <div class="card shadow h-100">
                            <!-- Image -->
                            <img src="{{ asset('assets/images/courses/4by3/02.jpg') }}" class="card-img-top" alt="course image">
                            <div class="card-body pb-0">
                                <!-- Badge and favorite -->
                                <div class="d-flex justify-content-between mb-2">
                                    <a href="#" class="badge bg-success bg-opacity-10 text-success">Beginner</a>
                                    <a href="#" class="text-danger"><i class="fas fa-heart"></i></a>
                                </div>
                                <!-- Title -->
                                <h5 class="card-title fw-normal"><a href="#">Graphic Design Masterclass</a></h5>
                                <p class="mb-2 text-truncate-2">Rooms oh fully taken by worse do Points afraid but may end Rooms</p>
                                <!-- Rating star -->
                                <ul class="list-inline mb-0">
                                    <li class="list-inline-item me-0 small"><i class="fas fa-star text-warning"></i></li>
                                    <li class="list-inline-item me-0 small"><i class="fas fa-star text-warning"></i></li>
                                    <li class="list-inline-item me-0 small"><i class="fas fa-star text-warning"></i></li>
                                    <li class="list-inline-item me-0 small"><i class="fas fa-star text-warning"></i></li>
                                    <li class="list-inline-item me-0 small"><i class="fas fa-star-half-alt text-warning"></i></li>
                                    <li class="list-inline-item ms-2 h6 fw-light mb-0">4.5/5.0</li>
                                </ul>
                            </div>
                            <!-- Card footer -->
                            <div class="card-footer pt-0 pb-3">
                                <hr>
                                <div class="d-flex justify-content-between">
                                    <span class="h6 fw-light mb-0"><i class="far fa-clock text-danger me-2"></i>9h 56m</span>
                                    <span class="h6 fw-light mb-0"><i class="fas fa-table text-orange me-2"></i>65 lectures</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Card item END -->
                </div>
            </div>
            <!-- Content END -->
        </div>
        <!-- Tabs content END -->
    </div>
</section>
<!-- =======================
Popular course END -->

<!-- =======================
Trending Courses START -->
<section class="pt-0 pt-md-5">
    <div class="container">
        <!-- Title -->
        <div class="row mb-4">
            <div class="col-lg-8 text-center mx-auto">
                <h2 class="mb-0">Trending Courses</h2>
                <p class="mb-0">Explore our most popular courses</p>
            </div>
        </div>

        <div class="row g-4">
            <!-- Course item -->
            <div class="col-sm-6 col-lg-4 col-xl-3">
                <div class="card shadow h-100">
                    <!-- Image -->
                    <img src="{{ asset('assets/images/courses/4by3/01.jpg') }}" class="card-img-top" alt="course image">
                    <!-- Card body -->
                    <div class="card-body pb-0">
                        <!-- Badge and favorite -->
                        <div class="d-flex justify-content-between mb-2">
                            <a href="#" class="badge bg-success bg-opacity-10 text-success">Beginner</a>
                            <a href="#" class="text-danger"><i class="fas fa-heart"></i></a>
                        </div>
                        <!-- Title -->
                        <h5 class="card-title fw-normal"><a href="#">Web Development Fundamentals</a></h5>
                        <p class="mb-2 text-truncate-2">Learn the basics of web development with HTML, CSS, and JavaScript</p>
                        <!-- Rating -->
                        <ul class="list-inline mb-0">
                            <li class="list-inline-item me-0 small"><i class="fas fa-star text-warning"></i></li>
                            <li class="list-inline-item me-0 small"><i class="fas fa-star text-warning"></i></li>
                            <li class="list-inline-item me-0 small"><i class="fas fa-star text-warning"></i></li>
                            <li class="list-inline-item me-0 small"><i class="fas fa-star text-warning"></i></li>
                            <li class="list-inline-item me-0 small"><i class="fas fa-star-half-alt text-warning"></i></li>
                            <li class="list-inline-item ms-2 h6 fw-light mb-0">4.5/5.0</li>
                        </ul>
                    </div>
                    <!-- Card footer -->
                    <div class="card-footer pt-0 pb-3">
                        <hr>
                        <div class="d-flex justify-content-between">
                            <span class="h6 fw-light mb-0"><i class="far fa-clock text-danger me-2"></i>12h 56m</span>
                            <span class="h6 fw-light mb-0"><i class="fas fa-table text-orange me-2"></i>15 lectures</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- More course items can be added here -->
        </div>
    </div>
</section>
<!-- =======================
Trending Courses END -->

<!-- =======================
Categories START -->
<section class="pt-0 pt-md-5">
    <div class="container">
        <!-- Title -->
        <div class="row mb-4">
            <div class="col-lg-8 text-center mx-auto">
                <h2 class="mb-0">Top Categories</h2>
                <p class="mb-0">Explore our popular course categories</p>
            </div>
        </div>

        <div class="row g-4">
            <!-- Category item -->
            <div class="col-sm-6 col-lg-4 col-xl-3">
                <div class="card card-body shadow p-4 h-100">
                    <div class="d-flex">
                        <!-- Icon -->
                        <div class="icon-lg bg-primary bg-opacity-10 rounded-circle text-primary"><i class="fas fa-laptop-code"></i></div>
                        <!-- Content -->
                        <div class="ms-3">
                            <h5 class="mb-1"><a href="#" class="stretched-link">{{ __('messages.development') }}</a></h5>
                            <span class="mb-0">150+ Courses</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- More category items can be added here -->
        </div>
    </div>
</section>
<!-- =======================
Categories END -->
@endsection
