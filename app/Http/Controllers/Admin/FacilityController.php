<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Facility;

class FacilityController extends Controller
{
    public function index()
    {
        $facilities = Facility::orderBy('order_num')->get();
        return view('admin.facilities.index', compact('facilities'));
    }

    public function create()
    {
        return view('admin.facilities.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'badge' => 'nullable|string|max:100',
            'description' => 'required|string',
            'photo' => 'nullable|string|max:255',
            'photo_file' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:4096',
            'order_num' => 'nullable|integer',
        ]);

        if ($request->hasFile('photo_file')) {
            $file = $request->file('photo_file');
            $filename = 'facility_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images'), $filename);
            $validated['photo'] = $filename;
        }

        $validated['is_active'] = $request->has('is_active');
        $validated['order_num'] = $validated['order_num'] ?? 0;

        Facility::create($validated);

        return redirect()->route('admin.facilities.index')->with('success', 'Fasilitas rumah sakit beserta foto berhasil ditambahkan.');
    }

    public function edit(Facility $facility)
    {
        return view('admin.facilities.edit', compact('facility'));
    }

    public function update(Request $request, Facility $facility)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'badge' => 'nullable|string|max:100',
            'description' => 'required|string',
            'photo' => 'nullable|string|max:255',
            'photo_file' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:4096',
            'order_num' => 'nullable|integer',
        ]);

        if ($request->hasFile('photo_file')) {
            $file = $request->file('photo_file');
            $filename = 'facility_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images'), $filename);
            $validated['photo'] = $filename;
        } elseif (empty($validated['photo'])) {
            $validated['photo'] = $facility->photo;
        }

        $validated['is_active'] = $request->has('is_active');
        $facility->update($validated);

        return redirect()->route('admin.facilities.index')->with('success', 'Fasilitas rumah sakit berhasil diperbarui.');
    }

    public function destroy(Facility $facility)
    {
        $facility->delete();
        return back()->with('success', 'Fasilitas rumah sakit berhasil dihapus.');
    }
}
