<?php

use App\Http\Controllers\Api\AnnouncementController;
use App\Http\Controllers\Api\NextSubjectController;
use App\Http\Controllers\Api\QuestionController;
use App\Http\Controllers\Api\ScheduleController;
use App\Http\Controllers\Api\StudentAuthController;
use App\Http\Controllers\Api\StudentProfileController;
use App\Http\Controllers\Api\StudentScheduleController;
use App\Models\Announcement;
use Illuminate\Support\Facades\Route;

// ──────────────────────────────────────────────────────────────────────────────
// PUBLIC MOBILE ROUTES  (no Sanctum — used by the Flutter student app)
// ──────────────────────────────────────────────────────────────────────────────
Route::prefix('mobile')->group(function () {
    // Student login: POST /api/mobile/student/login
    Route::post('student/login', [StudentAuthController::class, 'login']);

    // Student profile refresh: GET /api/mobile/student/profile?nis=…&password=…
    Route::get('student/profile', [StudentProfileController::class, 'show']);

    // Public announcements list: GET /api/mobile/announcements
    Route::get('announcements', [AnnouncementController::class, 'index']);

    // Single announcement detail: GET /api/mobile/announcements/{id}
    Route::get('announcements/{id}', [AnnouncementController::class, 'show']);

    // Student schedules: GET /api/mobile/student-schedule?nis=…&password=…
    Route::get('student-schedule', [StudentScheduleController::class, 'index']);

    // Next subject (cross-reference Jadwal Mengajar + Jadwal Siswa):
    // GET /api/mobile/next-subject?nis=…&password=…
    Route::get('next-subject', [NextSubjectController::class, 'index']);

    // Question sets list: GET /api/mobile/questions
    Route::get('questions', [QuestionController::class, 'index']);

    // Find question set by key code: GET /api/mobile/questions/key/{key_code}
    // ⚠ Must be declared BEFORE questions/{id} so Laravel doesn't treat "key" as an id.
    Route::get('questions/key/{key_code}', [QuestionController::class, 'findByKey']);

    // Single question set with all questions: GET /api/mobile/questions/{id}
    Route::get('questions/{id}', [QuestionController::class, 'show']);

    // Submit student score: POST /api/mobile/questions/{id}/score
    Route::post('questions/{id}/score', [QuestionController::class, 'submitScore']);
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
