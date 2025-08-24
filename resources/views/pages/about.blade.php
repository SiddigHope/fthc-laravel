@extends('layouts.app')

@section('title', __('messages.about_title'))

@section('content')
<x-ui.page-header
    :title="__('messages.about_title')"
    :subtitle="__('messages.about_description')"
    image="assets/images/element/about.svg"
    imageAlt="About FTHC"
/>

<section class="pt-5">
    <div class="container">
        <x-ui.feature-card
            type="icon"
            :items="[
                'bi bi-bullseye' => [
                    'title' => __('messages.our_mission'),
                    'description' => 'To provide exceptional healthcare training and professional development opportunities, fostering excellence in healthcare delivery across Saudi Arabia.'
                ],
                'bi bi-eye' => [
                    'title' => __('messages.our_vision'),
                    'description' => 'To be the leading healthcare training center in the region, recognized for innovation, excellence, and commitment to advancing healthcare education.'
                ],
                'bi bi-heart' => [
                    'title' => __('messages.our_values'),
                    'description' => '<ul class=\'list-unstyled mb-0 text-start\'>
                        <li class=\'mb-2\'><i class=\'fas fa-check text-primary me-2\'></i>Excellence</li>
                        <li class=\'mb-2\'><i class=\'fas fa-check text-primary me-2\'></i>Innovation</li>
                        <li class=\'mb-2\'><i class=\'fas fa-check text-primary me-2\'></i>Integrity</li>
                        <li class=\'mb-2\'><i class=\'fas fa-check text-primary me-2\'></i>Collaboration</li>
                        <li><i class=\'fas fa-check text-primary me-2\'></i>Patient-Centered</li>
                    </ul>'
                ]
            ]"
        />
    </div>
</section>

<section class="pt-5">
    <div class="container">
        <x-ui.stats-grid
            :stats="[
                'fas fa-graduation-cap' => [
                    'value' => $stats['totalCourses'] ?? 100,
                    'label' => __('messages.total_courses'),
                    'color' => 'warning'
                ],
                'fas fa-users' => [
                    'value' => $stats['totalTrainees'] ?? 1000,
                    'label' => __('messages.total_trainees'),
                    'color' => 'success'
                ],
                'fas fa-chalkboard-teacher' => [
                    'value' => $stats['totalInstructors'] ?? 50,
                    'label' => __('messages.total_instructors'),
                    'color' => 'info'
                ],
                'fas fa-certificate' => [
                    'value' => $stats['totalRegistrations'] ?? 2000,
                    'label' => __('messages.total_registrations'),
                    'color' => 'danger'
                ]
            ]"
        />
    </div>
</section>
@endsection
