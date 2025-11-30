<?php

namespace App\Http\Controllers\Medic;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MedicAppointmentController extends Controller
{
    public function index()
    {
        $appointments = Auth::user()->appointmentsAsMedic()->with('patient')->orderBy('appointment_date', 'desc')->paginate(10);
        return view('medic.appointments.index', compact('appointments'));
    }

    public function show(Appointment $appointment)
    {
        // Ensure the medic owns this appointment
        if ($appointment->medic_id !== Auth::id()) {
            abort(403, 'Уруксат жок.');
        }
        return view('medic.appointments.show', compact('appointment'));
    }

    public function update(Request $request, Appointment $appointment)
    {
        // Ensure the medic owns this appointment
        if ($appointment->medic_id !== Auth::id()) {
            abort(403, 'Уруксат жок.');
        }

        $request->validate([
            'status' => 'required|in:pending,confirmed,cancelled,completed',
        ]);

        $appointment->update($request->all());

        return redirect()->route('medic.appointments.index')->with('success', 'Брондоо статусу ийгиликтүү жаңыртылды!');
    }
}
