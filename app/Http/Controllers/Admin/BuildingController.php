<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Building;
use Illuminate\Http\Request;

class BuildingController extends Controller
{
    public function index()
    {
        $buildings = Building::paginate(10);
        return view('admin.buildings.index', compact('buildings'));
    }

    public function create()
    {
        return view('admin.buildings.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:buildings',
        ]);

        Building::create($request->all());

        return redirect()->route('admin.buildings.index')->with('success', 'Корпус ийгиликтүү кошулду!');
    }

    public function edit(Building $building)
    {
        return view('admin.buildings.edit', compact('building'));
    }

    public function update(Request $request, Building $building)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:buildings,name,' . $building->id,
        ]);

        $building->update($request->all());

        return redirect()->route('admin.buildings.index')->with('success', 'Корпус ийгиликтүү жаңыртылды!');
    }

    public function destroy(Building $building)
    {
        if ($building->floors()->count() > 0) {
            return redirect()->route('admin.buildings.index')->with('error', 'Бул корпуста этаждар бар, аларды өчүрүү мүмкүн эмес.');
        }

        $building->delete();

        return redirect()->route('admin.buildings.index')->with('success', 'Корпус ийгиликтүү өчүрүлдү!');
    }
}
