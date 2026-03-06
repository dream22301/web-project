<?php

use App\Models\Announcement;
use App\Models\Schedule;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AnnouncementController;

Route::get('announcements', [AnnouncementController::class, 'index']);
Route::get('/test', function() {
    return Announcement::latest()->get();
});

Route::get('schedule', function() {
    return response()->json(Schedule::latest()->get());
});

