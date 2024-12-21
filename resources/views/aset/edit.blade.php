@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Edit Aset</h2>
    <form action="{{ route('asets.update', $aset->id) }}" method="POST">
        @csrf
        
        @method('PUT')
        
        <div class="mb-3">
            <label for="nama_aset" class="form-label">Nama Aset</label>
            <input type="text" class="form-control @error('nama_aset') is-invalid @enderror" id="nama_aset" name="nama_aset" value="{{ old('nama_aset', $aset->nama_aset) }}" required>
            @error('nama_aset')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="harga" class="form-label">Harga</label>
            <input type="number" class="form-control @error('harga') is-invalid @enderror" id="harga" name="harga" value="{{ old('harga', $aset->harga) }}" required>
            @error('harga')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="satuan" class="form-label">Satuan</label>
            <input type="text" class="form-control @error('satuan') is-invalid @enderror" id="satuan" name="satuan" value="{{ old('satuan', $aset->satuan) }}" required>
            @error('satuan')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="jumlah" class="form-label">Jumlah</label>
            <input type="number" class="form-control @error('jumlah') is-invalid @enderror" id="jumlah" name="jumlah" value="{{ old('jumlah', $aset->jumlah) }}" required>
            @error('jumlah')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        
        <button type="submit" class="btn btn-danger">Update</button>
        <a href="{{ route('asets.index') }}" class="btn btn-secondary ml-2">Kembali</a> <!-- Tombol Kembali -->
    </form>
</div>
@endsection
