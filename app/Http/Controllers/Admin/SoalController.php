<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pembelajaran;
use App\Models\Soal;
use Illuminate\Http\Request;

class SoalController extends Controller
{
    public function index($id)
    {
        $pembelajaran_id = $id;
        $pembelajaran = Pembelajaran::findOrFail($pembelajaran_id);
        $soal = Soal::where('pembelajaran_id', $pembelajaran_id)->get();
        // dd($pembelajaran, $soal);
        return view('admin.quiz.index', compact('soal', 'pembelajaran'));
    }

    public function create($id)
    {
        $pembelajaran_id = $id;
        $pembelajaran = Pembelajaran::findOrFail($pembelajaran_id);
        $soal = Soal::where('pembelajaran_id', $pembelajaran_id)->get();
        return view('admin.quiz.create', compact('soal', 'pembelajaran'));
    }

    public function store(Request $request, $id)
    {
        $validated = $request->validate([
            'pertanyaan' => 'required|string',
            'opsi_a' => 'required|string',
            'opsi_b' => 'required|string',
            'opsi_c' => 'required|string',
            'opsi_d' => 'required|string',
            'jawaban_benar' => 'required|in:A,B,C,D',
        ]);

        $validated['pembelajaran_id'] = $id;

        Soal::create($validated);

        return redirect()->route('soal.index', $id)->with('success', 'Soal berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $soal = Soal::findOrFail($id);
        return view('admin.quiz.edit', compact('soal'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'pertanyaan' => 'required|string',
            'opsi_a' => 'required|string',
            'opsi_b' => 'required|string',
            'opsi_c' => 'required|string',
            'opsi_d' => 'required|string',
            'jawaban_benar' => 'required|in:A,B,C,D',
        ]);

        $soal = Soal::findOrFail($id);

        $pembelajaran_id = $soal->pembelajaran_id;

        $soal->update($validated);

        return redirect()->route('soal.index', $pembelajaran_id)->with('success', 'Soal berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $soal = Soal::findOrFail($id);

        $pembelajaran_id = $soal->pembelajaran_id;

        $soal->delete();

        return redirect()->route('soal.index', $pembelajaran_id)->with('success', 'Soal berhasil dihapus.');
    }
}
