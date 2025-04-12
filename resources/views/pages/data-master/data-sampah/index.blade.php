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
        <h5 class="mb-0">Data Sampah</h5>
        <a href="{{ route('data-master.data-sampah.create') }}" class="btn btn-primary">
            <i class="bx bx-plus me-1"></i> Tambah Data Sampah
        </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Tanggal</th>
                        <th>Jumlah Sampah</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($sampahs as $index => $sampah)
                        <tr>
                            <td>{{ $sampahs->firstItem() + $index }}</td>
                            <td>{{ $sampah->tanggal }}</td>
                            <td>{{ $sampah->jumlah_sampah }}</td>
                            <td>
                                <a href="{{ route('data-master.data-sampah.edit', $sampah->id) }}" class="btn btn-warning btn-sm">
                                    <i class="bx bx-edit-alt me-1"></i> Edit
                                </a>
                                <form action="{{ route('data-master.data-sampah.destroy', $sampah->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                        <i class="bx bx-trash me-1"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">Tidak ada data sampah.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-3">
            {{ $sampahs->links('vendor.pagination.bootstrap-4') }}
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