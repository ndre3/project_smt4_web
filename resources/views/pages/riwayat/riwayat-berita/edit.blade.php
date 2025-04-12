@extends('layouts.app')

@section('title', 'Edit Berita')

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Edit Berita</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('riwayat-berita.update', $berita->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="foto" class="form-label">Foto (Biarkan kosong jika tidak ingin mengganti)</label>
                <input type="file" name="foto" id="foto" class="form-control @error('foto') is-invalid @enderror">
                @error('foto')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <img src="{{ Storage::url($berita->foto) }}" alt="{{ $berita->judul_berita }}" style="width: 100px; height: auto; margin-top: 10px;">
            </div>
            <div class="mb-3">
                <label for="tanggal" class="form-label">Tanggal</label>
                <input type="date" name="tanggal" id="tanggal" class="form-control @error('tanggal') is-invalid @enderror" value="{{ $berita->tanggal }}">
                @error('tanggal')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="judul_berita" class="form-label">Judul Berita</label>
                <input type="text" name="judul_berita" id="judul_berita" class="form-control @error('judul_berita') is-invalid @enderror" value="{{ $berita->judul_berita }}">
                @error('judul_berita')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi</label>
                <textarea name="deskripsi" id="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" rows="5">{{ $berita->deskripsi }}</textarea>
                @error('deskripsi')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('riwayat-berita.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>
@endsection