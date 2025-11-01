<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class AppointmentController extends Controller
{
    public function index()
    {
        Gate::authorize('manage-appointments');
        $appointments = Appointment::with('patient', 'medic', 'room')->orderBy('appointment_date', 'desc')->paginate(10);
        return view('admin.appointments.index', compact('appointments'));
    }

    public function edit(Appointment $appointment)
    {
        Gate::authorize('manage-appointments');
        $rooms = Room::all();
        return view('admin.appointments.edit', compact('appointment', 'rooms'));
    }

    public function update(Request $request, Appointment $appointment)
    {
        Gate::authorize('manage-appointments');

        $request->validate([
            'status' => 'required|in:pending,confirmed,cancelled,completed',
            'appointment_date' => 'required|date|after_or_equal:today',
            'appointment_time' => 'required|date_format:H:i',
            'room_id' => ['nullable', 'exists:rooms,id'],
        ]);

        // Check room capacity if a room is assigned
        if ($request->filled('room_id')) {
            $room = Room::findOrFail($request->room_id);
            $occupiedCount = Appointment::where('room_id', $request->room_id)
                ->where('status', '!=', 'completed') // Consider only active appointments
                ->where('id', '!=', $appointment->id) // Exclude current appointment if updating
                ->count();

            if ($occupiedCount >= $room->capacity) {
                return back()->withErrors(['room_id' => 'Бул палата толуп калган. Башка палатаны тандаңыз.'])->withInput();
            }
        }

        $appointment->update($request->all());

        return redirect()->route('admin.appointments.index')->with('success', 'Брондоо ийгиликтүү жаңыртылды!');
    }

    public function destroy(Appointment $appointment)
    {
        Gate::authorize('manage-appointments');
        $appointment->delete();
        return redirect()->route('admin.appointments.index')->with('success', 'Брондоо ийгиликтүү өчүрүлдү!');
    }
}
