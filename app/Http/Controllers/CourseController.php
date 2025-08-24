<?php
namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Country;
use App\Models\Specialization;
use App\Models\CourseType;
use App\Models\CourseRegistration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CourseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(['register', 'showRegistrationForm']);
    }

    public function index(Request $request)
    {
        $query = Course::with(['type', 'specialization', 'subSpecialization', 'inPersonDetails'])
            ->where('crsStatus', true);

        // Apply type filter
        if ($request->filled('type')) {
            $query->where('typId', $request->type);
        }

        // Apply specialization filter
        if ($request->filled('specialization')) {
            $query->where('spcId', $request->specialization);
        }

        // Apply sorting
        switch ($request->get('sort', 'latest')) {
            case 'oldest':
                $query->orderBy('created_at', 'asc');
                break;
            case 'price_low':
                $query->orderBy('crsPrice', 'asc');
                break;
            case 'price_high':
                $query->orderBy('crsPrice', 'desc');
                break;
            case 'latest':
            default:
                $query->orderBy('created_at', 'desc');
                break;
        }

        $courses = $query->paginate(12);
        $courseTypes = CourseType::orderBy('typName_en')->get();
        $specializations = Specialization::orderBy('spcNameEn')->get();

        return view('pages.courses', compact('courses', 'courseTypes', 'specializations'));
    }

    public function show(Course $course)
    {
        $course->load(['type', 'specialization', 'subSpecialization', 'inPersonDetails']);
        return view('pages.course-detail', compact('course'));
    }

    public function showRegistrationForm(Course $course)
    {
        $user = Auth::user();
        $trainee = $user->traineeProfile;

        // Check if trainee specialization matches course specialization
        if ($trainee->spcId != $course->spcId) {
            return back()->with('error', __('messages.specialization_mismatch'));
        }

        // Check if already registered
        $existingRegistration = CourseRegistration::where('trnId', $trainee->trnId)
            ->where('crsId', $course->crsId)
            ->first();

        if ($existingRegistration) {
            return back()->with('error', __('messages.already_registered'));
        }

        // Get the trainee's country
        $country = Country::find($trainee->cntId);

        return view('pages.course-registration', compact('course', 'trainee', 'country'));
    }

    public function register(Request $request, Course $course)
    {
        $user = Auth::user();
        $trainee = $user->traineeProfile;

        // Check if trainee specialization matches course specialization
        if ($trainee->spcId != $course->spcId) {
            return back()->with('error', __('messages.specialization_mismatch'));
        }

        // Check if already registered
        $existingRegistration = CourseRegistration::where('usrId', $trainee->user->usrId)
            ->where('crsId', $course->crsId)
            ->first();

        if ($existingRegistration) {
            return back()->with('error', __('messages.already_registered'));
        }

        // Validate the request
        $validator = Validator::make($request->all(), [
            'regPayMethod' => 'required|in:bank,online',
            'regRemarks' => 'nullable|string|max:500',
            'terms' => 'required|accepted'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Create registration record
        $registration = CourseRegistration::create([
            'usrId' => $trainee->user->usrId,
            'crsId' => $course->crsId,
            'regPayMethod' => $request->regPayMethod,
            'regRemarks' => $request->regRemarks,
            'regFinalAmount' => $course->crsPrice,
            'regCreatedBy' => $trainee->user->usrId,
            'regStatus' => 1, // Initial status
            'regAmount' => $course->crsPrice,
            'regDate' => now(),
        ]);

        return redirect()->route('courses.registration.confirmation', $registration->regId)
            ->with('success', __('messages.registration_submitted'));
    }

    public function showConfirmation(CourseRegistration $registration)
    {
        // Load relationships
        $registration->load(['course', 'trainee']);

        // Check if the registration belongs to the current user
        if ($registration->trainee->trnId !== Auth::user()->traineeProfile->trnId) {
            abort(403);
        }

        return view('pages.course-registration-confirmation', compact('registration'));
    }

    public function myLearnings()
    {
        $trainee = Auth::user()->traineeProfile;

        $registrations = CourseRegistration::where('usrId', $trainee->user->usrId)
            ->with(['course' => function ($query) {
                $query->with(['type', 'specialization', 'inPersonDetails']);
            }])
            ->get();

        $now = now();

        // Group courses by status
        $completedCourses = $registrations->filter(function ($reg) use ($now) {
            return $reg->course->inPersonDetails &&
                   $reg->regStatus === 1 &&
                   $now > $reg->course->inPersonDetails->lctDateEnd;
        });

        $inProgressCourses = $registrations->filter(function ($reg) use ($now) {
            return $reg->course->inPersonDetails &&
                   $reg->regStatus === 1 &&
                   $now >= $reg->course->inPersonDetails->lctDateStart &&
                   $now <= $reg->course->inPersonDetails->lctDateEnd;
        });

        $upcomingCourses = $registrations->filter(function ($reg) use ($now) {
            return $reg->course->inPersonDetails &&
                   $reg->regStatus === 1 &&
                   $now < $reg->course->inPersonDetails->lctDateStart;
        });

        $pendingCourses = $registrations->filter(function ($reg) {
            return $reg->regStatus === 1;
        });

        return view('pages.my-learnings', compact(
            'completedCourses',
            'inProgressCourses',
            'upcomingCourses',
            'pendingCourses'
        ));
    }

    public function downloadCertificate(CourseRegistration $registration)
    {
        // Ensure the registration belongs to the user
        if ($registration->trainee->trnId !== Auth::user()->traineeProfile->trnId) {
            abort(403);
        }

        // Ensure the course is completed and registration is approved
        if ($registration->regStatus !== 'approved' ||
            !$registration->course->inPersonDetails ||
            now() <= $registration->course->inPersonDetails->lctDateEnd) {
            abort(403, __('messages.certificate_not_available'));
        }

        // TODO: Generate or fetch certificate
        // For now, we'll return a placeholder response
        return response()->json(['message' => 'Certificate download feature coming soon']);
    }

    public function downloadInvoice(CourseRegistration $registration)
    {
        // Ensure the registration belongs to the user
        if ($registration->trainee->trnId !== Auth::user()->traineeProfile->trnId) {
            abort(403);
        }

        // TODO: Generate or fetch invoice
        // For now, we'll return a placeholder response
        return response()->json(['message' => 'Invoice download feature coming soon']);
    }}
