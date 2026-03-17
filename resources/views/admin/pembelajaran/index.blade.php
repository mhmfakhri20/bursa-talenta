@extends('website.layouts.app')

@section('website-content')
    <div class="page-title">
        <div class="container d-lg-flex justify-content-between align-items-center">
            <h1 class="mb-2 mb-lg-0">Kelola Pembelajaran</h1>
            <nav class="breadcrumbs">
                <ol>
                    <li><a href="index.html">Profile</a></li>
                    <li class="current">Kelola Pembelajaran</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="container">
        <div class="row gy-4">
            <div class="col-lg-12">
                <section id="blog-details" class="blog-details section">
                    <div class="container">
                        <a href="{{ route('pembelajaran.create') }}" class="btn btn-sm btn-primary mb-3">
                            <i class="ri-add-circle-line"></i>
                            Tambah Data
                        </a>
                        <article class="article">
                            <table class="table table-bordered mt-3" id="table">
                                <thead>
                                    <tr>
                                        <th class="w5">No</th>
                                        <th class="w5">Thumbnail</th>
                                        <th class="w15">Judul</th>
                                        <th class="w10">Kategori</th>
                                        <th class="w15">Deskripsi</th>
                                        <th class="w10 text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($pembelajaran as $key => $item)
                                    <tr>
                                        <td class="w5">{{ $key + 1 }}</td>
                                        <td class="w5">
                                            @if($item->thumbnail)
                                                <img src="{{ Storage::url($item->thumbnail) }}" class="img-fluid rounded-start" alt="{{ $item->judul }}">
                                            @else
                                                <img src="{{ asset('website/assets/img/no-image.webp') }}" class="img-fluid rounded-start" alt="Default">
                                            @endif
                                        </td>
                                        <td class="w15">{{ $item->judul }}</td>
                                        <td class="w10">{{ $item->kategori }}</td>
                                        <td class="w15">{{ $item->deskripsi }}</td>
                                        <td class="w10 text-center">
                                            <a href="{{ route('soal.index', $item->id) }}" class="btn btn-info btn-sm">
                                                <i class="ri-add-line"></i>
                                            </a>
                                            <a href="{{ route('pembelajaran.edit', $item->id) }}" class="btn btn-warning btn-sm">
                                                <i class="ri-edit-box-line"></i>
                                            </a>
                                            <form action="{{ route('pembelajaran.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin hapus?')">
                                                @csrf @method('DELETE')
                                                <button class="btn btn-danger btn-sm">
                                                    <i class="ri-delete-bin-line"></i>
                                                </button>
                                            </form>
                                            {{-- <a class="btn btn-light">Delete</a> --}}
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
