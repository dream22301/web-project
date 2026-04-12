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

    public function create(Request $request)
    {
        $query = Schedule::where('user_id', auth()->id())
            ->where('updated_at', '>=', \Carbon\Carbon::now()->subWeek());
            
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('subject', 'like', "%{$search}%")
                  ->orWhere('class', 'like', "%{$search}%");
            });
        }
        
        $schedules = $query->orderByRaw("FIELD(day, 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat')")
            ->orderBy('start_time')
            ->paginate(30)->withQueryString();
        
        $history = Schedule::where('user_id', auth()->id())
            ->where('updated_at', '<', \Carbon\Carbon::now()->subWeek())
            ->latest('updated_at')
            ->take(50)
            ->get()
            ->groupBy('day');
            
        return view('schedule.create', compact('schedules', 'history'));
    }

    public function edit($id)
    {
        $schedule = Schedule::where('user_id', auth()->id())->findOrFail($id);
        return view('schedule.edit', compact('schedule'));
    }

    public function update(Request $request, $id)
    {
        $validate3 = $request->validate([
            'subject' => 'required',
            'class' => 'required',
            'day' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
        ]);

        $schedule = Schedule::where('user_id', auth()->id())->findOrFail($id);
        $schedule->update([
            'subject' => $validate3['subject'],
            'class' => $validate3['class'],
            'day' => $validate3['day'],
            'start_time' => $validate3['start_time'],
            'end_time' => $validate3['end_time'],
        ]);

        return redirect()->back()->with('success', 'Jadwal telah diperbarui dan dikembalikan ke daftar aktif!');
    }

    public function destroy($id)
    {
        $schedule = Schedule::where('user_id', auth()->id())->findOrFail($id);
        $schedule->delete();

        return redirect()->back()->with('success', 'Jadwal berhasil dihapus!');
    }
}
