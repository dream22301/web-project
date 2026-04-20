<?php

use App\Http\Controllers\Api\AnnouncementController;
use App\Http\Controllers\Api\ScheduleController;
use App\Http\Controllers\Api\StudentScheduleController;
use App\Models\Announcement;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::get('announcements', [AnnouncementController::class, 'index']);
    Route::get('/test', function () {
        return Announcement::latest()->get();
    });

    Route::get('schedule', [ScheduleController::class, 'index']);

    // Student schedules — filtered by the student's own class_major
    Route::get('student-schedule', [StudentScheduleController::class, 'index']);
});
