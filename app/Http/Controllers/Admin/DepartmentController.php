<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DepartmentController extends Controller
{
    public function index()
    {
        $departments = Department::with('parent')->paginate(10);
        return view('admin.departments.index', compact('departments'));
    }

    public function create()
    {
        $departments = Department::all(); // Get all departments for parent selection
        return view('admin.departments.create', compact('departments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'icon' => 'nullable|string|max:255',
            'short_description' => 'nullable|string|max:500',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'parent_id' => 'nullable|exists:departments,id',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('departments', 'public');
        }

        Department::create([
            'name' => $request->name,
            'icon' => $request->icon,
            'short_description' => $request->short_description,
            'description' => $request->description,
            'image' => $imagePath,
            'parent_id' => $request->parent_id,
        ]);

        return redirect()->route('admin.departments.index')->with('success', 'Отдел ийгиликтүү кошулду!');
    }

    public function edit(Department $department)
    {
        $departments = Department::where('id', '!=', $department->id)->get(); // Get all departments except the current one
        return view('admin.departments.edit', compact('department', 'departments'));
    }

    public function update(Request $request, Department $department)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'icon' => 'nullable|string|max:255',
            'short_description' => 'nullable|string|max:500',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'parent_id' => 'nullable|exists:departments,id',
        ]);

        $imagePath = $department->image;
        if ($request->hasFile('image')) {
            if ($imagePath) {
                Storage::disk('public')->delete($imagePath);
            }
            $imagePath = $request->file('image')->store('departments', 'public');
        }

        $department->update([
            'name' => $request->name,
            'icon' => $request->icon,
            'short_description' => $request->short_description,
            'description' => $request->description,
            'image' => $imagePath,
            'parent_id' => $request->parent_id,
        ]);

        return redirect()->route('admin.departments.index')->with('success', 'Отдел ийгиликтүү жаңыртылды!');
    }

    public function destroy(Department $department)
    {
        // Check for related records before deleting (e.g., medics in this department)
        // For now, we'll just delete. We'll add this check later when we have medics.

        if ($department->image) {
            Storage::disk('public')->delete($department->image);
        }
        $department->delete();

        return redirect()->route('admin.departments.index')->with('success', 'Отдел ийгиликтүү өчүрүлдү!');
    }
}
