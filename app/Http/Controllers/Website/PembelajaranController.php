<?php

namespace App\Http\Controllers\Website;

use App\Models\Soal;
use App\Models\UserJawaban;
use App\Models\Pembelajaran;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PembelajaranController extends Controller
{
    public function index(Request $request)
    {
        $pembelajaran = Pembelajaran::query()
            ->when($request->kategori, function ($query, $kategori) {
                $query->where('kategori', $kategori);
            })
            ->when($request->judul, function ($query, $judul) {
                $query->where('judul', 'like', "%$judul%"); // gunakan ILIKE untuk PostgreSQL atau LIKE untuk MySQL
            })
            ->get();

        return view('website.pembelajaran', compact('pembelajaran'));
    }

    public function details($id)
    {
        $pembelajaran_detail = Pembelajaran::withCount('soal')->findOrFail($id);
        $pembelajaran = Pembelajaran::where('id', '<>', $id)->latest()->limit(5)->get();

        // Ambil ID video dari URL YouTube
        $youtubeLink = $pembelajaran_detail->link_video;
        $youtubeId = null;

        if ($youtubeLink) {
            parse_str(parse_url($youtubeLink, PHP_URL_QUERY), $query);
            $youtubeId = $query['v'] ?? null;
        }

        return view('website.pembelajaran-details', compact('pembelajaran', 'pembelajaran_detail', 'youtubeId'));
    }

    public function quiz($id)
    {
        $pembelajaran = Pembelajaran::with('soal')->findOrFail($id);

        // Jika user belum login, arahkan tetap ke halaman quiz
        if (!Auth::check()) {
            return view('website.quiz', compact('pembelajaran'));
        }

        // Ambil semua ID soal untuk pembelajaran ini
        $soalIds = $pembelajaran->soal->pluck('id');

        // Cek apakah user sudah menjawab semua soal ini
        $userJawabanCount = UserJawaban::where('user_id', Auth::id())
            ->whereIn('soal_id', $soalIds)
            ->count();

        // Jika sudah pernah mengisi (misalnya semua soal terjawab), arahkan ke halaman hasil
        if ($userJawabanCount >= $soalIds->count()) {
            // Hitung jumlah benar
            $jawabanUser = UserJawaban::where('user_id', auth()->id())
                ->whereIn('soal_id', $soalIds)
                ->get();

            $benar = 0;
            foreach ($jawabanUser as $jawaban) {
                if ($jawaban->jawaban === $jawaban->soal->jawaban_benar) {
                    $benar++;
                }
            }

            $total = $soalIds->count();
            $nilai = round(($benar / $total) * 100, 2);

            return view('website.hasil', compact('nilai', 'benar', 'total'));
        }

        return view('website.quiz', compact('pembelajaran'));
    }

    public function submitJawaban(Request $request)
    {
        // dd($request->all());
        $data = $request->validate([
            'jawaban' => 'required|array',
            'jawaban.*' => 'in:A,B,C,D',
        ]);

        $user = Auth::user();
        $benar = 0;
        $total = count($data['jawaban']);

        foreach ($data['jawaban'] as $soal_id => $jawaban) {
            $soal = Soal::find($soal_id);

            // Simpan jawaban
            UserJawaban::updateOrCreate(
                [
                    'user_id' => $user->id, 
                    'soal_id' => $soal_id
                ],
                [
                    'jawaban' => $jawaban
                ]
            );

            // Cek jawaban
            if ($soal && $soal->jawaban_benar === $jawaban) {
                $benar++;
            }
        }

        $nilai = round(($benar / $total) * 100, 2);

        return view('website.hasil', compact('nilai', 'benar', 'total'));
    }

    public function listPembelajaran() 
    {   
        $user = Auth::user();
        
        // Ambil semua pembelajaran yang diikuti user
        $pembelajaran = Pembelajaran::whereHas('soal.jawaban', function ($q) use ($user) {
            $q->where('user_id', $user->id);
        })->with(['soal.jawaban' => function ($q) use ($user) {
            $q->where('user_id', $user->id);
        }])->get();

        // Hitung nilai per pembelajaran
        $result = [];

        foreach ($pembelajaran as $item) {
            $total = $item->soal->count();
            $benar = 0;

            foreach ($item->soal as $soal) {
                $jawabanUser = $soal->jawaban->first();

                if ($jawabanUser && $jawabanUser->jawaban === $soal->jawaban_benar) {
                    $benar++;
                }
            }

            $nilai = $total > 0 ? round(($benar / $total) * 100, 2) : 0;

            $result[] = [
                'pembelajaran' => $item,
                'total' => $total,
                'benar' => $benar,
                'nilai' => $nilai,
            ];

            // dd($result);
        }

        return view('website.pembelajaran_per_user', compact('result'));
    }
}
