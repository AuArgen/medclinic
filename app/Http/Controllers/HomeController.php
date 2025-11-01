<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $departments = Department::whereNull('parent_id')->with('children')->get();
        $medics = User::where('role', 'medic')->inRandomOrder()->limit(4)->get();
        return view('home', compact('departments', 'medics'));
    }

    public function about()
    {
        return view('about');
    }

    public function contact()
    {
        return view('contact');
    }
}
