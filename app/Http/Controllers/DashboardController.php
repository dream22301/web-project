<?php

namespace App\Http\Controllers;

use App\Models\QuestionSet;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Schedule;
use App\Models\Announcement;
use App\Models\Question;
use App\Models\User;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $totalSchedules = Schedule::where('user_id', auth()->id())->count();
        $totalAnnouncements = Announcement::count();
        $totalQuestions = QuestionSet::where('user_id',auth()->id())->count();
        $totalUsers = User::count();

        $days = [
            'Monday' => 'Senin',
            'Tuesday' => 'Selasa',
            'Wednesday' => 'Rabu',
            'Thursday' => 'Kamis',
            'Friday' => 'Jumat'
        ];

        $todayEnglish = now()->format('l');
        $today = $days[$todayEnglish] ?? null;

        $nowSchedules = collect();

        if ($today) {
        $nowSchedules = Schedule::where('user_id', auth()->id())
            ->where('day', $today)
            ->orderBy('start_time')
            ->get();
        }
        $todayAnnouncements = Announcement::whereDate('publish_date', Carbon::today())
            ->latest('publish_date')
            ->limit(5)
            ->get();

        return view('dashboard', compact('totalSchedules', 'totalAnnouncements', 'totalQuestions', 'totalUsers', 'nowSchedules', 'todayAnnouncements'));
    }
}
