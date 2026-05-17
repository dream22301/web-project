<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $users = $query->latest()->paginate(10)->withQueryString();

        return view('users.index', compact('users'));
    }

    public function updateRole(Request $request, $id)
    {
        $validated = $request->validate([
            'role' => 'required|in:student,teacher,admin,superadmin',
        ]);

        $user = User::findOrFail($id);
        
        // Prevent users from changing their own role to something else to avoid locking themselves out
        if ($user->id === auth()->id()) {
            return redirect()->back()->with('error', 'Anda tidak dapat mengubah role Anda sendiri!');
        }

        $user->update(['role' => $validated['role']]);

        return redirect()->back()->with('success', "Role {$user->name} berhasil diperbarui menjadi {$validated['role']}!");
    }
}
