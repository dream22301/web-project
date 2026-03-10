<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function create_process(Request $request) {
        $validate3 = $request->validate([
            'subject' => 'required',
            'class' => 'required',
            'day' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
        ]);

        Schedule::create($validate3);

        return redirect()->back()->with('berhasil', 'Jadwal telah dibuat!');

    }

    public function create()
    {
        $schedules = Schedule::orderBy('day')->orderBy('start_time')->get();
        return view('schedule.create', compact('schedules'));
    }

    public function destroy($id)
    {
        $schedule = Schedule::findOrFail($id);
        $schedule->delete();

        return redirect()->back()->with('success', 'Jadwal berhasil dihapus!');
    }
}
