@extends('layouts.app')

@section('title', 'Riwayat Berita')

@section('content')
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
        <h5 class="mb-0">Riwayat Berita</h5>
        <a href="{{ route('riwayat-berita.create') }}" class="btn btn-primary">
            <i class="bx bx-plus me-1"></i> Tambah Berita
        </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th style="width:5%;">#</th>
                        <th style="width:7%;">Foto</th>
                        <th style="width:10%;">Tanggal</th>
                        <th style="width:30%;">Judul Berita</th>
                        <th style="width:15%;">Deskripsi</th>
                        <th style="width:15%;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($berita as $index => $item)
                        <tr>
                            <td>{{ $berita->firstItem() + $index }}</td>
                            <td>
                                <img src="{{ Storage::url($item->foto) }}" alt="{{ $item->judul_berita }}" style="width: 100px; height: auto;">
                            </td>
                            <td>{{ $item->tanggal }}</td>
                            <td>{{ $item->judul_berita }}</td>
                            <td>{{ Str::limit($item->deskripsi, 50) }}</td>
                            <td>
                                <a href="{{ route('riwayat-berita.edit', $item->id) }}" class="btn btn-warning btn-sm">
                                    <i class="bx bx-edit-alt me-1"></i> Edit
                                </a>
                                <form action="{{ route('riwayat-berita.destroy', $item->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus berita ini?')">
                                        <i class="bx bx-trash me-1"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">Tidak ada data berita.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-3">
            {{ $berita->links('vendor.pagination.bootstrap-4') }}
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