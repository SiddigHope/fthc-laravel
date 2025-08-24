<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Trainee;
use App\Models\Lecturer;
use App\Models\CourseRegistration;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        $stats = [
            'totalCourses' => Course::count(),
            'totalTrainees' => Trainee::count(),
            'totalInstructors' => Lecturer::count(),
            'totalRegistrations' => CourseRegistration::count(),
        ];

        return view('pages.about', compact('stats'));
    }
}
