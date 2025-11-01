<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\User;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AppointmentController extends Controller
{
    public function create(User $medic)
    {
        // Show form to book an appointment with a specific medic
        $schedules = $medic->schedules()->orderBy('day_of_week')->orderBy('start_time')->get();
        return view('appointments.create', compact('medic', 'schedules'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'medic_id' => 'required|exists:users,id',
            'appointment_date' => 'required|date|after_or_equal:today',
            'appointment_time' => 'required|date_format:H:i',
            'notes' => 'nullable|string|max:1000',
        ]);

        $medic = User::findOrFail($request->medic_id);
        $appointmentDateTime = Carbon::parse($request->appointment_date . ' ' . $request->appointment_time);

        // Check if medic works on this day and time
        $dayOfWeek = $appointmentDateTime->format('l'); // e.g., Monday
        $scheduleExists = Schedule::where('user_id', $medic->id)
            ->where('day_of_week', $dayOfWeek)
            ->where('start_time', '<=', $appointmentDateTime->format('H:i'))
            ->where('end_time', '>=', $appointmentDateTime->addMinutes(30)->format('H:i')) // Check for 30 min slot
            ->exists();

        if (!$scheduleExists) {
            return back()->withErrors(['appointment_time' => 'Врач бул күнү же бул убакытта иштебейт.'])->withInput();
        }

        // Check for existing appointments for this medic at this time slot
        $existingAppointment = Appointment::where('medic_id', $medic->id)
            ->where('appointment_date', $request->appointment_date)
            ->where('appointment_time', $request->appointment_time)
            ->exists();

        if ($existingAppointment) {
            return back()->withErrors(['appointment_time' => 'Бул убакытка башка пациент жазылган. Башка убакытты тандаңыз.'])->withInput();
        }

        Appointment::create([
            'user_id' => Auth::id(),
            'medic_id' => $request->medic_id,
            'appointment_date' => $request->appointment_date,
            'appointment_time' => $request->appointment_time,
            'notes' => $request->notes,
            'status' => 'pending',
        ]);

        return redirect()->route('dashboard')->with('success', 'Брондооңуз ийгиликтүү жөнөтүлдү. Админ тарабынан текшерилүүдө.');
    }

    public function myAppointments()
    {
        $appointments = Auth::user()->appointmentsAsPatient()->with('medic')->orderBy('appointment_date', 'desc')->paginate(10);
        return view('appointments.my_appointments', compact('appointments'));
    }
}
