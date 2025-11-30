<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\Floor;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function index()
    {
        $rooms = Room::with('floor.building')->paginate(10);
        return view('admin.rooms.index', compact('rooms'));
    }

    public function create()
    {
        $floors = Floor::with('building')->get();
        return view('admin.rooms.create', compact('floors'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'floor_id' => 'required|exists:floors,id',
            'room_number' => 'required|string|max:255|unique:rooms,room_number,NULL,id,floor_id,' . $request->floor_id,
            'capacity' => 'required|integer|min:1',
        ]);

        Room::create($request->all());

        return redirect()->route('admin.rooms.index')->with('success', 'Палата ийгиликтүү кошулду!');
    }

    public function edit(Room $room)
    {
        $floors = Floor::with('building')->get();
        return view('admin.rooms.edit', compact('room', 'floors'));
    }

    public function update(Request $request, Room $room)
    {
        $request->validate([
            'floor_id' => 'required|exists:floors,id',
            'room_number' => 'required|string|max:255|unique:rooms,room_number,' . $room->id . ',id,floor_id,' . $request->floor_id,
            'capacity' => 'required|integer|min:1',
        ]);

        $room->update($request->all());

        return redirect()->route('admin.rooms.index')->with('success', 'Палата ийгиликтүү жаңыртылды!');
    }

    public function destroy(Room $room)
    {
        if ($room->appointments()->count() > 0) {
            return redirect()->route('admin.rooms.index')->with('error', 'Бул палатада пациенттер бар, аны өчүрүү мүмкүн эмес.');
        }

        $room->delete();

        return redirect()->route('admin.rooms.index')->with('success', 'Палата ийгиликтүү өчүрүлдү!');
    }
}
