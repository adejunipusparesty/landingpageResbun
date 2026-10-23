<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Article;
use App\Models\Service;
use App\Models\Testimonial;

class DashboardController extends Controller
{
    public function index()
    {
        $totalAppointments = Appointment::count();
        $pendingAppointments = Appointment::where('status', 'pending')->count();
        $confirmedAppointments = Appointment::where('status', 'confirmed')->count();
        $completedAppointments = Appointment::where('status', 'completed')->count();
        
        $totalDoctors = Doctor::count();
        $totalArticles = Article::count();
        $totalServices = Service::count();
        $totalTestimonials = Testimonial::count();

        $recentAppointments = Appointment::with('doctor')
            ->orderBy('id', 'desc')
            ->take(8)
            ->get();

        $todayAppointments = Appointment::with('doctor')
            ->whereDate('appointment_date', today())
            ->orderBy('appointment_time')
            ->get();

        return view('admin.dashboard', compact(
            'totalAppointments',
            'pendingAppointments',
            'confirmedAppointments',
            'completedAppointments',
            'totalDoctors',
            'totalArticles',
            'totalServices',
            'totalTestimonials',
            'recentAppointments',
            'todayAppointments'
        ));
    }
}
