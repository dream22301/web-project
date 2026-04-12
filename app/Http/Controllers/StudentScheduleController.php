<?php

namespace App\Http\Controllers;

use App\Models\StudentSchedule;
use Illuminate\Http\Request;

class StudentScheduleController extends Controller
{
    public function index(Request $request)
    {
        $dayOrder = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];

        $query = StudentSchedule::where('updated_at', '>=', \Carbon\Carbon::now()->subWeek());
        
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('subject', 'like', "%{$search}%")
                  ->orWhere('room', 'like', "%{$search}%");
            });
        }
            
        $schedules = $query->orderByRaw("FIELD(day, 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu')")
            ->orderBy('period_start')
            ->paginate(30)->withQueryString();
            
        $history = StudentSchedule::where('updated_at', '<', \Carbon\Carbon::now()->subWeek())
            ->latest('updated_at')
            ->take(50)
            ->get()
            ->groupBy('day');

        return view('student-schedule.index', compact('schedules', 'history'));
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

    public function edit($id)
    {
        $schedule = StudentSchedule::findOrFail($id);
        return view('student-schedule.edit', compact('schedule'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'day'          => 'required|string',
            'subject'      => 'required|string',
            'room'         => 'required|string',
            'period_start' => 'required|integer|min:1',
            'period_end'   => 'required|integer|min:1|gte:period_start',
        ]);

        $schedule = StudentSchedule::findOrFail($id);
        $schedule->update($validated);

        return redirect()->back()->with('success', 'Jadwal siswa telah diperbarui dan dikembalikan ke daftar aktif!');
    }

    public function destroy($id)
    {
        StudentSchedule::findOrFail($id)->delete();

        return redirect()->back()->with('success', 'Jadwal siswa berhasil dihapus!');
    }
}
