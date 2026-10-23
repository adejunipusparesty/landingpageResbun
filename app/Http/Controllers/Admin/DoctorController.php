<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Doctor;

class DoctorController extends Controller
{
    public function index()
    {
        $doctors = Doctor::orderBy('order_num', 'asc')->orderBy('id', 'asc')->get();
        return view('admin.doctors.index', compact('doctors'));
    }

    public function create()
    {
        return view('admin.doctors.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'specialty' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'experience' => 'nullable|string|max:100',
            'sip_number' => 'nullable|string|max:100',
            'schedule_days' => 'nullable|string|max:255',
            'schedule_hours' => 'nullable|string|max:255',
            'bio' => 'nullable|string',
            'photo' => 'nullable|string|max:255',
            'photo_file' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:4096',
            'cropped_image_base64' => 'nullable|string',
            'is_active' => 'nullable',
            'order_num' => 'nullable|integer',
        ]);

        if ($request->filled('cropped_image_base64')) {
            $data = $request->input('cropped_image_base64');
            if (preg_match('/^data:image\/(\w+);base64,/', $data, $type)) {
                $data = substr($data, strpos($data, ',') + 1);
                $ext = strtolower($type[1]);
                if ($ext === 'jpeg') $ext = 'jpg';
                $decoded = base64_decode($data);
                if ($decoded !== false) {
                    $filename = 'doctor_' . time() . '_' . uniqid() . '.' . $ext;
                    file_put_contents(public_path('images/' . $filename), $decoded);
                    $validated['photo'] = $filename;
                }
            }
        } elseif ($request->hasFile('photo_file')) {
            $file = $request->file('photo_file');
            $filename = 'doctor_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images'), $filename);
            $validated['photo'] = $filename;
        }

        $validated['is_active'] = $request->has('is_active');
        $validated['order_num'] = $validated['order_num'] ?? 0;

        Doctor::create($validated);

        return redirect()->route('admin.doctors.index')->with('success', 'Data dokter berhasil ditambahkan.');
    }

    public function edit(Doctor $doctor)
    {
        return view('admin.doctors.edit', compact('doctor'));
    }

    public function update(Request $request, Doctor $doctor)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'specialty' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'experience' => 'nullable|string|max:100',
            'sip_number' => 'nullable|string|max:100',
            'schedule_days' => 'nullable|string|max:255',
            'schedule_hours' => 'nullable|string|max:255',
            'bio' => 'nullable|string',
            'photo' => 'nullable|string|max:255',
            'photo_file' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:4096',
            'cropped_image_base64' => 'nullable|string',
            'is_active' => 'nullable',
            'order_num' => 'nullable|integer',
        ]);

        if ($request->filled('cropped_image_base64')) {
            $data = $request->input('cropped_image_base64');
            if (preg_match('/^data:image\/(\w+);base64,/', $data, $type)) {
                $data = substr($data, strpos($data, ',') + 1);
                $ext = strtolower($type[1]);
                if ($ext === 'jpeg') $ext = 'jpg';
                $decoded = base64_decode($data);
                if ($decoded !== false) {
                    $filename = 'doctor_' . time() . '_' . uniqid() . '.' . $ext;
                    file_put_contents(public_path('images/' . $filename), $decoded);
                    $validated['photo'] = $filename;
                }
            }
        } elseif ($request->hasFile('photo_file')) {
            $file = $request->file('photo_file');
            $filename = 'doctor_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images'), $filename);
            $validated['photo'] = $filename;
        } elseif (empty($validated['photo'])) {
            $validated['photo'] = $doctor->photo;
        }

        $validated['is_active'] = $request->has('is_active');
        $doctor->update($validated);

        return redirect()->route('admin.doctors.index')->with('success', 'Data dokter berhasil diperbarui.');
    }

    public function destroy(Doctor $doctor)
    {
        $doctor->delete();
        return back()->with('success', 'Data dokter berhasil dihapus.');
    }

    public function reorder(Request $request)
    {
        $validated = $request->validate([
            'order' => 'required|array',
            'order.*' => 'required|integer|exists:doctors,id',
        ]);

        foreach ($validated['order'] as $index => $id) {
            Doctor::where('id', $id)->update(['order_num' => $index + 1]);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Urutan dokter berhasil diperbarui.'
        ]);
    }
}
