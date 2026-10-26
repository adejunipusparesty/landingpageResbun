<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AppointmentController;
use App\Http\Controllers\Admin\DoctorController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\FacilityController;
use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\GalleryController;

/*
|--------------------------------------------------------------------------
| Web Routes - RSIA Restu Bunda
|--------------------------------------------------------------------------
*/

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/tentang-kami', [HomeController::class, 'about'])->name('about');
Route::get('/galeri', [HomeController::class, 'gallery'])->name('gallery');
Route::post('/booking', [HomeController::class, 'bookAppointment'])->name('booking.store');
Route::get('/cek-jadwal', [HomeController::class, 'checkBooking'])->name('booking.check');
Route::get('/dokter/{id}', [HomeController::class, 'doctorDetail'])->name('doctor.detail');
Route::get('/artikel/{slug}', [HomeController::class, 'articleDetail'])->name('article.detail');

// Auth Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Admin Routes
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::get('/', function () {
        return redirect()->route('admin.dashboard');
    });
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Appointments
    Route::get('/appointments', [AppointmentController::class, 'index'])->name('appointments.index');
    Route::post('/appointments', [AppointmentController::class, 'store'])->name('appointments.store');
    Route::get('/appointments/{appointment}', [AppointmentController::class, 'show'])->name('appointments.show');
    Route::patch('/appointments/{appointment}/status', [AppointmentController::class, 'updateStatus'])->name('appointments.status');
    Route::delete('/appointments/{appointment}', [AppointmentController::class, 'destroy'])->name('appointments.destroy');

    // Doctors Reorder & CRUD
    Route::post('doctors/reorder', [DoctorController::class, 'reorder'])->name('doctors.reorder');
    Route::resource('doctors', DoctorController::class);

    // Services CRUD
    Route::resource('services', ServiceController::class);

    // Facilities CRUD
    Route::resource('facilities', FacilityController::class);

    // Articles CRUD
    Route::resource('articles', ArticleController::class);

    // Testimonials CRUD
    Route::resource('testimonials', TestimonialController::class);
    Route::patch('/testimonials/{testimonial}/toggle-approval', [TestimonialController::class, 'toggleApproval'])->name('testimonials.toggle');

    // Tentang Kami & Jajaran Direksi
    Route::get('/about', [AboutController::class, 'index'])->name('about.index');
    Route::post('/about/info', [AboutController::class, 'updateInfo'])->name('about.info.update');
    Route::post('/about/directors', [AboutController::class, 'storeDirector'])->name('about.directors.store');
    Route::put('/about/directors/{director}', [AboutController::class, 'updateDirector'])->name('about.directors.update');
    Route::delete('/about/directors/{director}', [AboutController::class, 'destroyDirector'])->name('about.directors.destroy');

    // Galeri Foto Dokumentasi CRUD
    Route::patch('/galleries/{gallery}/toggle', [GalleryController::class, 'toggleStatus'])->name('galleries.toggle');
    Route::resource('galleries', GalleryController::class);

    // Settings
    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
    Route::post('/settings', [SettingController::class, 'update'])->name('settings.update');
});
