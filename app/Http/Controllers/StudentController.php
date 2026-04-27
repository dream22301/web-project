<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Student::latest();
        
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('nis', 'like', "%{$search}%")
                  ->orWhere('class_major', 'like', "%{$search}%");
            });
        }
        
        $students = $query->paginate(10)->withQueryString();
        
        return view('student.index', compact('students'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'nis'         => 'required|string|max:255|unique:students,nis',
            'class_major' => 'required|string|max:255',
            'password'    => 'required|string|min:6',
        ]);

        // The Student model has a setPasswordAttribute mutator that automatically hashes passwords.
        // Therefore, we just pass the plain validated password directly.
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
