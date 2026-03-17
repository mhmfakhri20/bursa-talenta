@extends('website.layouts.app')

@section('website-content')
    <div class="page-title">
        <div class="container d-lg-flex justify-content-between align-items-center">
            <h1 class="mb-2 mb-lg-0">Daftar Kegiatan</h1>
            <nav class="breadcrumbs">
                <ol>
                    <li><a href="index.html">Profile</a></li>
                    <li class="current">Aktivitas Kegiatan</li>
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

                            <table class="table table-bordered mt-3" id="table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Thumbnail</th>
                                        <th>Judul Kegiatan</th>
                                        <th>Tanggal Kegiatan</th>
                                        <th>Tautan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($kegiatan as $key => $item)
                                    {{-- {{ dd($item) }} --}}
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>
                                                @if (!$item->thumbnail)
                                                <img src="{{ url('website/assets/img/no-image.webp') }}" class="img-fluid" alt="{{ $item->judul }}" style="width: 60px; height: 60px; object-fit: cover;">
                                                @else
                                                <img src="{{ Storage::url($item->thumbnail) }}" class="img-fluid" alt="{{ $item->judul }}" style="width: 60px; height: 60px; object-fit: cover;">
                                                @endif
                                            </td>
                                            <td>{{ $item->judul }}</td>
                                            <td>{{ date('d M Y', strtotime($item->tanggal_kegiatan)) }}</td>
                                            <td>
                                                @if ($item->zoom_url)
                                                <a href="{{ $item->zoom_url }}" target="_blank">Masuk zoom/google meeting</a> 
                                                @else
                                                <a href="{{ url('kegiatan/' . $item->id) }}">Detail Kegiatan</a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </article>

                    </div>
                </section>
            </div><!-- End Team Member -->
        </div>
    </div>
@endsection
