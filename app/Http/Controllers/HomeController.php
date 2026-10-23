<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\Service;
use App\Models\Facility;
use App\Models\Article;
use App\Models\Appointment;
use App\Models\Testimonial;
use App\Models\Setting;

class HomeController extends Controller
{
    public function index()
    {
        $doctors = Doctor::where('is_active', true)->orderBy('order_num')->get();
        $services = Service::where('is_active', true)->orderBy('order_num')->get();
        $facilities = Facility::where('is_active', true)->orderBy('order_num')->get();
        $testimonials = Testimonial::where('is_approved', true)->orderBy('order_num')->get();
        $articles = Article::where('is_published', true)->orderBy('published_at', 'desc')->take(3)->get();
        
        $settings = Setting::pluck('value', 'key')->toArray();

        return view('home', compact('doctors', 'services', 'facilities', 'testimonials', 'articles', 'settings'));
    }

    public function bookAppointment(Request $request)
    {
        $validated = $request->validate([
            'patient_name' => 'required|string|max:255',
            'parent_name' => 'nullable|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'doctor_id' => 'nullable|exists:doctors,id',
            'service_category' => 'nullable|string|max:255',
            'appointment_date' => 'required|date|after_or_equal:today',
            'appointment_time' => 'nullable|string|max:50',
            'complaint' => 'nullable|string|max:1000',
        ]);

        $bookingCode = Appointment::generateBookingCode();

        $appointment = Appointment::create([
            'booking_code' => $bookingCode,
            'patient_name' => $validated['patient_name'],
            'parent_name' => $validated['parent_name'] ?? null,
            'phone' => $validated['phone'],
            'email' => $validated['email'] ?? null,
            'doctor_id' => $validated['doctor_id'] ?? null,
            'service_category' => $validated['service_category'] ?? null,
            'appointment_date' => $validated['appointment_date'],
            'appointment_time' => $validated['appointment_time'] ?? 'Pagi (08:00 - 12:00)',
            'complaint' => $validated['complaint'] ?? null,
            'status' => 'pending',
        ]);

        return redirect()->to(url('/#booking-status'))->with('booking_success', [
            'code' => $appointment->booking_code,
            'patient_name' => $appointment->patient_name,
            'date' => $appointment->appointment_date->format('d M Y'),
            'doctor' => $appointment->doctor ? $appointment->doctor->name : 'Dokter Terjadwal',
            'phone' => $appointment->phone,
        ]);
    }

    public function checkBooking(Request $request)
    {
        $query = $request->input('search');
        $appointment = null;

        if ($query) {
            $appointment = Appointment::with('doctor')
                ->where('booking_code', 'like', "%{$query}%")
                ->orWhere('phone', 'like', "%{$query}%")
                ->latest()
                ->first();
        }

        return view('booking-status', compact('appointment', 'query'));
    }

    public function doctorDetail($id)
    {
        $doctor = Doctor::findOrFail($id);
        $otherDoctors = Doctor::where('id', '!=', $id)->where('is_active', true)->take(3)->get();
        return view('doctor-detail', compact('doctor', 'otherDoctors'));
    }

    public function articleDetail($slug)
    {
        $article = Article::where('slug', $slug)->firstOrFail();
        $article->increment('views');
        $recentArticles = Article::where('id', '!=', $article->id)->where('is_published', true)->take(3)->get();
        return view('article-detail', compact('article', 'recentArticles'));
    }
}
