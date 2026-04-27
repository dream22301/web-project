<?php

use App\Http\Controllers\Api\AnnouncementController;
use App\Http\Controllers\Api\ScheduleController;
use App\Http\Controllers\Api\StudentAuthController;
use App\Http\Controllers\Api\StudentScheduleController;
use App\Models\Announcement;
use Illuminate\Support\Facades\Route;

// ──────────────────────────────────────────────────────────────────────────────
// PUBLIC MOBILE ROUTES  (no Sanctum — used by the Flutter student app)
// ──────────────────────────────────────────────────────────────────────────────
Route::prefix('mobile')->group(function () {
    // Student login: POST /api/mobile/student/login
    Route::post('student/login', [StudentAuthController::class, 'login']);

    // Public announcements: GET /api/mobile/announcements
    Route::get('announcements', [AnnouncementController::class, 'index']);

    // Student schedules (validates NIS+password internally):
    // GET /api/mobile/student-schedule?nis=…&password=…
    Route::get('student-schedule', [StudentScheduleController::class, 'index']);
});

// ──────────────────────────────────────────────────────────────────────────────
// SANCTUM-PROTECTED ROUTES  (web dashboard / admin — unchanged)
// ──────────────────────────────────────────────────────────────────────────────
Route::middleware('auth:sanctum')->group(function () {
    Route::get('announcements', [AnnouncementController::class, 'index']);
    Route::get('/test', function () {
        return Announcement::latest()->get();
    });

    Route::get('schedule', [ScheduleController::class, 'index']);

    // Student schedules — filtered by the student's own class_major
    Route::get('student-schedule', [StudentScheduleController::class, 'index']);
});
