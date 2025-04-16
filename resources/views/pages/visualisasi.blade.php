@extends('layouts.app')
@section('title', 'Visualisasi Data')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold mb-4">Visualisasi Data</h4>

    <div class="row">
        {{-- Card Pengguna --}}
        <div class="col-md-4 mb-4">
            <div class="card position-relative overflow-hidden text-white" style="height: 500px;">
                <img src="{{ asset('assets/img/img_visual/chart1_pengguna.png') }}" class="position-absolute w-100 h-100" style="object-fit: cover; opacity: 0.3;" alt="Chart">
                <div class="card-body d-flex flex-column justify-content-center align-items-center text-center h-100 position-relative">
                    <h5 class="fw-bold text-dark">Visualisasi Data Pengguna</h5>
                    <a href="{{ url('/visualisasi/pengguna') }}" class="btn btn-warning mt-3">
                        Lihat Selengkapnya →
                    </a>
                </div>
            </div>
        </div>

        {{-- Card Laporan --}}
        <div class="col-md-4 mb-4">
            <div class="card position-relative overflow-hidden text-white" style="height: 500px;">
                <img src="{{ asset('assets/img/img_visual/chart2_laporan.png') }}" class="position-absolute w-100 h-100" style="object-fit: cover; opacity: 0.3;" alt="Chart">
                <div class="card-body d-flex flex-column justify-content-center align-items-center text-center h-100 position-relative">
                    <h5 class="fw-bold text-dark">Visualisasi Data Laporan</h5>
                    <a href="{{ url('/visualisasi/laporan') }}" class="btn btn-warning mt-3">
                        Lihat Selengkapnya →
                    </a>
                </div>
            </div>
        </div>

        {{-- Card Sampah --}}
        <div class="col-md-4 mb-4">
            <div class="card position-relative overflow-hidden text-white" style="height: 500px;">
                <img src="{{ asset('assets/img/img_visual/chart3_sampah.png') }}" class="position-absolute w-100 h-100" style="object-fit: cover; opacity: 0.3;" alt="Chart">
                <div class="card-body d-flex flex-column justify-content-center align-items-center text-center h-100 position-relative">
                    <h5 class="fw-bold text-dark">Visualisasi Data Sampah</h5>
                    <a href="{{ url('/visualisasi/sampah') }}" class="btn btn-warning mt-3">
                        Lihat Selengkapnya →
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
