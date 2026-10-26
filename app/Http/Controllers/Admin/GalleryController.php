<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Gallery;

class GalleryController extends Controller
{
    public function index(Request $request)
    {
        $query = Gallery::query();

        if ($request->filled('category') && $request->category !== 'all') {
            $query->where('category', $request->category);
        }

        $galleries = $query->orderBy('order_num', 'asc')->latest()->paginate(12);
        $categories = Gallery::select('category')->distinct()->pluck('category')->toArray();

        return view('admin.galleries.index', compact('galleries', 'categories'));
    }

    public function create()
    {
        $categories = [
            'Kegiatan & Edukasi',
            'Fasilitas & Kamar',
            'Pelayanan Medis',
            'Momen Bahagia',
            'Prestasi & Acara',
        ];
        return view('admin.galleries.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:191',
            'category' => 'required|string|max:191',
            'image_file' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:4096',
        ]);

        $data = [
            'title' => $request->input('title'),
            'category' => $request->input('category'),
            'description' => $request->input('description'),
            'event_date' => $request->input('event_date') ?: now()->format('Y-m-d'),
            'order_num' => (int) $request->input('order_num', 0),
            'is_active' => $request->has('is_active') ? true : false,
        ];

        if ($request->hasFile('image_file')) {
            $file = $request->file('image_file');
            $filename = 'gallery_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images'), $filename);
            $data['image'] = $filename;
        } elseif ($request->filled('image')) {
            $data['image'] = $request->input('image');
        } else {
            $data['image'] = 'hero.jpg';
        }

        Gallery::create($data);

        return redirect()->route('admin.galleries.index')->with('success', 'Foto galeri dokumentasi berhasil ditambahkan!');
    }

    public function edit(Gallery $gallery)
    {
        $categories = [
            'Kegiatan & Edukasi',
            'Fasilitas & Kamar',
            'Pelayanan Medis',
            'Momen Bahagia',
            'Prestasi & Acara',
        ];
        return view('admin.galleries.edit', compact('gallery', 'categories'));
    }

    public function update(Request $request, Gallery $gallery)
    {
        $request->validate([
            'title' => 'required|string|max:191',
            'category' => 'required|string|max:191',
            'image_file' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:4096',
        ]);

        $data = [
            'title' => $request->input('title'),
            'category' => $request->input('category'),
            'description' => $request->input('description'),
            'event_date' => $request->input('event_date') ?: now()->format('Y-m-d'),
            'order_num' => (int) $request->input('order_num', 0),
            'is_active' => $request->has('is_active') ? true : false,
        ];

        if ($request->hasFile('image_file')) {
            $file = $request->file('image_file');
            $filename = 'gallery_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images'), $filename);
            $data['image'] = $filename;
        } elseif ($request->filled('image')) {
            $data['image'] = $request->input('image');
        }

        $gallery->update($data);

        return redirect()->route('admin.galleries.index')->with('success', 'Foto galeri berhasil diperbarui!');
    }

    public function destroy(Gallery $gallery)
    {
        $gallery->delete();
        return redirect()->route('admin.galleries.index')->with('success', 'Foto dokumentasi telah dihapus dari galeri!');
    }

    public function toggleStatus(Gallery $gallery)
    {
        $gallery->update(['is_active' => !$gallery->is_active]);
        $statusText = $gallery->is_active ? 'ditampilkan' : 'disembunyikan';
        return back()->with('success', "Foto galeri berhasil {$statusText} di website!");
    }
}
