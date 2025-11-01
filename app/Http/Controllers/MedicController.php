<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class MedicController extends Controller
{
    public function index()
    {
        $medics = User::where('role', 'medic')->with('department')->paginate(10);
        return view('medics.index', compact('medics'));
    }

    public function show(User $medic)
    {
        // Ensure the user is a medic
        if ($medic->role !== 'medic') {
            abort(404);
        }
        $medic->load('department', 'schedules');
        return view('medics.show', compact('medic'));
    }
}
