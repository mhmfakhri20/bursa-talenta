@extends('website.layouts.app')

@section('website-content')
    <div class="page-title">
        <div class="container d-lg-flex justify-content-between align-items-center">
            <h1 class="mb-2 mb-lg-0">Daftar Pembelajaran</h1>
            <nav class="breadcrumbs">
                <ol>
                    <li><a href="index.html">Profile</a></li>
                    <li class="current">Aktivitas Pembelajaran</li>
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
                                        <th>Judul Materi</th>
                                        <th>Quiz</th>
                                        <th>Jumlah Soal</th>
                                        <th>Jumlah Benar</th>
                                        <th>Nilai Akhir</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($result as $key => $item)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>
                                                @if (!$item['pembelajaran']->thumbnail)
                                                <img src="{{ url('website/assets/img/no-image.webp') }}" class="img-fluid" alt="{{ $item['pembelajaran']->judul }}" style="width: 60px; height: 60px; object-fit: cover;">
                                                @else
                                                <img src="{{ Storage::url($item['pembelajaran']->thumbnail) }}" class="img-fluid" alt="{{ $item['pembelajaran']->judul }}" style="width: 60px; height: 60px; object-fit: cover;">
                                                @endif
                                            </td>
                                            <td>{{ $item['pembelajaran']->judul }}</td>
                                            <td>
                                                <a href="{{ url('e-learning/' . $item['pembelajaran']->id) }}">Link</a>
                                            </td>
                                            <td>{{ $item['total'] }}</td>
                                            <td>{{ $item['benar'] }}</td>
                                            <td>{{ $item['nilai'] }}</td>
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
