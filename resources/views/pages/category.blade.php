@extends('layouts.app')

@section('title', 'Category - Eduport LMS Education & Course Theme')

@section('content')
<!-- =======================
Page Banner START -->
<section class="py-4">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="bg-light p-4 text-center rounded-3">
                    <h1 class="m-0">{{ ucfirst($slug) }} Courses</h1>
                    <!-- Breadcrumb -->
                    <div class="d-flex justify-content-center">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb breadcrumb-dots mb-0">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                                <li class="breadcrumb-item"><a href="#">Courses</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{ ucfirst($slug) }}</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- =======================
Page Banner END -->

<!-- =======================
Page content START -->
<section class="pt-0">
    <div class="container">
        <div class="row mt-3">
            <!-- Main content START -->
            <div class="col-12">

                <!-- Search and select START -->
                <div class="row g-3 align-items-center justify-content-between mb-4">
                    <!-- Content -->
                    <div class="col-md-8">
                        <form class="rounded position-relative">
                            <input class="form-control pe-5 bg-transparent" type="search" placeholder="Search courses" aria-label="Search">
                            <button class="btn bg-transparent px-2 py-0 position-absolute top-50 end-0 translate-middle-y" type="submit"><i class="fas fa-search fs-6 "></i></button>
                        </form>
                    </div>

                    <!-- Select option -->
                    <div class="col-md-3">
                        <form>
                            <select class="form-select js-choice border-0 z-index-9" aria-label=".form-select-sm">
                                <option value="">Sort by</option>
                                <option>Newest</option>
                                <option>Most Popular</option>
                                <option>Most Viewed</option>
                            </select>
                        </form>
                    </div>
                </div>
                <!-- Search and select END -->

                <!-- Course Grid START -->
                <div class="row g-4">
                    <!-- Card item START -->
                    <div class="col-sm-6 col-lg-4 col-xl-3">
                        <div class="card shadow h-100">
                            <!-- Image -->
                            <img src="{{ asset('assets/images/courses/4by3/01.jpg') }}" class="card-img-top" alt="course image">
                            <!-- Card body -->
                            <div class="card-body pb-0">
                                <!-- Badge and favorite -->
                                <div class="d-flex justify-content-between mb-2">
                                    <a href="#" class="badge bg-success bg-opacity-10 text-success">Beginner</a>
                                    <a href="#" class="h6 fw-light mb-0"><i class="far fa-heart"></i></a>
                                </div>
                                <!-- Title -->
                                <h5 class="card-title"><a href="#">The Complete Digital Marketing Course</a></h5>
                                <!-- Rating -->
                                <div class="d-flex justify-content-between mb-2">
                                    <div class="rating">
                                        <i class="fas fa-star text-warning"></i>
                                        <i class="fas fa-star text-warning"></i>
                                        <i class="fas fa-star text-warning"></i>
                                        <i class="fas fa-star text-warning"></i>
                                        <i class="far fa-star text-warning"></i>
                                        <span class="ms-2">4.0/5.0</span>
                                    </div>
                                </div>
                                <!-- Price -->
                                <div class="hstack gap-2">
                                    <span class="h5 mb-0">$129</span>
                                    <span class="h6 mb-0 text-decoration-line-through">$150</span>
                                </div>
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

                    <!-- More course items can be added here -->

                </div>
                <!-- Course Grid END -->

                <!-- Pagination START -->
                <div class="col-12">
                    <nav class="mt-4 d-flex justify-content-center" aria-label="navigation">
                        <ul class="pagination pagination-primary-soft rounded mb-0">
                            <li class="page-item mb-0"><a class="page-link" href="#" tabindex="-1"><i class="fas fa-angle-double-left"></i></a></li>
                            <li class="page-item mb-0"><a class="page-link" href="#">1</a></li>
                            <li class="page-item mb-0 active"><a class="page-link" href="#">2</a></li>
                            <li class="page-item mb-0"><a class="page-link" href="#">3</a></li>
                            <li class="page-item mb-0"><a class="page-link" href="#"><i class="fas fa-angle-double-right"></i></a></li>
                        </ul>
                    </nav>
                </div>
                <!-- Pagination END -->
            </div>
            <!-- Main content END -->
        </div><!-- Row END -->
    </div>
</section>
<!-- =======================
Page content END -->
@endsection
