<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AnnouncementController;

Route::get('announcements', [AnnouncementController::class, 'index']);