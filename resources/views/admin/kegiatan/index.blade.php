@extends('website.layouts.app')

@section('website-content')
    <div class="page-title">
        <div class="container d-lg-flex justify-content-between align-items-center">
            <h1 class="mb-2 mb-lg-0">Kelola Kegiatan</h1>
            <nav class="breadcrumbs">
                <ol>
                    <li><a href="index.html">Profile</a></li>
                    <li class="current">Kelola Kegiatan</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="container">
        <div class="row gy-4">
            <div class="col-lg-12">
                <section id="blog-details" class="blog-details section">
                    <div class="container">
                        <a href="{{ url('kelola/kegiatan/create') }}" class="btn btn-sm btn-primary mb-3">
                            <i class="ri-add-circle-line"></i>
                            Tambah Data
                        </a>
                        <article class="article">
                            <table class="table table-bordered mt-3" id="table">
                                <thead>
                                    <tr>
                                        {{-- <th class="w5">No</th> --}}
                                        <th class="">Thumbnail</th>
                                        <th class="w15">Judul</th>
                                        <th class="">Kategori</th>
                                        <th class="">Deskripsi</th>
                                        <th class="w15">Tanggal Kegiatan</th>
                                        <th class="w15">Link Zoom</th>
                                        <th class="w15 text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($kegiatan as $key => $item)
                                    <tr>
                                        {{-- <td class="w5">{{ $key + 1 }}</td> --}}
                                        <td class="">
                                            @if($item->thumbnail)
                                                <img src="{{ Storage::url($item->thumbnail) }}" class="img-fluid rounded-start" alt="{{ $item->judul }}">
                                            @else
                                                <img src="{{ asset('website/assets/img/no-image.webp') }}" class="img-fluid rounded-start" alt="Default">
                                            @endif
                                        </td>
                                        <td class="w15">{{ $item->judul }}</td>
                                        <td class="">{{ $item->kategori }}</td>
                                        <td class="">{{ $item->deskripsi }}</td>
                                        <td class="w15">{{ date('d M Y', strtotime($item->tanggal_kegiatan)) }}</td>
                                        <td class="">{{ $item->zoom_url }}</td>
                                        <td class="w15 text-center">
                                            <button class="btn btn-secondary btn-sm btn-detail" data-id="{{ $item->id }}" id="btn-detail">
                                                <i class="ri-information-line"></i>
                                            </button>
                                            <a href="{{ route('kegiatan.edit', $item->id) }}" class="btn btn-warning btn-sm">
                                                <i class="ri-file-edit-line"></i>
                                            </a>
                                            <form action="{{ route('kegiatan.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin hapus?')">
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

    @include('admin.kegiatan.detail-peserta')
@endsection

@section('script')
    <script>
        $(".btn-detail").on("click", function() {
            let id = $(this).data("id");

            $.ajax({
                url: '{{ url('kelola/kegiatan/getpeserta') }}',
                method: 'post',
                data: {
                    _token: "{{ csrf_token() }}",
                    id: id
                },
                success: function(response) {
                    $("#detailModal").modal("show");
                    
                    let peserta = response.peserta;
                    let data = response;
                    
                    let row = '';
                    if (peserta.length > 0) {
                        for (let index = 0; index < peserta.length; index++) {
                            row += `
                                <tr>
                                    <td>${index + 1}</td>
                                    <td>${peserta[index].name}</td>
                                    <td>${moment(peserta[index].created_at).format("DD-MM-YYYY")}</td>
                                </tr>`;
                            
                        }
                    } else {
                        row += `<b>Tidak ada data</b>`;
                    }

                    $("#tbodyPeserta").html(row);
                }
            })
        })
    </script>
@endsection
