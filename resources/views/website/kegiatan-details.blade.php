@extends('website.layouts.app')

@section('website-content')
    <div class="container">
        <div class="row">
            <div class="col-lg-8">

                <!-- Blog Details Section -->
                <section id="blog-details" class="blog-details section">
                    <div class="container">

                        <article class="article">

                            <div class="post-img">
                                @if (!$kegiatan_detail->thumbnail)
                                <img src="{{ url('website/assets/img/no-image.webp') }}" class="img-fluid" alt="">    
                                @else
                                <img src="{{ Storage::url($kegiatan_detail->thumbnail) }}" class="img-fluid" alt="">    
                                @endif
                            </div>

                            <h2 class="title">{{ $kegiatan_detail->judul }}</h2>

                            <div class="meta-top">
                                <ul>
                                    <li class="d-flex align-items-center"><i class="bi bi-person"></i> <a
                                            href="blog-details.html">{{ $count_kegiatan->peserta_count }}</a></li>
                                    <li class="d-flex align-items-center"><i class="bi bi-clock"></i> <a
                                            href="blog-details.html"><time datetime="2020-01-01">{{ \Carbon\Carbon::parse($kegiatan_detail->tanggal_kegiatan)->format('d M Y') }}</time></a></li>
                                </ul>
                            </div><!-- End meta top -->

                            <div class="content">
                                <p>{{ $kegiatan_detail->deskripsi }}</p>
                            </div><!-- End post content -->

                            @guest
                                <button class="btn btn-primary btn-sm" onclick="showLoginModal()">
                                    <i class="ri-save-line"></i>
                                    Daftar Kegiatan
                                </button>
                            @endguest

                            @auth
                                <form method="POST" action="{{ route('kegiatan.daftar', $kegiatan_detail->id) }}">
                                    @csrf
                                    <button type="submit" class="btn btn-primary btn-sm">
                                        <i class="ri-save-line"></i>
                                        Daftar Kegiatan
                                    </button>
                                </form>
                            @endauth
                        </article>

                    </div>
                </section><!-- /Blog Details Section -->

            </div>

            <div class="col-lg-4 sidebar">
                <div class="widgets-container">
                    <!-- Recent Posts Widget -->
                    <div class="recent-posts-widget widget-item">
                        <h3 class="widget-title">Kegiatan Lainnya</h3>
                        @foreach ($kegiatan as $item)
                        <div class="post-item">
                            @if (!$item->thumbnail)
                            <img src="{{ url('website/assets/img/no-image.webp') }}" class="flex-shrink-0" alt="">    
                            @else
                            <img src="{{ Storage::url($item->thumbnail) }}" class="flex-shrink-0" alt="">    
                            @endif
                            <div>
                                <h4><a href="{{ url('kegiatan/' . $item->id ) }}">{{ $item->judul }}</a></h4>
                                <time datetime="2020-01-01">{{ \Carbon\Carbon::parse($item->tanggal_kegiatan)->format('d M Y') }}</time>
                            </div>
                        </div><!-- End recent post item-->
                        @endforeach
                    </div><!--/Recent Posts Widget -->

                </div>

            </div>

        </div>
    </div>
@endsection