<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StudentAuthController extends Controller
{
    /**
     * Authenticate a student via NIS + password.
     *
     * POST /api/student/login
     * Body: { "nis": "12345", "password": "secret" }
     *
     * Returns: { "student": { name, nis, class_major }, "message": "Login berhasil" }
     * Errors:  401 { "message": "NIS atau password salah." }
     */
    public function login(Request $request)
    {
        $validated = $request->validate([
            'nis' => 'required|string',
            'password' => 'required|string',
        ]);

        $student = Student::where('nis', $validated['nis'])->first();

        if (! $student || ! Hash::check($validated['password'], $student->password)) {
            return response()->json([
                'message' => 'NIS atau password salah.',
            ], 401);
        }

        return response()->json([
            'message' => 'Login berhasil',
            'student' => [
                'name'        => $student->name,
                'nis'         => $student->nis,
                'class_major' => $student->class_major,
            ],
        ]);
    }
}
