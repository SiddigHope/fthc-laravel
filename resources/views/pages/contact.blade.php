@extends('layouts.app')

@section('title', 'Contact Us - Eduport LMS Education & Course Theme')

@section('content')
<!-- =======================
Contact intro START -->
<section class="py-5">
    <div class="container">
        <div class="row position-relative">
            <!-- SVG decoration -->
            <figure class="position-absolute top-0 start-0 d-none d-sm-block">
                <svg width="22px" height="22px" viewBox="0 0 22 22">
                    <polygon class="fill-purple" points="22,8.3 13.7,8.3 13.7,0 8.3,0 8.3,8.3 0,8.3 0,13.7 8.3,13.7 8.3,22 13.7,22 13.7,13.7 22,13.7 "/>
                </svg>
            </figure>

            <!-- Title and breadcrumb -->
            <div class="col-lg-10 mx-auto text-center position-relative">
                <!-- Title -->
                <h1 class="mb-3">We're here to help!</h1>
                <p class="mb-0">Get in touch and let us know how we can help. We'll help you find the right solution for your needs.</p>
            </div>
        </div>
    </div>
</section>
<!-- =======================
Contact intro END -->

<!-- =======================
Contact info START -->
<section class="py-0 py-xl-5">
    <div class="container">
        <div class="row g-4 justify-content-between">
            <!-- Contact item -->
            <div class="col-lg-4">
                <div class="card card-body shadow p-4 h-100">
                    <!-- Icon -->
                    <div class="icon-lg bg-success bg-opacity-10 text-success rounded-circle mb-4"><i class="bi bi-headset fs-5"></i></div>
                    <!-- Title -->
                    <h5 class="mb-2">Contact Support</h5>
                    <p class="mb-4">Please contact us using the information below. For additional information please visit our FAQ.</p>
                    <!-- Contact -->
                    <ul class="list-group list-group-borderless mb-0">
                        <li class="list-group-item"><i class="bi bi-telephone text-success me-2"></i>Call us: +123 456 789</li>
                        <li class="list-group-item"><i class="bi bi-envelope text-success me-2"></i>Email: example@email.com</li>
                        <li class="list-group-item"><i class="bi bi-geo-alt text-success me-2"></i>Address: 2492 Centennial NW, Acworth, GA, 30102</li>
                    </ul>
                </div>
            </div>

            <!-- Contact form START -->
            <div class="col-lg-8">
                <div class="card card-body shadow p-4">
                    <!-- Title -->
                    <h4 class="mb-4">Send us a message</h4>
                    <!-- Form START -->
                    <form class="row g-3">
                        <!-- Name -->
                        <div class="col-md-6">
                            <label class="form-label">Your name *</label>
                            <input type="text" class="form-control" aria-label="First name" placeholder="Name">
                        </div>
                        <!-- Email -->
                        <div class="col-md-6">
                            <label class="form-label">Email address *</label>
                            <input type="email" class="form-control" placeholder="Email">
                        </div>
                        <!-- Subject -->
                        <div class="col-12">
                            <label class="form-label">Subject *</label>
                            <input type="text" class="form-control" placeholder="Subject">
                        </div>
                        <!-- Message -->
                        <div class="col-12">
                            <label class="form-label">Your message *</label>
                            <textarea class="form-control" rows="3" placeholder="Your message"></textarea>
                        </div>
                        <!-- Button -->
                        <div class="col-12">
                            <button class="btn btn-primary mb-0" type="submit">Send message</button>
                        </div>
                    </form>
                    <!-- Form END -->
                </div>
            </div>
            <!-- Contact form END -->
        </div>
    </div>
</section>
<!-- =======================
Contact info END -->

<!-- =======================
Map START -->
<section class="pt-0">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <iframe class="w-100 h-400px grayscale rounded" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3022.9663095343008!2d-74.00425878428698!3d40.74076684379132!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c259bf5c1654f3%3A0xc80f9cfce5383d5d!2sGoogle!5e0!3m2!1sen!2sin!4v1586000412513!5m2!1sen!2sin" height="500" style="border:0;" aria-hidden="false" tabindex="0"></iframe>
            </div>
        </div>
    </div>
</section>
<!-- =======================
Map END -->
@endsection
