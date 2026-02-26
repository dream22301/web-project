<?php

use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ScheduleController;

Route::get('/', [DashboardController::class, 'index']);
Route::get('/schedule', [ScheduleController::class, 'create']);
Route::get('/announcement', [AnnouncementController::class, 'pengumuman']);

Route::post('/announcement', [AnnouncementController::class, 'database1'])->name('announcement.database1');

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::get('/register', [AuthController::class, 'register'])->name('register');
