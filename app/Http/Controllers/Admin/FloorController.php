<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Floor;
use App\Models\Building;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class FloorController extends Controller
{
    public function index()
    {
        Gate::authorize('manage-floors');
        $floors = Floor::with('building')->paginate(10);
        return view('admin.floors.index', compact('floors'));
    }

    public function create()
    {
        Gate::authorize('manage-floors');
        $buildings = Building::all();
        return view('admin.floors.create', compact('buildings'));
    }

    public function store(Request $request)
    {
        Gate::authorize('manage-floors');

        $request->validate([
            'building_id' => 'required|exists:buildings,id',
            'name' => 'required|string|max:255|unique:floors,name,NULL,id,building_id,' . $request->building_id,
        ]);

        Floor::create($request->all());

        return redirect()->route('admin.floors.index')->with('success', 'Этаж ийгиликтүү кошулду!');
    }

    public function edit(Floor $floor)
    {
        Gate::authorize('manage-floors');
        $buildings = Building::all();
        return view('admin.floors.edit', compact('floor', 'buildings'));
    }

    public function update(Request $request, Floor $floor)
    {
        Gate::authorize('manage-floors');

        $request->validate([
            'building_id' => 'required|exists:buildings,id',
            'name' => 'required|string|max:255|unique:floors,name,' . $floor->id . ',id,building_id,' . $request->building_id,
        ]);

        $floor->update($request->all());

        return redirect()->route('admin.floors.index')->with('success', 'Этаж ийгиликтүү жаңыртылды!');
    }

    public function destroy(Floor $floor)
    {
        Gate::authorize('manage-floors');

        if ($floor->rooms()->count() > 0) {
            return redirect()->route('admin.floors.index')->with('error', 'Бул этажда палаталар бар, аларды өчүрүү мүмкүн эмес.');
        }

        $floor->delete();

        return redirect()->route('admin.floors.index')->with('success', 'Этаж ийгиликтүү өчүрүлдү!');
    }
}
