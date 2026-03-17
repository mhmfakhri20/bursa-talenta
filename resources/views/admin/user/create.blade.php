@extends('website.layouts.app')

@section('website-content')
    <div class="page-title">
        <div class="container d-lg-flex justify-content-between align-items-center">
            <h1 class="mb-2 mb-lg-0">Tambah Admin</h1>
            <nav class="breadcrumbs">
                <ol>
                    <li><a href="index.html">Kelola Admin</a></li>
                    <li class="current">Tambah Admin</li>
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
                            <form action="{{ route('admin.store') }}" method="POST">
                                @csrf

                                <div class="mb-3">
                                    <label for="name" class="form-label">Nama</label>
                                    <input type="text" name="name" class="form-control" id="name"
                                        value="{{ old('name') }}" required>
                                </div>

                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" name="email" class="form-control" id="email"
                                        value="{{ old('email') }}" required>
                                </div>

                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" name="password" class="form-control" id="password"
                                        value="{{ old('password') }}" required>
                                </div>

                                <div class="mb-3">
                                    <label for="role" class="form-label">Role</label>
                                    <select name="role" id="role" class="form-control" required>
                                        <option value="admin">Admin</option>
                                    </select>
                                </div>

                                <button type="submit" class="btn btn-sm btn-primary">
                                    <i class="ri-save-line"></i>
                                    Simpan
                                </button>
                                <a href="{{ route('admin.index') }}" class="btn btn-sm btn-secondary">
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
