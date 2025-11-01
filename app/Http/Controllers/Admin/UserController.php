<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
    public function index(Request $request)
    {
        Gate::authorize('view-users');

        $query = User::query();

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('name', 'like', '%' . $search . '%')
                  ->orWhere('email', 'like', '%' . $search . '%');
        }

        $users = $query->with('department')->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        Gate::authorize('edit-users');
        $departments = Department::all();
        return view('admin.users.create', compact('departments'));
    }

    public function store(Request $request)
    {
        Gate::authorize('edit-users');

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone_number' => ['nullable', 'string', 'max:255'],
            'bio' => ['nullable', 'string'],
            'address' => ['nullable', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:6'], // Min 6 characters as requested
            'role' => ['required', 'in:admin,medic,customer'],
            'department_id' => ['nullable', 'exists:departments,id'],
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'bio' => $request->bio,
            'address' => $request->address,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'department_id' => $request->department_id,
        ]);

        return redirect()->route('admin.users.index')->with('success', 'Колдонуучу ийгиликтүү кошулду!');
    }

    public function edit(User $user)
    {
        Gate::authorize('edit-users');
        $departments = Department::all();
        return view('admin.users.edit', compact('user', 'departments'));
    }

    public function update(Request $request, User $user)
    {
        Gate::authorize('edit-users');

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'phone_number' => ['nullable', 'string', 'max:255'],
            'bio' => ['nullable', 'string'],
            'address' => ['nullable', 'string', 'max:255'],
            'password' => ['nullable', 'string', 'min:6'],
            'role' => ['required', 'in:admin,medic,customer'],
            'department_id' => ['nullable', 'exists:departments,id'],
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'bio' => $request->bio,
            'address' => $request->address,
            'role' => $request->role,
            'department_id' => $request->department_id,
        ]);

        if ($request->filled('password')) {
            $user->update([
                'password' => Hash::make($request->password),
            ]);
        }

        return redirect()->route('admin.users.index')->with('success', 'Колдонуучу ийгиликтүү жаңыртылды!');
    }

    public function destroy(User $user)
    {
        Gate::authorize('edit-users'); // Using edit-users gate for deletion as well

        // Prevent deleting the last admin user
        if ($user->role === 'admin' && User::where('role', 'admin')->count() <= 1) {
            return redirect()->route('admin.users.index')->with('error', 'Акыркы админ колдонуучуну өчүрүүгө болбойт!');
        }

        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'Колдонуучу ийгиликтүү өчүрүлдү!');
    }
}
