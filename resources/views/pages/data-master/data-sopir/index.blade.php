@extends('layouts.app')

@section('title', 'Data Sampah')

@section('content')
<!-- Bagian Alert -->
@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show custom-alert" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
@if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show custom-alert" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Data Sopir</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>NAMA</th>
                        <th>Email</th>
                        <th>ROLE</th>
                        <th>ROLE DIBUAT</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($sopirs as $index => $sopir)
                        <tr>
                            <td>{{ $sopir->id}}</td>
                            <td>{{ $sopir->name}}</td>
                            <td>{{ $sopir->email}}</td>
                            <td>{{ $sopir->role}}</td>
                            <td>{{ $sopir->created_at->format('d M Y') }}</td>
                            
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">Tidak ada data sopir.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-3">
            
        </div>
    </div>
</div>

@section('scripts')
<script>
    // Menghilangkan alert secara otomatis setelah 5 detik (5000 milidetik)
    setTimeout(function() {
        let alert = document.querySelector('.custom-alert');
        if (alert) {
            let bsAlert = new bootstrap.Alert(alert);
            bsAlert.close();
        }
    }, 5000);
</script>
@endsection
@endsection