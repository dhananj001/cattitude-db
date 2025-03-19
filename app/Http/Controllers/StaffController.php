<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // Using User model for staff management

class StaffController extends Controller
{
    // Display all staff members
    public function index(Request $request)
    {
        $search = $request->input('search');
        $staff = User::when($search, function ($query) use ($search) {
            $query->where('name', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%");
        })->paginate(10);

        return view('staff.index', compact('staff'));
    }

    // Show the form for adding a new staff member
    public function create()
    {
        return view('staff.create');
    }

    // Store a new staff member in the database
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6', // Ensure password is secure
            'role' => 'nullable|string|max:255',
        ]);

        // Create a new user
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password); // Encrypt password before saving
        $user->save();

        return redirect()->route('staff.index')->with('success', 'New staff member created successfully!');
    }

    // Show the edit form for a staff member
    public function edit($id)
    {
        $staff = User::findOrFail($id);
        return view('staff.edit', compact('staff'));
    }

    // Update staff details in the database
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'role' => 'nullable|string|max:255',
        ]);

        $staff = User::findOrFail($id);
        $staff->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
        ]);

        return redirect()->route('staff.index')->with('success', 'Staff updated successfully!');
    }

    // Delete a staff member
    public function destroy($id)
    {
        User::findOrFail($id)->delete();
        return redirect()->route('staff.index')->with('success', 'Staff deleted successfully!');
    }
}
