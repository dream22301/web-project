<?php

use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\StudentScheduleController;
use Illuminate\Support\Facades\Route;

// ─── GUEST ROUTES ──────────────────────────────────────────────────────────
Route::get('/login', function () { return view('auth.login'); })->name('login');
Route::get('/', function () { return view('auth.login'); });
Route::get('/register', function () { return view('auth.register'); });

Route::post('/register', [AuthController::class, 'register_process'])->name('regist');
Route::post('/login', [AuthController::class, 'login_process'])->name('log-in');


// ─── AUTHENTICATED ROUTES (For Everyone) ───────────────────────────────────
Route::middleware('auth')->group(function () {
    
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Announcements (General View/Edit)
    Route::get('/announcement', [AnnouncementController::class, 'pengumuman'])->name('announcement.index');
    Route::get('/announcement/{id}/edit', [AnnouncementController::class, 'edit'])->name('announcement.edit');
    Route::put('/announcement/{id}', [AnnouncementController::class, 'update'])->name('announcement.update');

    // History
    Route::get('/history', [HistoryController::class, 'index'])->name('history.index');

    // Settings
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings');
    Route::post('/settings/profile', [SettingsController::class, 'updateProfile'])->name('settings.profile');
    Route::post('/settings/password', [SettingsController::class, 'updatePassword'])->name('settings.password');
    
    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


    // ─── EXCLUSIVE ROUTES (Only for users who pass the Gate) ───────────────
    Route::middleware('can:view-exclusive-page')->group(function () {
        
        // Schedule
        Route::get('/schedule', [ScheduleController::class, 'create']);
        Route::post('/schedule', [ScheduleController::class, 'create_process'])->name('schedule-create');
        Route::get('/schedule/{id}/edit', [ScheduleController::class, 'edit'])->name('schedule.edit');
        Route::put('/schedule/{id}', [ScheduleController::class, 'update'])->name('schedule.update');
        Route::delete('/schedule/{id}', [ScheduleController::class, 'destroy'])->name('schedule.destroy');

        // Student Schedule
        Route::get('/student-schedule', [StudentScheduleController::class, 'index'])->name('student-schedule.index');
        Route::post('/student-schedule', [StudentScheduleController::class, 'store'])->name('student-schedule.store');
        Route::get('/student-schedule/{id}/edit', [StudentScheduleController::class, 'edit'])->name('student-schedule.edit');
        Route::put('/student-schedule/{id}', [StudentScheduleController::class, 'update'])->name('student-schedule.update');
        Route::delete('/student-schedule/{id}', [StudentScheduleController::class, 'destroy'])->name('student-schedule.destroy');

        // Questions
        Route::get('/questions', [QuestionController::class, 'index'])->name('questions.index');
        Route::post('/questions', [QuestionController::class, 'store'])->name('questions.store');
        Route::get('/questions/{id}', [QuestionController::class, 'show'])->name('questions.show');
        Route::put('/questions/{id}', [QuestionController::class, 'update'])->name('questions.update');
        Route::post('/questions/{id}/questions', [QuestionController::class, 'addQuestion'])->name('questions.addQuestion');
        Route::put('/questions/{id}/questions/{qid}', [QuestionController::class, 'updateQuestion'])->name('questions.updateQuestion');
        Route::delete('/questions/{id}/questions/{qid}', [QuestionController::class, 'destroyQuestion'])->name('questions.destroyQuestion');
        Route::delete('/questions/{id}', [QuestionController::class, 'destroy'])->name('questions.destroy');

    });
});

// ─── SUPERADMIN / ADMIN ROUTES ─────────────────────────────────────────────

Route::middleware(['auth', 'role:superadmin,admin'])->group(function () {
    Route::resource('student', StudentController::class)->only(['index', 'store', 'destroy']);
    Route::post('/announcement', [AnnouncementController::class, 'database1'])->name('announcement.database1');
    Route::delete('/announcement/{id}', [AnnouncementController::class, 'destroy'])->name('announcement.destroy');
});