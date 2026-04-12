<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = Student::latest()->get();
        return view('student.index', compact('students'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'nis' => 'required|string|max:255|unique:students,nis',
            'class_major' => 'required|string|max:255',
        ]);

        Student::create($validated);

        return redirect()->route('student.index')->with('success', 'Student registered successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        $student->delete();
        return redirect()->route('student.index')->with('success', 'Student deleted successfully.');
    }
}
