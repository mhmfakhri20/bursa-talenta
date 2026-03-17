<?php

namespace App\Http\Controllers\Admin;

use App\Models\Kegiatan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class KegiatanController extends Controller
{
    public function index()
    {
        $kegiatan = Kegiatan::latest()->get();
        return view('admin.kegiatan.index', compact('kegiatan'));
    }

    public function create()
    {
        return view('admin.kegiatan.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'kategori' => 'required',
            'deskripsi' => 'required|string',
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'zoom_url' => 'required',
            'tanggal_kegiatan' => 'required|date',
        ]);

        if ($request->hasFile('thumbnail')) {
            $validated['thumbnail'] = $request->file('thumbnail')->store('kegiatan', 'public');
        }

        Kegiatan::create($validated);

        return redirect('kelola/kegiatan')->with('success', 'Kegiatan berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $kegiatan = Kegiatan::findOrFail($id);
        return view('admin.kegiatan.edit', compact('kegiatan'));
    }

    public function update(Request $request, $id)
    {
        // dd($request->all());
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'kategori' => 'required',
            'deskripsi' => 'required|string',
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'zoom_url' => 'required',
            'tanggal_kegiatan' => 'required|date',
        ]);

        $kegiatan = Kegiatan::findOrFail($id);

        if ($request->hasFile('thumbnail')) {
            if ($kegiatan->thumbnail && Storage::disk('public')->exists($kegiatan->thumbnail)) {
                Storage::disk('public')->delete($kegiatan->thumbnail);
            }

            $validated['thumbnail'] = $request->file('thumbnail')->store('kegiatan', 'public');
        }

        $kegiatan->update($validated);

        return redirect()->route('kegiatan.index')->with('success', 'Kegiatan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $kegiatan = Kegiatan::findOrFail($id);
        
        if ($kegiatan->thumbnail && Storage::disk('public')->exists($kegiatan->thumbnail)) {
            Storage::disk('public')->delete($kegiatan->thumbnail);
        }

        $kegiatan->delete();

        return redirect()->route('kegiatan.index')->with('success', 'Kegiatan berhasil dihapus.');
    }

    public function getPeserta(Request $request) 
    {
        $id = $request->id;

        $data = Kegiatan::with('peserta.profile')->findOrFail($id);

        return response()->json($data, 200);
    }
}
