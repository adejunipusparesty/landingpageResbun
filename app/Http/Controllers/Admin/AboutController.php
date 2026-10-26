<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use App\Models\Director;

class AboutController extends Controller
{
    public function index()
    {
        $settings = Setting::pluck('value', 'key')->toArray();
        $directors = Director::orderBy('order_num', 'asc')->get();

        return view('admin.about.index', compact('settings', 'directors'));
    }

    public function updateInfo(Request $request)
    {
        $keys = [
            'about_motto',
            'about_vision',
            'about_mission',
            'about_history',
            'about_core_values',
            'hospital_establishment_year',
        ];

        foreach ($keys as $key) {
            if ($request->has($key)) {
                Setting::set($key, $request->input($key), 'about');
            }
        }

        // Upload Gambar Sejarah jika ada
        if ($request->hasFile('about_history_image_file')) {
            $file = $request->file('about_history_image_file');
            $filename = 'history_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images'), $filename);
            Setting::set('about_history_image', $filename, 'about');
        } elseif ($request->filled('about_history_image')) {
            Setting::set('about_history_image', $request->input('about_history_image'), 'about');
        }

        return redirect()->route('admin.about.index')->with('success', 'Informasi Tentang Kami (Sejarah, Visi, Misi, Moto) berhasil diperbarui!');
    }

    public function storeDirector(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:191',
            'position' => 'required|string|max:191',
            'photo_file' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:3072',
        ]);

        $data = [
            'name' => $request->input('name'),
            'position' => $request->input('position'),
            'bio' => $request->input('bio'),
            'order_num' => (int) $request->input('order_num', 0),
            'is_active' => $request->has('is_active') ? true : false,
        ];

        if ($request->hasFile('photo_file')) {
            $file = $request->file('photo_file');
            $filename = 'director_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images'), $filename);
            $data['photo'] = $filename;
        } elseif ($request->filled('photo')) {
            $data['photo'] = $request->input('photo');
        } else {
            $data['photo'] = 'doctor_amanda.jpg';
        }

        Director::create($data);

        return redirect()->route('admin.about.index')->with('success', 'Anggota Jajaran Direksi berhasil ditambahkan!');
    }

    public function updateDirector(Request $request, Director $director)
    {
        $request->validate([
            'name' => 'required|string|max:191',
            'position' => 'required|string|max:191',
            'photo_file' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:3072',
        ]);

        $data = [
            'name' => $request->input('name'),
            'position' => $request->input('position'),
            'bio' => $request->input('bio'),
            'order_num' => (int) $request->input('order_num', 0),
            'is_active' => $request->has('is_active') ? true : false,
        ];

        if ($request->hasFile('photo_file')) {
            $file = $request->file('photo_file');
            $filename = 'director_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images'), $filename);
            $data['photo'] = $filename;
        } elseif ($request->filled('photo')) {
            $data['photo'] = $request->input('photo');
        }

        $director->update($data);

        return redirect()->route('admin.about.index')->with('success', 'Profil Direksi berhasil diperbarui!');
    }

    public function destroyDirector(Director $director)
    {
        $director->delete();
        return redirect()->route('admin.about.index')->with('success', 'Data Direksi telah dihapus!');
    }
}
