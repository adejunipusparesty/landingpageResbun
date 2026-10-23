<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::pluck('value', 'key')->toArray();
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        // 1. General & Contact Settings
        $textKeys = [
            'hospital_name',
            'tagline',
            'badge_city',
            'phone_emergency',
            'phone_callcenter',
            'whatsapp',
            'address',
            'email',
            'operating_hours',
            'stat_doctors',
            'stat_patients',
            'stat_service_hours',
            'stat_accreditation',
            // Topbar
            'topbar_address',
            'topbar_address_url',
            'topbar_service_hours',
            // Popup
            'popup_badge',
            'popup_title',
            'popup_content',
            'popup_btn_text',
            'popup_btn_url',
            'popup_image',
            'hospital_logo',
            'hero_image',
        ];

        foreach ($textKeys as $key) {
            if ($request->has($key)) {
                Setting::set($key, $request->input($key));
            }
        }

        // 2. Checkbox toggles
        $checkboxKeys = [
            'topbar_enabled',
            'topbar_show_booking_link',
            'topbar_show_admin_link',
            'popup_enabled',
        ];

        foreach ($checkboxKeys as $key) {
            Setting::set($key, $request->has($key) ? '1' : '0');
        }

        // 3. Popup Image Upload
        if ($request->hasFile('popup_image_file')) {
            $file = $request->file('popup_image_file');
            $filename = 'popup_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images'), $filename);
            Setting::set('popup_image', $filename);
        }

        // 4. Logo Rumah Sakit Upload
        if ($request->hasFile('logo_file')) {
            $file = $request->file('logo_file');
            $filename = 'logo.' . $file->getClientOriginalExtension();
            $file->move(public_path('images'), $filename);
            Setting::set('hospital_logo', $filename);
        }

        // 5. Hero Banner Landing Page Upload
        if ($request->hasFile('hero_file')) {
            $file = $request->file('hero_file');
            $filename = 'hero.' . $file->getClientOriginalExtension();
            $file->move(public_path('images'), $filename);
            Setting::set('hero_image', $filename);
        }

        return back()->with('success', 'Seluruh pengaturan dan berkas gambar (Logo, Hero Banner, Top Emergency Bar, dan Pop-up Pengumuman) berhasil diperbarui.');
    }
}
