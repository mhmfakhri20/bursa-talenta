<?php

namespace App\Http\Controllers\Website;

use App\Models\Kegiatan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class KegiatanController extends Controller
{
    public function index(Request $request)
    {
        $kegiatan= Kegiatan::query()
            ->when($request->kategori, function ($query, $kategori) {
                $query->where('kategori', $kategori);
            })
            ->when($request->judul, function ($query, $judul) {
                $query->where('judul', 'like', "%$judul%"); // gunakan ILIKE untuk PostgreSQL atau LIKE untuk MySQL
            })
            ->get(); 

        return view('website.kegiatan', compact('kegiatan'));
    }

    public function details($id)
    {
        $kegiatan = Kegiatan::where('id', '<>', $id)->latest()->limit(5)->get();
        $kegiatan_detail = Kegiatan::with('peserta')->findOrFail($id);
        $count_kegiatan = Kegiatan::withCount('peserta')->findOrFail($id);
        return view('website.kegiatan-details', compact('kegiatan_detail', 'kegiatan', 'count_kegiatan'));
    }

    public function daftar($id)
    {
        // dd($id);
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu');
        }

        $user = Auth::user();
        $kegiatan = Kegiatan::findOrFail($id);

        // dd($kegiatan);

        if (!$user->kegiatanDiikuti()->where('kegiatan_id', $id)->exists()) {
            $user->kegiatanDiikuti()->attach($kegiatan);
            return back()->with('success', 'Berhasil mendaftar kegiatan.');
        }

        return back()->with('info', 'Anda sudah mendaftar kegiatan ini.');
    }

    public function listKegiatan() 
    {   
        $user = Auth::user();
        $kegiatan = $user->kegiatanDiikuti()->orderBy('tanggal_daftar', 'desc')->get();
        return view('website.kegiatan_per_user', compact('kegiatan'));
    }
}
