<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    /**
     * GET /api/mobile/announcements
     * Returns all announcements ordered by newest first, filtered by target and not in history.
     */
    public function index(Request $request)
    {
        $query = Announcement::latest()
            ->where('updated_at', '>=', now()->subWeek());

        if ($classMajor = $request->query('class_major')) {
            $query->where(function ($q) use ($classMajor) {
                $q->where('audience', 'all');
                
                if (str_starts_with($classMajor, 'XII ')) {
                    $q->orWhere('audience', 'xii');
                } elseif (str_starts_with($classMajor, 'XI ')) {
                    $q->orWhere('audience', 'xi');
                } elseif (str_starts_with($classMajor, 'X ')) {
                    $q->orWhere('audience', 'x');
                }
            });
        }

        return response()->json($query->get());
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
