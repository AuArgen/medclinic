<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Building;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class BuildingController extends Controller
{
    public function index()
    {
        Gate::authorize('manage-buildings');
        $buildings = Building::paginate(10);
        return view('admin.buildings.index', compact('buildings'));
    }

    public function create()
    {
        Gate::authorize('manage-buildings');
        return view('admin.buildings.create');
    }

    public function store(Request $request)
    {
        Gate::authorize('manage-buildings');

        $request->validate([
            'name' => 'required|string|max:255|unique:buildings',
        ]);

        Building::create($request->all());

        return redirect()->route('admin.buildings.index')->with('success', 'Корпус ийгиликтүү кошулду!');
    }

    public function edit(Building $building)
    {
        Gate::authorize('manage-buildings');
        return view('admin.buildings.edit', compact('building'));
    }

    public function update(Request $request, Building $building)
    {
        Gate::authorize('manage-buildings');

        $request->validate([
            'name' => 'required|string|max:255|unique:buildings,name,' . $building->id,
        ]);

        $building->update($request->all());

        return redirect()->route('admin.buildings.index')->with('success', 'Корпус ийгиликтүү жаңыртылды!');
    }

    public function destroy(Building $building)
    {
        Gate::authorize('manage-buildings');

        if ($building->floors()->count() > 0) {
            return redirect()->route('admin.buildings.index')->with('error', 'Бул корпуста этаждар бар, аларды өчүрүү мүмкүн эмес.');
        }

        $building->delete();

        return redirect()->route('admin.buildings.index')->with('success', 'Корпус ийгиликтүү өчүрүлдү!');
    }
}
