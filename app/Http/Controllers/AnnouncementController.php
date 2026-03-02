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
    public function pengumuman() {
        $announcements = Announcement::latest()->get();
        return view('announcement', compact('announcements'));
    }

    public function destroy($id) {
        Announcement::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Pengumuman telah dihapus!');
    }

}
