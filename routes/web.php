<?php

use App\Http\Controllers\Admin\AboutSectionController;
use App\Http\Controllers\Admin\BookingController;
use App\Http\Controllers\Admin\ContactEnquiryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DonationController;
use App\Http\Controllers\Admin\ImpactStoryController;
use App\Http\Controllers\Admin\NewsArticleController;
use App\Http\Controllers\Admin\PatientInfoController;
use App\Http\Controllers\Admin\ResearchPublicationController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\TeamMemberController;
use App\Http\Controllers\Admin\TrainingProgramController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/team', [PageController::class, 'team'])->name('team');
Route::get('/services', [PageController::class, 'services'])->name('services');
Route::get('/patient-information', [PageController::class, 'patientInformation'])->name('patient-information');
Route::get('/training', [PageController::class, 'training'])->name('training');
Route::get('/research', [PageController::class, 'research'])->name('research');
Route::get('/impact', [PageController::class, 'impact'])->name('impact');
Route::get('/support', [PageController::class, 'support'])->name('support');
Route::get('/news', [PageController::class, 'news'])->name('news');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::post('/contact', [PageController::class, 'submitContact'])->name('contact.submit');
Route::post('/support-enquiry', [PageController::class, 'submitSupportEnquiry'])->name('support.enquiry.submit');

// Admin dashboard (role-based: only admin roles can access)
Route::get('admin-dashboard/login', [LoginController::class, 'showLoginForm'])->name('admin-dashboard.login');
Route::post('admin-dashboard/login', [LoginController::class, 'login'])->name('admin-dashboard.login.attempt');
Route::post('admin-dashboard/logout', [LoginController::class, 'logout'])->name('admin-dashboard.logout')->middleware('auth');

Route::middleware(['auth', 'admin'])->prefix('admin-dashboard')->name('admin-dashboard.')->group(function (): void {
    Route::get('/', [DashboardController::class, 'index'])->name('index');

    Route::resource('about', AboutSectionController::class)->except('show')->parameters(['about' => 'about_section']);
    Route::middleware('permission:team.manage')->group(function (): void {
        Route::resource('team-members', TeamMemberController::class)->except('show');
    });
    Route::middleware('permission:services.manage')->group(function (): void {
        Route::resource('services', ServiceController::class)->except('show');
    });
    Route::resource('patient-info', PatientInfoController::class)->except('show')->parameters(['patient_info' => 'patient_info_block']);
    Route::resource('training', TrainingProgramController::class)->except('show');
    Route::resource('research', ResearchPublicationController::class)->except('show')->parameters(['research' => 'research_publication']);
    Route::resource('impact', ImpactStoryController::class)->except('show')->parameters(['impact' => 'impact_story']);
    Route::resource('donations', DonationController::class)->except('show');
    Route::middleware('permission:news.manage')->group(function (): void {
        Route::resource('news', NewsArticleController::class)->except('show');
    });
    Route::resource('enquiries', ContactEnquiryController::class)->only(['index', 'show', 'update', 'destroy']);
    Route::resource('bookings', BookingController::class)->except('show');
    Route::middleware('permission:users.manage')->group(function (): void {
        Route::get('users', [UserController::class, 'index'])->name('users.index');
        Route::put('users/{user}/role', [UserController::class, 'updateRole'])->name('users.update-role');
    });
});
