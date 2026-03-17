@extends('website.layouts.app')

@section('website-content')
    <div class="page-title">
        <div class="container d-lg-flex justify-content-between align-items-center">
            <h1 class="mb-2 mb-lg-0">Quiz Baru</h1>
            <nav class="breadcrumbs">
                <ol>
                    <li><a href="index.html">Profile</a></li>
                    <li class="current">Quiz Baru</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="container">
        <div class="row gy-4">
            <div class="col-lg-12">
                <section id="blog-details" class="blog-details section">
                    <div class="container">
                        <article class="article">
                            <form action="{{ route('soal.store', $pembelajaran->id) }}" method="POST">
                                @csrf

                                <div class="mb-3">
                                    <label for="pertanyaan" class="form-label">Pertanyaan</label>
                                    <textarea name="pertanyaan" class="form-control" rows="3" required>{{ old('pertanyaan') }}</textarea>
                                </div>

                                @foreach (['a', 'b', 'c', 'd'] as $opt)
                                    <div class="mb-3">
                                        <label for="opsi_{{ $opt }}" class="form-label">Opsi {{ strtoupper($opt) }}</label>
                                        <input type="text" name="opsi_{{ $opt }}" class="form-control" required value="{{ old('opsi_'.$opt) }}">
                                    </div>
                                @endforeach

                                <div class="mb-3">
                                    <label class="form-label">Jawaban Benar</label>
                                    <select name="jawaban_benar" class="form-select" required>
                                        <option value="">Pilih</option>
                                        @foreach (['A','B','C','D'] as $val)
                                            <option value="{{ $val }}" {{ old('jawaban_benar') == $val ? 'selected' : '' }}>{{ $val }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <button class="btn btn-sm btn-primary" type="submit">
                                    <i class="ri-save-line"></i>
                                    Simpan
                                </button>
                                <a href="{{ route('soal.index', $pembelajaran) }}" class="btn btn-sm btn-secondary">
                                    <i class="ri-arrow-left-line"></i>
                                    Kembali
                                </a>
                            </form>
                        </article>
                    </div>
                </section>
            </div><!-- End Team Member -->
        </div>
    </div>
@endsection
