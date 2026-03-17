<?php

namespace App\Http\Controllers\Website;

use App\Models\Kegiatan;
use App\Models\Pembelajaran;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomepageController extends Controller
{
    public function index()
    {
        $pembelajaran = Pembelajaran::latest()->limit(8)->get();
        // dd($pembelajaran);
        $kegiatan = Kegiatan::latest()->limit(8)->get();
        return view('website.index', compact('pembelajaran', 'kegiatan'));
    }
}
