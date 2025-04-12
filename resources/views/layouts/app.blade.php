<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="{{ asset('assets/') }}" data-template="vertical-menu-template-free">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>@yield('title', 'Admin Smart Trash')</title>
    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon/logo.png') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />

    <!-- Icons -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/boxicons.css') }}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/theme-default.css') }}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/apex-charts/apex-charts.css') }}" />

    <!-- Helpers -->
    <script src="{{ asset('assets/vendor/js/helpers.js') }}"></script>
    <script src="{{ asset('assets/js/config.js') }}"></script>

    <!-- Custom CSS -->
    <!-- Di dalam tag <style> di app.blade.php -->
<style>
    .green {
        color: #07AE67;
        text-transform: capitalize;
        font-size: 22px;
    }
    .yellow {
        color: #FFC630;
        text-transform: capitalize;
        font-size: 22px;
    }

    /* Styling untuk alert */
    .custom-alert {
        position: fixed;
        top: 13px;
        left: 50%;
        transform: translateX(-50%);
        width: 300px; /* Sesuai dengan lebar sempit pada gambar */
        z-index: 1200; /* Naikkan z-index agar di atas navbar */
        text-align: center;
        border-radius: 5px; /* Sudut sedikit membulat seperti pada gambar */
        padding: 10px 20px; /* Sesuaikan padding agar mirip dengan gambar */
        font-size: 14px; /* Ukuran font lebih kecil agar sesuai dengan gambar */
    }

    /* Sesuaikan latar belakang alert sukses agar sesuai dengan warna teal pada gambar */
    .alert-success {
        background-color: rgba(222, 255, 241, 100); /* Warna teal mirip dengan gambar */
        color: #07ae67; /* Teks putih untuk kontras */
        border: none; /* Hapus border default */
    }

    /* Sesuaikan tombol tutup */
    .custom-alert .btn-close {
        position: absolute;
        top: 50%; /* Posisikan di tengah vertikal */
        right: 10px; /* Jarak dari kanan */
        transform: translateY(-50%); /* Geser ke atas sebesar 50% dari tinggi tombol */
        filter: invert(1); /* Membuat tombol tutup berwarna putih */
        opacity: 0.8;/* Sedikit transparan seperti pada gambar */
    }
</style>
</head>
<body>
    @if (auth()->check())
        <div class="layout-wrapper layout-content-navbar">
            <div class="layout-container">
                <!-- Sidebar -->
                @include('partials.sidebar')

                <!-- Layout container -->
                <div class="layout-page">
                    <!-- Navbar -->
                    @include('partials.navbar')

                    <!-- Content wrapper -->
                    <div class="content-wrapper">
                        <!-- Tambah container-xxl di sini -->
                        <div class="container-xxl flex-grow-1 container-p-y">
                            @yield('content')
                        </div>
                        <div class="content-backdrop fade"></div>
                    </div>
                    <!-- / Content wrapper -->
                </div>
                <!-- / Layout page -->
            </div>

            <!-- Overlay -->
            <div class="layout-overlay layout-menu-toggle"></div>
        </div>
    @else
        @yield('content')
    @endif

    <!-- Core JS -->
    <script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/menu.js') }}"></script>

    <!-- Vendors JS -->
    <script src="{{ asset('assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>

    <!-- Main JS -->
    <script src="{{ asset('assets/js/main.js') }}"></script>

    <!-- Page JS -->
    @yield('scripts')

    <!-- GitHub Buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
</body>
</html>