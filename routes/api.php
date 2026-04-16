<?php

use App\Http\Controllers\Api\ScheduleController;
use App\Http\Controllers\Api\StudentScheduleController;
use App\Models\Announcement;
use App\Models\Schedule;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AnnouncementController;

Route::get('announcements', [AnnouncementController::class, 'index']);
Route::get('/test', function() {
    return Announcement::latest()->get();
});

Route::get('schedule', [ScheduleController::class, 'index']);

// Student schedules — filtered by the student's own class_major
Route::post('student-schedule', [StudentScheduleController::class, 'index']);

