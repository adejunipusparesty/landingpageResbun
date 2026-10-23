<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use Illuminate\Support\Str;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::orderBy('order_num')->get();
        return view('admin.services.index', compact('services'));
    }

    public function create()
    {
        return view('admin.services.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'badge' => 'nullable|string|max:100',
            'icon' => 'nullable|string|max:100',
            'description' => 'required|string',
            'details' => 'nullable|string',
            'order_num' => 'nullable|integer',
        ]);

        $validated['slug'] = Str::slug($validated['title']);
        $validated['is_active'] = $request->has('is_active');
        $validated['order_num'] = $validated['order_num'] ?? 0;

        Service::create($validated);

        return redirect()->route('admin.services.index')->with('success', 'Layanan medis berhasil ditambahkan.');
    }

    public function edit(Service $service)
    {
        return view('admin.services.edit', compact('service'));
    }

    public function update(Request $request, Service $service)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'badge' => 'nullable|string|max:100',
            'icon' => 'nullable|string|max:100',
            'description' => 'required|string',
            'details' => 'nullable|string',
            'order_num' => 'nullable|integer',
        ]);

        $validated['slug'] = Str::slug($validated['title']);
        $validated['is_active'] = $request->has('is_active');
        $service->update($validated);

        return redirect()->route('admin.services.index')->with('success', 'Layanan medis berhasil diperbarui.');
    }

    public function destroy(Service $service)
    {
        $service->delete();
        return back()->with('success', 'Layanan medis berhasil dihapus.');
    }
}
