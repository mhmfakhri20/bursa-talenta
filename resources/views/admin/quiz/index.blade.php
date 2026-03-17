@extends('website.layouts.app')

@section('website-content')
    <div class="page-title">
        <div class="container d-lg-flex justify-content-between align-items-center">
            <h1 class="mb-2 mb-lg-0">Kelola Soal Quiz</h1>
            <nav class="breadcrumbs">
                <ol>
                    <li><a href="index.html">Profile</a></li>
                    <li class="current">Kelola Soal Quiz</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="container">
        <div class="row gy-4">
            <div class="col-lg-12">
                <section id="blog-details" class="blog-details section">
                    <div class="container">
                        <a href="{{ url('kelola/pembelajaran') }}" class="btn btn-sm btn-secondary mb-3">
                            <i class="ri-arrow-left-line"></i>
                            Kembali
                        </a>
                        <a href="{{ url('kelola/pembelajaran/'. $pembelajaran->id .'/soal/create') }}" class="btn btn-sm btn-primary mb-3">
                            <i class="ri-add-circle-line"></i>
                            Tambah Data
                        </a>
                        <article class="article">
                            <table class="table table-bordered mt-3" id="table">
                                <thead>
                                    <tr>
                                        <th class="w5">No</th>
                                        <th class="w5">Pertanyaan</th>
                                        <th class="w15">Jawaban</th>
                                        <th class="w15">Jawaban Benar</th>
                                        <th class="w5 text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($soal as $key => $item)
                                    <tr>
                                        <td class="w5">{{ $key + 1 }}</td>
                                        <td class="w5">{{ $item->pertanyaan }}</td>
                                        <td class="w15">
                                            <ul>
                                                <li>A: {{ $item->opsi_a }}</li>
                                                <li>B: {{ $item->opsi_b }}</li>
                                                <li>C: {{ $item->opsi_c }}</li>
                                                <li>D: {{ $item->opsi_d }}</li>
                                            </ul>
                                        </td>
                                        <td class="w15"><strong>Jawaban Benar:</strong> {{ $item->jawaban_benar }}</td>
                                        <td class="w5 text-center">
                                            <a href="{{ route('soal.edit', $item->id) }}" class="btn btn-warning btn-sm">
                                                <i class="ri-edit-box-line"></i>
                                            </a>
                                            <form action="{{ route('soal.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin hapus?')">
                                                @csrf @method('DELETE')
                                                <button class="btn btn-danger btn-sm">
                                                    <i class="ri-delete-bin-line"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </article>
                    </div>
                </section>
            </div>
        </div>
    </div>
@endsection
