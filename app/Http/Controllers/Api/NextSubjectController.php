<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use App\Models\Student;
use App\Models\StudentSchedule;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class NextSubjectController extends Controller
{
    /**
     * Return the student's next upcoming subject for today.
     *
     * Cross-references Jadwal Siswa (StudentSchedule) with Jadwal Mengajar (Schedule):
     * - Finds the student's class_major from their NIS + password.
     * - Gets today's StudentSchedule entries for that class.
     * - Gets today's Schedule (teacher) entries for that class.
     * - Matches entries by subject name.
     * - Returns the first matched entry whose teacher start_time is still in the future.
     *
     * GET /api/mobile/next-subject?nis=…&password=…
     *
     * Success 200:
     *   { next_subject: { subject, room, start_time, end_time, period_start, period_end } }
     *   or { next_subject: null, message: "Tidak ada lagi kelas hari ini." }
     * Error 401: { message: "NIS atau password salah." }
     */
    public function index(Request $request)
    {
        $validated = $request->validate([
            'nis'      => 'required|string',
            'password' => 'required|string',
        ]);

        // ── 1. Authenticate ───────────────────────────────────────────────────
        $student = Student::where('nis', $validated['nis'])->first();

        if (! $student || ! Hash::check($validated['password'], $student->password)) {
            return response()->json(['message' => 'NIS atau password salah.'], 401);
        }

        $classMajor = $student->class_major;

        // ── 2. Get today's Indonesian day name ────────────────────────────────
        $dayMap = [
            1 => 'Senin',
            2 => 'Selasa',
            3 => 'Rabu',
            4 => 'Kamis',
            5 => 'Jumat',
            6 => 'Sabtu',
            0 => 'Minggu',
        ];
        $todayName = $dayMap[Carbon::now()->dayOfWeek] ?? null;

        if (! $todayName || in_array($todayName, ['Sabtu', 'Minggu'])) {
            return response()->json([
                'next_subject' => null,
                'message'      => 'Tidak ada kelas hari ini.',
            ]);
        }

        $now = Carbon::now();

        // ── 3. Fetch today's student schedules for this class ─────────────────
        $studentSchedules = StudentSchedule::where('class_major', $classMajor)
            ->where('day', $todayName)
            ->orderBy('period_start')
            ->get();

        // ── 4. Fetch today's teacher schedules (Jadwal Mengajar) for this class
        $teacherSchedules = Schedule::where('class', $classMajor)
            ->where('day', $todayName)
            ->orderBy('start_time')
            ->get()
            ->keyBy('subject'); // index by subject for O(1) lookup

        // ── 5. Cross-reference: find next upcoming subject ────────────────────
        foreach ($studentSchedules as $ss) {
            $matched = $teacherSchedules->get($ss->subject);

            if (! $matched) {
                continue; // no teacher scheduled for this subject today — skip
            }

            // Parse the teacher's start_time ("HH:MM" or "HH:MM:SS")
            $startTime = Carbon::createFromTimeString($matched->start_time);

            if ($startTime->gt($now)) {
                // This subject hasn't started yet — it's the next one
                return response()->json([
                    'next_subject' => [
                        'subject'      => $ss->subject,
                        'room'         => $ss->room,
                        'start_time'   => $matched->start_time,
                        'end_time'     => $matched->end_time,
                        'period_start' => $ss->period_start,
                        'period_end'   => $ss->period_end,
                    ],
                ]);
            }
        }

        return response()->json([
            'next_subject' => null,
            'message'      => 'Tidak ada lagi kelas hari ini.',
        ]);
    }
}
