<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LocaleController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\Auth\AuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Language Switch Route
Route::get('language/{locale}', [LocaleController::class, 'switchLocale'])->name('locale.switch');

// Guest Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

// Authenticated Routes
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/my-learnings', [CourseController::class, 'myLearnings'])->name('my-learnings');
    Route::get('/courses/{registration}/certificate', [CourseController::class, 'downloadCertificate'])->name('courses.certificate.download');
    Route::get('/courses/{registration}/invoice', [CourseController::class, 'downloadInvoice'])->name('courses.invoice.download');
});

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/contact', function () {
    return view('pages.contact');
})->name('contact');
Route::get('/categories/{slug}', function ($slug) {
    return view('pages.category', compact('slug'));
})->name('category.show');

// Course Routes
Route::prefix('courses')->name('courses.')->group(function () {
    Route::get('/', [CourseController::class, 'index'])->name('index');
    Route::get('/{course}', [CourseController::class, 'show'])->name('show');

    // Protected Course Routes
    Route::middleware('auth')->group(function () {
        Route::get('/{course}/register', [CourseController::class, 'showRegistrationForm'])->name('register.form');
        Route::post('/{course}/register', [CourseController::class, 'register'])->name('register');
        Route::get('/registration/{registration}/confirmation', [CourseController::class, 'showConfirmation'])->name('registration.confirmation');
    });
});
    // Route::post('/courses/{id}/register', [CourseController::class, 'register'])->name('course.register');
// });
