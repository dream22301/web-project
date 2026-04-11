<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\Schedule;
use App\Models\StudentSchedule;
use Illuminate\Http\Request;
use Carbon\Carbon;

class HistoryController extends Controller
{
    public function index()
    {
        $oneWeekAgo = Carbon::now()->subWeek();
        
        $announcements = Announcement::where('updated_at', '<', $oneWeekAgo)->latest('updated_at')->get();
        // Schedule is filtered by logged-in user
        $schedules = Schedule::where('user_id', auth()->id())
            ->where('updated_at', '<', $oneWeekAgo)
            ->latest('updated_at')
            ->get()
            ->groupBy('day');
            
        $studentSchedules = StudentSchedule::where('updated_at', '<', $oneWeekAgo)
            ->latest('updated_at')
            ->get()
            ->groupBy('day');

        return view('history.index', compact('announcements', 'schedules', 'studentSchedules'));
    }
}
