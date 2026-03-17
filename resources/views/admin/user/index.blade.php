@extends('website.layouts.app')

@section('website-content')
    <div class="page-title">
        <div class="container d-lg-flex justify-content-between align-items-center">
            <h1 class="mb-2 mb-lg-0">Kelola Admin</h1>
            <nav class="breadcrumbs">
                <ol>
                    <li><a href="index.html">Profile</a></li>
                    <li class="current">Kelola Admin</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="container">
        <div class="row gy-4">
            <div class="col-lg-12">
                <section id="blog-details" class="blog-details section">
                    <div class="container">
                        <a href="{{ route('admin.create') }}" class="btn btn-sm btn-primary mb-3">
                            <i class="ri-add-circle-line"></i>
                            Tambah Data
                        </a>
                        <article class="article">
                            <table class="table table-bordered mt-3" id="table">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">Nama</th>
                                        <th class="text-center">Email</th>
                                        <th class="text-center">Tgl. dibuat</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($user as $key => $item)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>{{ is_null($item->created_at) ? '-' : date('d M Y', strtotime($item->created_at)) }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('admin.edit', $item->id) }}" class="btn btn-warning btn-sm">
                                                <i class="ri-file-edit-line"></i>
                                            </a>
                                            <form action="{{ route('admin.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin hapus?')">
                                                @csrf @method('DELETE')
                                                <button class="btn btn-danger btn-sm"><i class="ri-delete-bin-line"></i></button>
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