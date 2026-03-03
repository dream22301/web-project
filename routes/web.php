<?php

use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ScheduleController;

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
Route::get('/announcement', [AnnouncementController::class, 'pengumuman']);

Route::post('/announcement', [AnnouncementController::class, 'database1'])->name('announcement.database1');
Route::delete('/announcement/{id}', [AnnouncementController::class, 'destroy'])->name('announcement.destroy');

