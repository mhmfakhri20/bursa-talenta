<?php

namespace App\Http\Controllers\Admin;

use App\Models\Pembelajaran;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class PembelajaranController extends Controller
{
    public function index()
    {
        $pembelajaran = Pembelajaran::latest()->get();
        return view('admin.pembelajaran.index', compact('pembelajaran'));
    }

    public function create()
    {
        return view('admin.pembelajaran.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'kategori' => 'required',
            'deskripsi' => 'required|string',
            'link_video' => 'required|string',
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('thumbnail')) {
            $validated['thumbnail'] = $request->file('thumbnail')->store('pembelajaran', 'public');
        }

        Pembelajaran::create($validated);

        return redirect('kelola/pembelajaran')->with('success', 'Pembelajaran berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $pembelajaran = Pembelajaran::findOrFail($id);
        return view('admin.pembelajaran.edit', compact('pembelajaran'));
    }

    public function update(Request $request, $id)
    {
        // dd($request->all());
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'kategori' => 'required',
            'deskripsi' => 'required|string',
            'link_video' => 'required|string',
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            // 'tanggal_kegiatan' => 'required|date',
        ]);

        $pembelajaran = Pembelajaran::findOrFail($id);

        if ($request->hasFile('thumbnail')) {
            if ($pembelajaran->thumbnail && Storage::disk('public')->exists($pembelajaran->thumbnail)) {
                Storage::disk('public')->delete($pembelajaran->thumbnail);
            }

            $validated['thumbnail'] = $request->file('thumbnail')->store('pembelajaran', 'public');
        }

        $pembelajaran->update($validated);

        return redirect()->route('pembelajaran.index')->with('success', 'Pembelajaran berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $pembelajaran = Pembelajaran::findOrFail($id);
        
        if ($pembelajaran->thumbnail && Storage::disk('public')->exists($pembelajaran->thumbnail)) {
            Storage::disk('public')->delete($pembelajaran->thumbnail);
        }

        $pembelajaran->delete();

        return redirect()->route('pembelajaran.index')->with('success', 'Pembelajaran berhasil dihapus.');
    }
}
