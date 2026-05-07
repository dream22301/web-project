<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StudentProfileController extends Controller
{
    /**
     * Return the authenticated student's profile data.
     *
     * GET /api/mobile/student/profile?nis=…&password=…
     *
     * Returns: { student: { name, nis, class_major } }
     * Errors:  401 { message: "NIS atau password salah." }
     */
    public function show(Request $request)
    {
        $validated = $request->validate([
            'nis'      => 'required|string',
            'password' => 'required|string',
        ]);

        $student = Student::where('nis', $validated['nis'])->first();

        if (! $student || ! Hash::check($validated['password'], $student->password)) {
            return response()->json([
                'message' => 'NIS atau password salah.',
            ], 401);
        }

        return response()->json([
            'student' => [
                'name'        => $student->name,
                'nis'         => $student->nis,
                'class_major' => $student->class_major,
            ],
        ]);
    }
}
