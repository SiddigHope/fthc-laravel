<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LocaleController;

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

// Home Routes
Route::get('/', function () {
    return view('pages.home');
})->name('home');

// About Routes
Route::get('/about', function () {
    return view('pages.about');
})->name('about');

// Contact Routes
Route::get('/contact', function () {
    return view('pages.contact');
})->name('contact');

// Category Routes
Route::get('/categories/{slug}', function ($slug) {
    return view('pages.category', compact('slug'));
})->name('category.show');
