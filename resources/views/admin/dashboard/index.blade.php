@extends('website.layouts.app')

@section('website-content')
    <div class="page-title">
        <div class="container d-lg-flex justify-content-between align-items-center">
            <h1 class="mb-2 mb-lg-0">Dashboard</h1>
        </div>
    </div>

    <div class="container">
        <div class="row gy-4 py-4">

    <div class="col-md-3">
        <div class="card text-white mb-3" style="background-color: #4a69bd;">
            <div class="card-body d-flex align-items-center">
                <div class="me-3">
                    <i class="bi bi-calendar2-event-fill fs-1"></i>
                </div>
                <div>
                    <h6 class="card-title mb-1">Total Kegiatan</h6>
                    <h3 class="mb-0 text-white">{{ $totalKegiatan }}</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card text-white mb-3" style="background-color: #38ada9;">
            <div class="card-body d-flex align-items-center">
                <div class="me-3">
                    <i class="bi bi-book-fill fs-1"></i>
                </div>
                <div>
                    <h6 class="card-title mb-1">Total Pembelajaran</h6>
                    <h3 class="mb-0 text-white">{{ $totalPembelajaran }}</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card text-white mb-3" style="background-color: #78e08f;">
            <div class="card-body d-flex align-items-center">
                <div class="me-3">
                    <i class="bi bi-people-fill fs-1"></i>
                </div>
                <div>
                    <h6 class="card-title mb-1">Total Pengguna</h6>
                    <h3 class="mb-0 text-white">{{ $totalPeserta }}</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card text-white mb-3" style="background-color: #e55039;">
            <div class="card-body d-flex align-items-center">
                <div class="me-3">
                    <i class="bi bi-person-gear fs-1"></i>
                </div>
                <div>
                    <h6 class="card-title mb-1">Total Admin</h6>
                    <h3 class="mb-0 text-white">{{ $totalAdmin }}</h3>
                </div>
            </div>
        </div>
    </div>

</div>


        <div class="row gy-4">
            <div class="col-md-6">
                <div class="card ">
                    <div class="card-body">
                        <table class="table table-sm table-hover table-striped small">
                            <thead class="text-sm">
                                <tr>
                                    <th>#</th>
                                    <th class="text-center">Judul Pembelajaran</th>
                                    <th class="text-center">Jumlah Soal</th>
                                </tr>
                            </thead>
                            <tbody class="text-sm">
                                @foreach ($pembelajaran as $key => $item)
                                    {{-- {{ $item }} --}}
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $item->judul }}</td>
                                        <td class="text-center">{{ $item->soal_count }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card ">
                    <div class="card-body">
                        <table class="table table-sm table-hover table-striped small">
                            <thead class="text-sm">
                                <tr>
                                    <th>#</th>
                                    <th class="text-center">Nama Kegiatan</th>
                                    <th class="text-center">Jumlah Peserta</th>
                                </tr>
                            </thead>
                            <tbody class="text-sm">
                                @foreach ($kegiatan as $key => $item)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td class="text-center">{{ $item->judul }}</td>
                                        <td class="text-center">{{ $item->peserta_count }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
@endsection
