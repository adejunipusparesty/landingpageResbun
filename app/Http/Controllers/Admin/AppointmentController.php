<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Doctor;

class AppointmentController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->input('status');
        $search = $request->input('search');
        $date = $request->input('date');

        $query = Appointment::with('doctor')->orderBy('appointment_date', 'desc')->orderBy('id', 'desc');

        if ($status && in_array($status, ['pending', 'confirmed', 'completed', 'cancelled'])) {
            $query->where('status', $status);
        }

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('booking_code', 'like', "%{$search}%")
                  ->orWhere('patient_name', 'like', "%{$search}%")
                  ->orWhere('parent_name', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        if ($date) {
            $query->whereDate('appointment_date', $date);
        }

        $appointments = $query->paginate(15)->withQueryString();
        $doctors = Doctor::where('is_active', true)->get();

        return view('admin.appointments.index', compact('appointments', 'doctors', 'status', 'search', 'date'));
    }

    public function show(Appointment $appointment)
    {
        $appointment->load('doctor');
        return view('admin.appointments.show', compact('appointment'));
    }

    public function updateStatus(Request $request, Appointment $appointment)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,confirmed,completed,cancelled',
            'admin_note' => 'nullable|string|max:1000',
        ]);

        $appointment->update($validated);

        return back()->with('success', "Status janji temu #{$appointment->booking_code} berhasil diperbarui menjadi: " . ucfirst($appointment->status));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'patient_name' => 'required|string|max:255',
            'parent_name' => 'nullable|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'doctor_id' => 'nullable|exists:doctors,id',
            'service_category' => 'nullable|string|max:255',
            'appointment_date' => 'required|date',
            'appointment_time' => 'nullable|string|max:50',
            'complaint' => 'nullable|string|max:1000',
            'status' => 'required|in:pending,confirmed,completed,cancelled',
            'admin_note' => 'nullable|string|max:1000',
        ]);

        $validated['booking_code'] = Appointment::generateBookingCode();

        Appointment::create($validated);

        return redirect()->route('admin.appointments.index')->with('success', 'Janji temu baru berhasil ditambahkan.');
    }

    public function destroy(Appointment $appointment)
    {
        $code = $appointment->booking_code;
        $appointment->delete();

        return back()->with('success', "Data janji temu #{$code} berhasil dihapus.");
    }
}
