<?php

use App\Http\Controllers\AnnouncementController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ScheduleController;

Route::get('/', [DashboardController::class, 'index']);
Route::get('/schedule', [ScheduleController::class, 'create']);
Route::get('/announcement', [AnnouncementController::class, 'pengumuman']);

Route::post('/announcement', [AnnouncementController::class, 'database1'])->name('announcement.database1');
