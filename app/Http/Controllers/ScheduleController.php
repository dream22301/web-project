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
        return view('schedule.create');
    }
}
