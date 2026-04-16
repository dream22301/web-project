<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\StudentSchedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StudentScheduleController extends Controller
{
    /**
     * Return the student schedules that match the authenticated student's class_major.
     *
     * The Flutter app sends the student's NIS + password as query params.
     * We verify the credentials, then return only schedules for that student's class.
     *
     * GET /api/student-schedule?nis=12345&password=secret
     */
    public function index(Request $request)
    {
        $validated = $request->validate([
            'nis' => 'required|string',
            'password' => 'required|string',
        ]);

        $nis = $validated['nis'];
        $password = $validated['password'];

        // Find student by NIS
        $student = Student::where('nis', $nis)->first();

        if (! $student || ! Hash::check($password, $student->password)) {
            return response()->json([
                'message' => 'NIS atau password salah.',
            ], 401);
        }

        // Fetch schedules for this student's class only
        $schedules = StudentSchedule::where('class_major', $student->class_major)
            ->orderByRaw("FIELD(day, 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat')")
            ->orderBy('period_start')
            ->get();

        return response()->json([
            'student' => [
                'name' => $student->name,
                'nis' => $student->nis,
                'class_major' => $student->class_major,
            ],
            'schedules' => $schedules,
        ]);
    }
}
