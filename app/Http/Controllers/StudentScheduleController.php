<?php

namespace App\Http\Controllers;

use App\Models\StudentSchedule;
use Illuminate\Http\Request;

class StudentScheduleController extends Controller
{
    public function index()
    {
        $dayOrder = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];

        $schedules = StudentSchedule::all()
            ->sortBy(fn($s) => [array_search($s->day, $dayOrder), $s->period_start])
            ->groupBy('day');

        return view('student-schedule.index', compact('schedules'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'day'          => 'required|string',
            'subject'      => 'required|string',
            'room'         => 'required|string',
            'period_start' => 'required|integer|min:1',
            'period_end'   => 'required|integer|min:1|gte:period_start',
        ]);

        StudentSchedule::create($validated);

        return redirect()->back()->with('success', 'Jadwal siswa berhasil ditambahkan!');
    }

    public function destroy($id)
    {
        StudentSchedule::findOrFail($id)->delete();

        return redirect()->back()->with('success', 'Jadwal siswa berhasil dihapus!');
    }
}
