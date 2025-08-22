@extends('layouts.app')

@section('title', 'About Us - Eduport LMS Education & Course Theme')

@section('content')
<!-- =======================
About intro START -->
<section class="py-4">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="bg-light p-4 p-lg-5 rounded-3">
                    <div class="row g-4 align-items-center">
                        <!-- Content -->
                        <div class="col-lg-6">
                            <h1 class="mb-4">About Eduport</h1>
                            <p class="mb-4">Eduport is a leading online learning platform that connects students worldwide with the best instructors. Our mission is to provide affordable, accessible, and high-quality education to everyone.</p>
                            <ul class="list-group list-group-borderless mb-4">
                                <li class="list-group-item d-flex align-items-center px-0">
                                    <p class="mb-0"><i class="fas fa-check-circle text-success me-2"></i>Expert instructors with real-world experience</p>
                                </li>
                                <li class="list-group-item d-flex align-items-center px-0">
                                    <p class="mb-0"><i class="fas fa-check-circle text-success me-2"></i>Comprehensive curriculum designed by industry leaders</p>
                                </li>
                                <li class="list-group-item d-flex align-items-center px-0">
                                    <p class="mb-0"><i class="fas fa-check-circle text-success me-2"></i>Flexible learning schedule to fit your lifestyle</p>
                                </li>
                            </ul>
                        </div>

                        <!-- Image -->
                        <div class="col-lg-6 text-center">
                            <img src="{{ asset('assets/images/element/02.svg') }}" class="h-400px" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- =======================
About intro END -->

<!-- =======================
Counter START -->
<section class="py-4">
    <div class="container">
        <div class="row g-4">
            <!-- Counter item -->
            <div class="col-sm-6 col-lg-3">
                <div class="d-flex justify-content-center align-items-center p-4 bg-warning bg-opacity-15 rounded-3">
                    <span class="display-6 text-warning mb-0"><i class="fas fa-tv fa-fw"></i></span>
                    <div class="ms-4">
                        <div class="d-flex">
                            <h5 class="purecounter mb-0 fw-bold" data-purecounter-start="0" data-purecounter-end="10" data-purecounter-delay="200">10</h5>
                            <span class="mb-0 h5">K+</span>
                        </div>
                        <p class="mb-0">Online Courses</p>
                    </div>
                </div>
            </div>

            <!-- Counter item -->
            <div class="col-sm-6 col-lg-3">
                <div class="d-flex justify-content-center align-items-center p-4 bg-blue bg-opacity-10 rounded-3">
                    <span class="display-6 text-blue mb-0"><i class="fas fa-user-graduate fa-fw"></i></span>
                    <div class="ms-4">
                        <div class="d-flex">
                            <h5 class="purecounter mb-0 fw-bold" data-purecounter-start="0" data-purecounter-end="200" data-purecounter-delay="200">200</h5>
                            <span class="mb-0 h5">+</span>
                        </div>
                        <p class="mb-0">Expert Instructors</p>
                    </div>
                </div>
            </div>

            <!-- Counter item -->
            <div class="col-sm-6 col-lg-3">
                <div class="d-flex justify-content-center align-items-center p-4 bg-purple bg-opacity-10 rounded-3">
                    <span class="display-6 text-purple mb-0"><i class="fas fa-user-tie fa-fw"></i></span>
                    <div class="ms-4">
                        <div class="d-flex">
                            <h5 class="purecounter mb-0 fw-bold" data-purecounter-start="0" data-purecounter-end="60" data-purecounter-delay="200">60</h5>
                            <span class="mb-0 h5">K+</span>
                        </div>
                        <p class="mb-0">Students Enrolled</p>
                    </div>
                </div>
            </div>

            <!-- Counter item -->
            <div class="col-sm-6 col-lg-3">
                <div class="d-flex justify-content-center align-items-center p-4 bg-info bg-opacity-10 rounded-3">
                    <span class="display-6 text-info mb-0"><i class="fas fa-globe fa-fw"></i></span>
                    <div class="ms-4">
                        <div class="d-flex">
                            <h5 class="purecounter mb-0 fw-bold" data-purecounter-start="0" data-purecounter-end="100" data-purecounter-delay="200">100</h5>
                            <span class="mb-0 h5">+</span>
                        </div>
                        <p class="mb-0">Countries Reached</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- =======================
Counter END -->

<!-- =======================
Team START -->
<section class="pt-4 pb-5">
    <div class="container">
        <!-- Title -->
        <div class="row mb-4">
            <div class="col-lg-8 mx-auto text-center">
                <h2>Meet Our Team</h2>
                <p class="mb-0">Meet the talented people behind Eduport's success</p>
            </div>
        </div>

        <div class="row g-4">
            <!-- Team item -->
            <div class="col-sm-6 col-lg-3">
                <div class="card card-body shadow p-4 text-center">
                    <div class="avatar avatar-xl mx-auto mb-3">
                        <img class="avatar-img rounded-circle" src="{{ asset('assets/images/avatar/01.jpg') }}" alt="">
                    </div>
                    <h5>John Doe</h5>
                    <p class="mb-0">CEO & Founder</p>
                    <ul class="list-inline mb-0 mt-3">
                        <li class="list-inline-item"><a class="btn btn-sm px-2 bg-facebook" href="#"><i class="fab fa-fw fa-facebook-f"></i></a></li>
                        <li class="list-inline-item"><a class="btn btn-sm px-2 bg-instagram" href="#"><i class="fab fa-fw fa-instagram"></i></a></li>
                        <li class="list-inline-item"><a class="btn btn-sm px-2 bg-twitter" href="#"><i class="fab fa-fw fa-twitter"></i></a></li>
                    </ul>
                </div>
            </div>

            <!-- More team members can be added here -->

        </div>
    </div>
</section>
<!-- =======================
Team END -->
@endsection
