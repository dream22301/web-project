<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ScheduleController;

Route::get('/', [DashboardController::class, 'index']);
Route::get('/schedule', [ScheduleController::class, 'create']);
