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
                                @if (is_null($user->profile->photo))
                                <img src="{{ url('website/assets/img/no-image.webp') }}" class="rounded-circle flex-shrink-0" alt="">    
                                @else
                                <img src="{{ url('website/assets/img/' . $user->profile->photo) }}" class="rounded-circle flex-shrink-0" alt="">    
                                @endif

                                <div>
                                    <h4>{{ $user->name }}</h4>
                                    {{-- <div class="social-links">
                                        <a href="https://x.com/#"><i class="bi bi-twitter-x"></i></a>
                                        <a href="https://facebook.com/#"><i class="bi bi-facebook"></i></a>
                                        <a href="https://instagram.com/#"><i class="biu bi-instagram"></i></a>
                                        <a href="https://instagram.com/#"><i class="biu bi-linkedin"></i></a>
                                    </div> --}}
                                </div>
                            </div>

                            <p>Tanggal Daftar : {{ date('d M Y H:i:s', strtotime($user->created_at)) }}</p>

                        </div>

                    </div><!--/Blog Author Widget -->

                </div>

            </div>
            <div class="col-lg-8">

                <!-- Blog Details Section -->
                <section id="blog-details" class="blog-details section">
                    <div class="container">

                        <article class="article">

                            <form action="{{ route('profile.update') }}" method="POST" class="aos-init aos-animate"
                                data-aos="fade-up" data-aos-delay="200">
                                @csrf
                                @method('PUT')
                                <div class="row gy-4">
                                    
                                    <h5>Ubah Profile </h5>
                                    <div class="col-md-12">
                                        <label class="mb-1">Nama Lengkap</label>
                                        <input type="text" class="form-control form-control-sm" name="name"
                                            value="{{ old('name', $user->name) }}" >
                                    </div>

                                    <div class="col-md-6">
                                        <label class="mb-1">Tanggal Lahir</label>
                                        <input type="date" class="form-control form-control-sm" name="tanggal_lahir"
                                            value="{{ old('tanggal_lahir', $user->profile->tanggal_lahir ?? '') }}"
                                            >
                                    </div>

                                    <div class="col-md-6">
                                        <label class="mb-1">Jenis Kelamin</label>
                                        <select name="gender" class="form-control form-control-sm" >
                                            <option value="" disabled
                                                {{ old('gender', $user->profile->jenis_kelamin ?? '') == '' ? 'selected' : '' }}>
                                                -
                                                Pilih -</option>
                                            <option value="L"
                                                {{ old('gender', $user->profile->jenis_kelamin ?? '') == 'L' ? 'selected' : '' }}>
                                                Laki-laki</option>
                                            <option value="P"
                                                {{ old('gender', $user->profile->jenis_kelamin ?? '') == 'P' ? 'selected' : '' }}>
                                                Perempuan</option>
                                        </select>
                                    </div>

                                    <div class="col-md-12">
                                        <label class="mb-1">No. HP/Whatsapp</label>
                                        <input type="text" class="form-control form-control-sm" name="phone"
                                            value="{{ old('phone', $user->profile->no_telp ?? '') }}" >
                                    </div>

                                    <div class="col-md-12">
                                        <label class="mb-1">Alamat</label>
                                        <input type="text" class="form-control form-control-sm" name="address"
                                            value="{{ old('address', $user->profile->alamat ?? '') }}" >
                                    </div>

                                    <div class="col-md-12">
                                        <label class="mb-1">Status</label>
                                        <select name="status" class="form-control form-control-sm" >
                                            <option value="" disabled
                                                {{ old('status', $user->profile->status ?? '') == '' ? 'selected' : '' }}>-
                                                Pilih -
                                            </option>
                                            <option value="mahasiswa"
                                                {{ old('status', $user->profile->status ?? '') == 'mahasiswa' ? 'selected' : '' }}>
                                                Mahasiswa</option>
                                            <option value="freelancer"
                                                {{ old('status', $user->profile->status ?? '') == 'freelancer' ? 'selected' : '' }}>
                                                Freelancer</option>
                                            <option value="bekerja"
                                                {{ old('status', $user->profile->status ?? '') == 'bekerja' ? 'selected' : '' }}>
                                                Sudah Bekerja</option>
                                        </select>
                                    </div>

                                    <div class="col-md-12">
                                        <label class="mb-1">Link CV/Profile Linkedin</label>
                                        <input type="url" class="form-control form-control-sm" name="linkedin"
                                            value="{{ old('linkedin', $user->profile->profile_linkedin ?? '') }}">
                                    </div>

                                    <hr>

                                    <h5>Ubah Password </h5>
                                    <div class="col-md-12">
                                        <label class="mb-1">Password Sebelumnya</label>
                                        <input type="password" class="form-control form-control-sm" name="pass_sebelumnya">
                                    </div>

                                    <div class="col-md-12">
                                        <label class="mb-1">Password Baru</label>
                                        <input type="password" class="form-control form-control-sm" name="pass_baru">
                                    </div>

                                    <div class="col-md-12">
                                        <label class="mb-1">Konfirmasi Password Baru</label>
                                        <input type="password" class="form-control form-control-sm" name="pass_konfirmasi">
                                    </div>

                                    <div class="col-md-12 text-center">
                                        <button type="submit" class="btn btn-primary btn-sm">
                                            <i class="ri-save-line"></i>
                                            Update Data
                                        </button>
                                    </div>

                                </div>
                            </form>

                        </article>

                    </div>
                </section><!-- /Blog Details Section -->

            </div>
        </div>
    </div>
@endsection
