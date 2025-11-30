<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index()
    {
        $departments = Department::whereNull('parent_id')->with('children')->paginate(10);
        return view('departments.index', compact('departments'));
    }

    public function show(Department $department)
    {
        $department->load('children', 'medics');
        return view('departments.show', compact('department'));
    }
}
