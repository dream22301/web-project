<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    /**
     * GET /api/mobile/announcements
     * Returns all announcements ordered by newest first.
     */
    public function index()
    {
        return response()->json(Announcement::latest()->get());
    }

    /**
     * GET /api/mobile/announcements/{id}
     * Returns a single announcement or 404.
     */
    public function show(int $id)
    {
        $announcement = Announcement::find($id);

        if (! $announcement) {
            return response()->json(['message' => 'Pengumuman tidak ditemukan.'], 404);
        }

        return response()->json($announcement);
    }
}
