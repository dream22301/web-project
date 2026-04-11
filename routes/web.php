<?php

use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\SettingsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\StudentScheduleController;

Route::get('/login', function() { return view('auth.login'); })->name('login');

Route::get('/', function() {
    return view('auth.login');
});

Route::get('/register', function() {
    return view('auth.register');
});

Route::post('/register', [AuthController::class, 'register_process'])->name('regist');
Route::post('/login', [AuthController::class, 'login_process'])->name('log-in');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/schedule', [ScheduleController::class, 'create']);

Route::post('/schedule',[ScheduleController::class, 'create_process'])->name('schedule-create');
Route::get('/schedule/{id}/edit', [ScheduleController::class, 'edit'])->name('schedule.edit');
Route::put('/schedule/{id}', [ScheduleController::class, 'update'])->name('schedule.update');
Route::delete('/schedule/{id}',[ScheduleController::class, 'destroy'])->name('schedule.destroy');

// Student schedules
Route::get('/student-schedule', [StudentScheduleController::class, 'index'])->name('student-schedule.index');
Route::post('/student-schedule', [StudentScheduleController::class, 'store'])->name('student-schedule.store');
Route::get('/student-schedule/{id}/edit', [StudentScheduleController::class, 'edit'])->name('student-schedule.edit');
Route::put('/student-schedule/{id}', [StudentScheduleController::class, 'update'])->name('student-schedule.update');
Route::delete('/student-schedule/{id}', [StudentScheduleController::class, 'destroy'])->name('student-schedule.destroy');

Route::get('/announcement',[AnnouncementController::class, 'pengumuman'])->name('announcement.index');

Route::post('/announcement',[AnnouncementController::class, 'database1'])->name('announcement.database1');
Route::get('/announcement/{id}/edit',[AnnouncementController::class, 'edit'])->name('announcement.edit');
Route::put('/announcement/{id}',[AnnouncementController::class, 'update'])->name('announcement.update');
Route::delete('/announcement/{id}',[AnnouncementController::class, 'destroy'])->name('announcement.destroy');

// History
Route::get('/history', [\App\Http\Controllers\HistoryController::class, 'index'])->name('history.index');

// Question sets
Route::get('/questions',[QuestionController::class, 'index'])->name('questions.index');
Route::post('/questions',[QuestionController::class, 'store'])->name('questions.store');
Route::get('/questions/{id}',[QuestionController::class, 'show'])->name('questions.show');
Route::post('/questions/{id}/questions',[QuestionController::class, 'addQuestion'])->name('questions.addQuestion');
Route::delete('/questions/{id}/questions/{qid}',[QuestionController::class, 'destroyQuestion'])->name('questions.destroyQuestion');
Route::delete('/questions/{id}',[QuestionController::class, 'destroy'])->name('questions.destroy');

// Settings & Logout
Route::get('/settings',[SettingsController::class, 'index'])->name('settings');
Route::post('/settings/profile',[SettingsController::class, 'updateProfile'])->name('settings.profile');
Route::post('/settings/password',[SettingsController::class, 'updatePassword'])->name('settings.password');
Route::post('/logout',[AuthController::class, 'logout'])->name('logout');
