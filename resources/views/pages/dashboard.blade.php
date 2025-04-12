@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <!-- Tiga Container Horizontal -->
    <div class="row mb-4">
        <!-- Total Sopir -->
        <div class="col-md-4 col-lg-4 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="avatar flex-shrink-0 me-3">
                            <span class="avatar-initial rounded bg-label-success">
                                <i class="bx bxs-truck"></i>
                            </span>
                        </div>
                        <div>
                            <span class="d-block mb-1">Data Sopir</span>
                            <h4 class="card-title mb-0">10 Sopir</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Total User -->
        <div class="col-md-4 col-lg-4 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="avatar flex-shrink-0 me-3">
                            <span class="avatar-initial rounded bg-label-warning">
                                <i class="bx bx-user"></i>
                            </span>
                        </div>
                        <div>
                            <span class="d-block mb-1">Data User</span>
                            <h4 class="card-title mb-0">50 User</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Laporan Masuk Harian -->
        <div class="col-md-4 col-lg-4 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="avatar flex-shrink-0 me-3">
                            <span class="avatar-initial rounded bg-label-info">
                                <i class="bx bxs-report"></i>
                            </span>
                        </div>
                        <div>
                            <span class="d-block mb-1">Laporan Masuk Harian</span>
                            <h4 class="card-title mb-0">5 Laporan</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
    </div>

    <!-- Peta, Berita Terbaru, dan Laporan Terbaru -->
    <div class="row">
        <!-- Peta -->
        <div class="col-lg-8 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Peta Lokasi Sampah</h5>
                    <div id="map" style="height: 400px;"></div>
                </div>
            </div>
        </div>
        <!-- Berita Terbaru dan Laporan Terbaru -->
        <div class="col-lg-4 mb-4">
            <!-- Berita Terbaru -->
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Berita Terbaru</h5>
                </div>
                <div class="card-body">
                    @forelse ($beritaTerbaru as $berita)
                        <div class="d-flex mb-3">
                            <div class="avatar flex-shrink-0 me-3">
                                <img src="{{ Storage::url($berita->foto) }}" alt="{{ $berita->judul_berita }}" class="rounded" style="width: 40px; height: 40px; object-fit: cover;">
                            </div>
                            <div>
                                <h6 class="mb-1">{{ Str::limit($berita->judul_berita, 50) }}</h6>
                                <p class="mb-0 text-muted">{{ Str::limit($berita->deskripsi, 30) }}</p>
                            </div>
                        </div>
                    @empty
                        <p class="text-muted">Belum ada berita terbaru.</p>
                    @endforelse
                    <a href="{{ route('riwayat-berita.index') }}" class="btn btn-outline-primary btn-sm d-block">Lihat Semua Berita</a>
                </div>
            </div>

            <!-- Laporan Terbaru (UI Saja dengan Placeholder) -->
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Laporan Terbaru</h5>
                </div>
                <div class="card-body">
                    <!-- Laporan 1 -->
                    <div class="d-flex mb-3">
                        <div class="avatar flex-shrink-0 me-3">
                            <img src="https://images.unsplash.com/photo-1600585154340-be6161a56a0c?w=40&h=40&fit=crop" alt="Laporan 1" class="rounded" style="width: 40px; height: 40px; object-fit: cover;">
                        </div>
                        <div>
                            <h6 class="mb-1">Tumpukan Sampah di Jalan Utama</h6>
                            <p class="mb-0 text-muted">Sampah menumpuk di jalan...</p>
                        </div>
                    </div>
                    <!-- Laporan 2 -->
                
                    <a href="#" class="btn btn-outline-primary btn-sm d-block">Lihat Semua Laporan</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<!-- Memuat Leaflet CSS dan JS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<script>
    // Inisialisasi peta menggunakan Leaflet
    var map = L.map('map').setView([-8.1667, 113.6910], 12); // Koordinat Kabupaten Jember

    // Tambahkan tile layer dari OpenStreetMap
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    // Tambahkan marker (contoh lokasi sampah)
    L.marker([-8.1667, 113.6910]).addTo(map)
        .bindPopup('Lokasi Sampah 1')
        .openPopup();

    L.marker([-8.1750, 113.7000]).addTo(map)
        .bindPopup('Lokasi Sampah 2');

    L.marker([-8.1600, 113.6800]).addTo(map)
        .bindPopup('Lokasi Sampah 3');
</script>
@endsection