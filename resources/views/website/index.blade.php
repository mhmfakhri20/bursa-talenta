@extends('website.layouts.app')

@section('website-content')
<!-- Slider Section -->
    <section id="slider" class="slider section">

        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <div class="swiper init-swiper">

                <script type="application/json" class="swiper-config">
                {
                "loop": true,
                "speed": 600,
                "autoplay": {
                    "delay": 5000
                },
                "slidesPerView": 1,
                "centeredSlides": true,
                "pagination": {
                    "el": ".swiper-pagination",
                    "type": "bullets",
                    "clickable": true
                },
                "navigation": {
                    "nextEl": ".swiper-button-next",
                    "prevEl": ".swiper-button-prev"
                }
                }
                </script>

                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <img src="{{ asset('website/assets/img/slide1.png') }}" class="img-fluid w-100 slider-img" alt="Slide 1">
                    </div>
                    <div class="swiper-slide">
                        <img src="{{ asset('website/assets/img/slide2.png') }}" class="img-fluid w-100 slider-img" alt="Slide 2">
                    </div>
                    <div class="swiper-slide">
                        <img src="{{ asset('website/assets/img/slide3.png') }}" class="img-fluid w-100 slider-img" alt="Slide 3">
                    </div>
                </div>

                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-pagination"></div>
            </div>
        </div>

    </section>
    <!-- /Slider Section -->

    <!-- Culture Category Section -->
    <section id="culture-category" class="culture-category section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <div class="section-title-container d-flex align-items-center justify-content-between">
                <h3>E-Learning</h3>
                <p><a href="e-learning">Lihat Semua</a></p>
            </div>
        </div><!-- End Section Title -->

        <div class="container py-4" data-aos="fade-up" data-aos-delay="100">
            <div class="row">
            @foreach ($pembelajaran as $item)
                <div class="col-md-3 mb-4 d-flex align-items-stretch">
                    <div class="card" style="width: 100%">
                        @if (!$item->thumbnail)
                            <img src="{{ url('website/assets/img/no-image.webp') }}" class="card-img-top img-fluid" alt="" style="width: 100%; height: 180px; object-fit: cover;">    
                        @else
                            <img src="{{ Storage::url($item->thumbnail) }}" class="card-img-top img-fluid" alt="{{ $item->judul }}" style="width: 100%; height: 180px; object-fit: cover;">    
                        @endif
                        <div class="card-body d-flex flex-column">
                            <h6 class="card-title mb-2">{{ $item->judul }}</h6>
                            <p class="card-text flex-grow-1">
                                {{ Str::limit($item->deskripsi, 100) }}
                            </p>
                            <a href="{{ url('e-learning/' . $item->id) }}" class="btn btn-primary mt-auto">Lihat Detail</a>
                        </div>
                    </div>
                </div>        
            @endforeach
            </div>

        </div>

    </section><!-- /Culture Category Section -->

    <section id="culture-category" class="culture-category section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <div class="section-title-container d-flex align-items-center justify-content-between">
                <h3>Kegiatan</h3>
                <p><a href="kegiatan">Lihat Semua</a></p>
            </div>
        </div><!-- End Section Title -->

        <div class="container py-4" data-aos="fade-up" data-aos-delay="100">
            <div class="row">
            @foreach ($kegiatan as $item)
                <div class="col-md-3 mb-4 d-flex align-items-stretch">
                    <div class="card" style="width: 100%">
                        @if (!$item->thumbnail)
                            <img src="{{ url('website/assets/img/no-image.webp') }}" class="card-img-top img-fluid" alt="" style="width: 100%; height: 180px; object-fit: cover;">    
                        @else
                            <img src="{{ Storage::url($item->thumbnail) }}" class="card-img-top img-fluid" alt="{{ $item->judul }}" style="width: 100%; height: 180px; object-fit: cover;">    
                        @endif
                        <div class="card-body d-flex flex-column">
                            <h6 class="card-title mb-2">{{ $item->judul }}</h6>
                            <p class="card-text flex-grow-1">
                                {{ Str::limit($item->deskripsi, 100) }}
                            </p>
                            <a href="{{ url('kegiatan/' . $item->id) }}" class="btn btn-primary mt-auto">Lihat Detail</a>
                        </div>
                    </div>
                </div>        
            @endforeach
            </div>

        </div>

    </section><!-- /Culture Category Section -->
@endsection
