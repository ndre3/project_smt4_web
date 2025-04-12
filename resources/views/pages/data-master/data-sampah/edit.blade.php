@extends('layouts.app')

@section('title', 'Edit Data Sampah')

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Edit Data Sampah</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('data-master.data-sampah.update', $sampah) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="tanggal" class="form-label">Tanggal</label>
                <input type="date" class="form-control @error('tanggal') is-invalid @enderror" id="tanggal" name="tanggal" value="{{ old('tanggal', $sampah->tanggal) }}">
                @error('tanggal')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="jumlah_sampah" class="form-label">Jumlah Sampah</label>
                <input type="number" class="form-control @error('jumlah_sampah') is-invalid @enderror" id="jumlah_sampah" name="jumlah_sampah" value="{{ old('jumlah_sampah', $sampah->jumlah_sampah) }}">
                @error('jumlah_sampah')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('data-master.data-sampah.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>
@endsection