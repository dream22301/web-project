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

        Schedule::create([
            'user_id' => auth()->id(),
            'subject' => $validate3['subject'],
            'class' => $validate3['class'],
            'day' => $validate3['day'],
            'start_time' => $validate3['start_time'],
            'end_time' => $validate3['end_time'],
        ]);

        return redirect()->back()->with('berhasil', 'Jadwal telah dibuat!');

    }

    public function create()
    {
        $schedules = Schedule::where('user_id', auth()->id())
        ->orderByRaw("FIELD(day, 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat')")
        ->orderBy('start_time')
        ->get();
        return view('schedule.create', compact('schedules'));
    }

    public function destroy($id)
    {
        $schedule = Schedule::where('user_id', auth()->id())->findOrFail($id);
        $schedule->delete();

        return redirect()->back()->with('success', 'Jadwal berhasil dihapus!');
    }
}
