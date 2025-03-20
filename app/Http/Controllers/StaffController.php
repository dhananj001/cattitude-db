<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // Using User model for staff management
use App\Models\Role; // Using Role model for staff management
use Illuminate\Support\Facades\Auth;


class StaffController extends Controller
{
    // Display all staff members
    public function index(Request $request)
    {
        $search = $request->input('search');

        // Fetch users with their assigned roles
        $staff = User::with('roles')->when($search, function ($query) use ($search) {
            $query->where('name', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%");
        })->paginate(10);

        // Fetch all roles to display in the dropdown
        $roles = Role::all();

        return view('staff.index', compact('staff', 'roles'));
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

    // Update a staff member's role
    // public function updateRole(Request $request, User $user)
    // {
    //     if (Auth::user()->hasRole('admin')) {
    //         if ($request->has('is_admin')) {
    //             $user->roles()->sync([1]);
    //         } else {
    //             $user->roles()->detach(1);
    //         }
    //     }

    //     return back()->with('success', 'Role updated successfully.');
    // }

    public function assignRole(Request $request, $userId)
    {
        $user = User::findOrFail($userId);
        $role = Role::findOrFail($request->role_id);

        $user->assignRole($role->id);

        return redirect()->back()->with('success', 'Role assigned successfully.');
    }

    public function removeRole(Request $request, $userId)
    {
        $user = User::findOrFail($userId);
        $role = Role::findOrFail($request->role_id);

        $user->removeRole($role->id);

        return redirect()->back()->with('success', 'Role removed successfully.');
    }
}
