<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Announcement;

class AnnouncementController extends Controller
{
    public function database1(Request $request) {
        $validate = $request->validate([
            'title' => 'required|string|min:5',
            'audience' => 'required|string',
            'prioritas' => 'required|integer|min:0|max:3',
            'content' => 'required|string|min:10',
            'publish_date' => 'nullable|date',
        ]);

        Announcement::create($validate);

        return redirect()->back()->with('success', 'Pengumuman telah dibuat!');
        
    }
    public function pengumuman(Request $request) {
        $query = Announcement::where('updated_at', '>=', \Carbon\Carbon::now()->subWeek())->latest();
        
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%");
            });
        }
        
        $announcements = $query->paginate(5)->withQueryString()->fragment('announcement-list');
        
        $history = Announcement::where('updated_at', '<', \Carbon\Carbon::now()->subWeek())
                               ->latest('updated_at')
                               ->take(50)
                               ->get();
                               
        return view('announcement', compact('announcements', 'history'));
    }

    public function edit($id) {
        $announcement = Announcement::findOrFail($id);
        return view('announcement.edit', compact('announcement'));
    }

    public function update(Request $request, $id) {
        $validate = $request->validate([
            'title' => 'required|string|min:5',
            'audience' => 'required|string',
            'prioritas' => 'required|integer|min:0|max:3',
            'content' => 'required|string|min:10',
            'publish_date' => 'nullable|date',
        ]);

        $announcement = Announcement::findOrFail($id);
        $announcement->update($validate);

        return redirect()->back()->with('success', 'Pengumuman telah diperbarui dan dikembalikan ke daftar aktif!');
    }

    public function destroy($id) {
        Announcement::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Pengumuman telah dihapus!');
    }
}
