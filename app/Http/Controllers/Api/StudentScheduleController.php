<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use App\Models\Student;
use App\Models\StudentSchedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StudentScheduleController extends Controller
{
    /**
     * Return the student's full weekly schedule enriched with actual HH:MM times
     * from the teacher's Schedule (Jadwal Mengajar) by cross-referencing day+subject.
     *
     * GET /api/mobile/student-schedule?nis=…&password=…
     */
    public function index(Request $request)
    {
        $validated = $request->validate([
            'nis'      => 'required|string',
            'password' => 'required|string',
        ]);

        // ── Authenticate ──────────────────────────────────────────────────────
        $student = Student::where('nis', $validated['nis'])->first();

        if (! $student || ! Hash::check($validated['password'], $student->password)) {
            return response()->json(['message' => 'NIS atau password salah.'], 401);
        }

        $classMajor = $student->class_major;

        // ── Fetch student schedules ───────────────────────────────────────────
        $studentSchedules = StudentSchedule::where('class_major', $classMajor)
            ->orderByRaw("FIELD(day, 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat')")
            ->orderBy('period_start')
            ->get();

        // ── Cross-reference with teacher schedule for actual HH:MM times ─────
        // Group by "day||subject" for O(1) lookup
        $teacherMap = Schedule::where('class', $classMajor)
            ->get()
            ->groupBy(fn ($s) => $s->day . '||' . $s->subject);

        $result = $studentSchedules->map(function ($ss) use ($teacherMap) {
            $key     = $ss->day . '||' . $ss->subject;
            $teacher = $teacherMap->get($key)?->first();

            return [
                'id'           => $ss->id,
                'day'          => $ss->day,
                'subject'      => $ss->subject,
                'room'         => $ss->room,
                'class_major'  => $ss->class_major,
                // Always return as string so Flutter can safely cast
                'period_start' => (string) $ss->period_start,
                'period_end'   => (string) $ss->period_end,
                // Actual clock times from teacher schedule (null if no match)
                'start_time'   => $teacher?->start_time ?? null,
                'end_time'     => $teacher?->end_time   ?? null,
            ];
        });

        return response()->json([
            'student' => [
                'name'        => $student->name,
                'nis'         => $student->nis,
                'class_major' => $student->class_major,
            ],
            'schedules' => $result,
        ]);
    }
}
