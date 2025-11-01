<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\User;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        Gate::authorize('view-reports');

        $medics = User::where('role', 'medic')->get();
        $selectedMedicId = $request->input('medic_id');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $query = Appointment::query();

        if ($selectedMedicId) {
            $query->where('medic_id', $selectedMedicId);
        }

        if ($startDate) {
            $query->whereDate('appointment_date', '>=', $startDate);
        }

        if ($endDate) {
            $query->whereDate('appointment_date', '<=', $endDate);
        }

        $appointments = $query->get();

        $medicReports = [];
        foreach ($medics as $medic) {
            $medicAppointments = $appointments->where('medic_id', $medic->id);
            $medicReports[] = [
                'medic' => $medic,
                'total_appointments' => $medicAppointments->count(),
                'completed_appointments' => $medicAppointments->where('status', 'completed')->count(),
                'successful_appointments' => $medicAppointments->where('status', 'confirmed')->count(), // Assuming confirmed are successful until completed
                'cancelled_appointments' => $medicAppointments->where('status', 'cancelled')->count(),
            ];
        }

        // Room occupancy report
        $rooms = Room::withCount(['appointments' => function ($query) {
            $query->whereIn('status', ['pending', 'confirmed']); // Count active appointments
        }])->get();

        return view('admin.reports.index', compact('medicReports', 'medics', 'selectedMedicId', 'startDate', 'endDate', 'rooms'));
    }
}
