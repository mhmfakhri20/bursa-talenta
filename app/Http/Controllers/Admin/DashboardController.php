<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kegiatan;
use App\Models\Pembelajaran;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() 
    {
        $totalKegiatan = Kegiatan::count();
        $totalPembelajaran = Pembelajaran::count();
        $totalPeserta = User::where('role', 'pengguna')->count();
        $totalAdmin = User::where('role', 'admin')->count();

        $kegiatan = Kegiatan::withCount('peserta')
            // ->latest()
            ->orderBy('peserta_count', 'desc')
            ->limit(5)
            ->get();

        $kegiatan_count = $kegiatan->sum('peserta_count');

        $pembelajaran = Pembelajaran::withCount('soal')
            ->orderBy('soal_count', 'desc')
            ->limit(5)
            ->get();

        $pembelajaran_count = $pembelajaran->sum('soal_count');
        // dd($pembelajaran_count);

        // dd($kegiatan_count);
        return view('admin.dashboard.index', compact('totalKegiatan', 'totalPembelajaran', 'totalPeserta', 'totalAdmin', 'kegiatan', 'kegiatan_count', 'pembelajaran', 'pembelajaran_count'));
    }
}
