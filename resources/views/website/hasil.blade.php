@extends('website.layouts.app')

@section('website-content')
    <div class="container mt-3">
        <div class="alert alert-info">
            <h4>Hasil Quiz</h4>
            <p>Jumlah soal: <strong>{{ $total }}</strong></p>
            <p>Jawaban benar: <strong>{{ $benar }}</strong></p>
            <p>Nilai akhir: <strong>{{ $nilai }}</strong></p>
        </div>

        <a href="{{ url('e-learning') }}" class="btn btn-secondary">Kembali ke Daftar Pembelajaran</a>
    </div>
@endsection
