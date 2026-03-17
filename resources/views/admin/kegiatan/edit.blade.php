@extends('website.layouts.app')

@section('website-content')
    <div class="page-title">
        <div class="container d-lg-flex justify-content-between align-items-center">
            <h1 class="mb-2 mb-lg-0">Edit Kegiatan</h1>
            <nav class="breadcrumbs">
                <ol>
                    <li><a href="index.html">Profile</a></li>
                    <li class="current">Edit Kegiatan</li>
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
                            <form action="{{ route('kegiatan.update', $kegiatan->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                {{-- <input type="hidden" name="id"> --}}
                                <div class="mb-3">
                                    <label for="judul" class="form-label">Judul Kegiatan</label>
                                    <input type="text" name="judul" class="form-control" id="judul"
                                        value="{{ old('judul', $kegiatan->judul) }}" required>
                                </div>

                                <div class="mb-3">
                                    <label for="kategori" class="form-label">Kategori</label>
                                    <select name="kategori" id="kategori" class="form-control" required>
                                        <option value="">Pilih</option>
                                        <option value="Soft Skill" {{ old('kategori', $kegiatan->kategori) == 'Soft Skill' ? 'selected' : '' }}>Soft Skill</option>
                                        <option value="Hard Skill" {{ old('kategori', $kegiatan->kategori) == 'Hard Skill' ? 'selected' : '' }}>Hard Skill</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="deskripsi" class="form-label">Deskripsi</label>
                                    <textarea name="deskripsi" class="form-control" rows="5" required>{{ old('deskripsi', $kegiatan->deskripsi) }}</textarea>
                                </div>

                                <div class="mb-3">
                                    <label for="tanggal_kegiatan" class="form-label">Tanggal Kegiatan</label>
                                    <input type="date" name="tanggal_kegiatan" class="form-control"
                                        value="{{ old('tanggal_kegiatan', $kegiatan->tanggal_kegiatan) }}" required>
                                </div>

                                <div class="mb-3">
                                    <label for="zoom_url" class="form-label">Link Zoom/Google Meeting</label>
                                    <input type="url" name="zoom_url" class="form-control" value="{{ old('zoom_url', $kegiatan->zoom_url) }}">
                                </div>

                                <div class="mb-3">
                                    <label for="thumbnail" class="form-label">Ganti Thumbnail (Opsional)</label>
                                    <input type="file" name="thumbnail" class="form-control" accept="image/*">
                                    <br>
                                    @if($kegiatan->thumbnail)
                                        <img src="{{ Storage::url($kegiatan->thumbnail) }}" class="img-thumbnail" style="max-height: 100px;" alt="{{ $kegiatan->judul }}">
                                        <p class="text-muted mb-0"><small>Thumbnail saat ini</small></p>
                                    @else
                                        <img src="{{ asset('website/assets/img/no-image.webp') }}" class="img-thumbnail" style="max-height: 100px;" alt="Default">
                                        <p class="text-muted mb-0"><small>Thumbnail saat ini</small></p>
                                    @endif
                                </div>

                                <button type="submit" class="btn btn-sm btn-primary">
                                    <i class="ri-save-line"></i>
                                    Update
                                </button>

                                <a href="{{ url('kelola/kegiatan') }}" class="btn btn-sm btn-secondary">
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
