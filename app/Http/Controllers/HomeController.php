<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Trainee;
use App\Models\Lecturer;
use App\Models\Specialization;
use App\Models\CourseRegistration;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        // Get statistics
        $stats = [
            'courses' => [
                'icon' => 'fas fa-tv',
                'count' => Course::count(),
                'suffix' => 'K+',
                'label' => __('messages.counter_online_courses'),
                'color' => 'warning'
            ],
            'instructors' => [
                'icon' => 'fas fa-user-tie',
                'count' => Lecturer::count(),
                'suffix' => '+',
                'label' => __('messages.counter_expert_tutors'),
                'color' => 'blue'
            ],
            'trainees' => [
                'icon' => 'fas fa-user-graduate',
                'count' => Trainee::count(),
                'suffix' => 'K+',
                'label' => __('messages.counter_online_students'),
                'color' => 'purple'
            ],
            'certifiedCourses' => [
                'icon' => 'bi bi-patch-check-fill',
                'count' => Course::count(),
                'suffix' => 'K+',
                'label' => __('messages.counter_certified_courses'),
                'color' => 'info'
            ]
        ];

        // Get specializations with their courses
        $specializations = Specialization::with(['courses' => function($query) {
            $query->with(['type', 'specialization', 'inPersonDetails'])
                ->where('crsStatus', true)
                ->orderBy('created_at', 'desc')
                ->take(8);
        }])->get();

        // Get trending courses (most registered)
        $trendingCourses = Course::withCount('registrations')
            ->with(['type', 'specialization', 'inPersonDetails'])
            ->where('crsStatus', true)
            ->orderBy('registrations_count', 'desc')
            ->take(10)
            ->get();

        // Get featured courses
        $featuredCourses = Course::with(['type', 'specialization', 'inPersonDetails'])
            ->where('crsStatus', true)
            ->orderBy('created_at', 'desc')
            ->take(8)
            ->get();

        return view('pages.home', compact('stats', 'specializations', 'trendingCourses', 'featuredCourses'));
    }
}
