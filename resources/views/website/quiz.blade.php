@extends('website.layouts.app')

@section('website-content')
    <div class="container">
        <div class="row">
            <div class="col-lg-4 sidebar">

                <div class="widgets-container">

                    <!-- Blog Author Widget -->
                    <div class="blog-author-widget widget-item">

                        <div class="d-flex flex-column align-items-center">
                            <div class="d-flex align-items-center w-100">
                                @if (is_null($pembelajaran->thumbnail))
                                <img src="{{ url('website/assets/img/no-image.webp') }}" class="rounded-circle flex-shrink-0" alt="">    
                                @else
                                <img src="{{ url('website/assets/img/' . $pembelajaran->thumbnail) }}" class="rounded-circle flex-shrink-0" alt="">    
                                @endif

                                <div>
                                    <h4>{{ $pembelajaran->judul }}</h4>
                                </div>
                            </div>

                            <p>{{ $pembelajaran->deskripsi }}</p>
                            {{-- <p>Tanggal Daftar : {{ date('d M Y H:i:s', strtotime($user->created_at)) }}</p> --}}

                        </div>

                    </div><!--/Blog Author Widget -->

                </div>

            </div>
            <div class="col-lg-8">

                <!-- Blog Details Section -->
                <section id="blog-details" class="blog-details section">
                    <div class="container">
                        <article class="article">
                            <form method="POST" action="{{ route('elearning.jawab') }}">
                                @csrf
                                @foreach($pembelajaran->soal as $soal)
                                    <div class="mb-3">
                                        <strong>{{ $loop->iteration }}. {{ $soal->pertanyaan }}</strong><br>

                                        @foreach(['A', 'B', 'C', 'D'] as $opt)
                                            <label>
                                                <input type="radio" name="jawaban[{{ $soal->id }}]" value="{{ $opt }}">
                                                {{ $soal->{'opsi_'.strtolower($opt)} }}
                                            </label><br>
                                        @endforeach
                                    </div>
                                @endforeach

                                <button type="submit" class="btn btn-primary">Kirim Jawaban</button>
                            </form>
                        </article>

                    </div>
                </section><!-- /Blog Details Section -->

            </div>

        </div>
    </div>
@endsection
