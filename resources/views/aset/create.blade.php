@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Tambah Aset</h2>
    <form action="{{ route('asets.store') }}" method="POST">
        @csrf
        
                <div class="mb-3">
            <label for="nama_aset" class="form-label">Nama Aset</label>
            <select class="form-select @error('nama_aset') is-invalid @enderror" id="nama_aset" name="nama_aset" required>
                <option value="">Pilih Nama Aset</option>
                <option value="Bantal" {{ old('nama_aset') == 'Bantal' ? 'selected' : '' }}>Bantal</option>
                <option value="Sprai" {{ old('nama_aset') == 'Sprai' ? 'selected' : '' }}>Sprai</option>
                <option value="Ember" {{ old('nama_aset') == 'Ember' ? 'selected' : '' }}>Ember</option>
                <option value="Gayung" {{ old('nama_aset') == 'Gayung' ? 'selected' : '' }}>Gayung</option>
                <option value="Lampu" {{ old('nama_aset') == 'Lampu' ? 'selected' : '' }}>Lampu</option>
                <option value="Kursi" {{ old('nama_aset') == 'Kursi' ? 'selected' : '' }}>Kursi</option>
                <option value="Keran" {{ old('nama_aset') == 'Keran' ? 'selected' : '' }}>Keran</option>
                <option value="Meja" {{ old('nama_aset') == 'Meja' ? 'selected' : '' }}>Meja</option>
                <option value="Tempat Sampah" {{ old('nama_aset') == 'Tempat Sampah' ? 'selected' : '' }}>Tempat Sampah</option>
                <option value="Kunci" {{ old('nama_aset') == 'Kunci' ? 'selected' : '' }}>Kunci</option>
                <option value="Kaca" {{ old('nama_aset') == 'Kaca' ? 'selected' : '' }}>Kaca</option>
            </select>
            @error('nama_aset')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="harga" class="form-label">Harga</label>
            <input type="number" class="form-control @error('harga') is-invalid @enderror" id="harga" name="harga" value="{{ old('harga') }}" required>
            @error('harga')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="satuan" class="form-label">Satuan</label>
            <input type="text" class="form-control @error('satuan') is-invalid @enderror" id="satuan" name="satuan" value="{{ old('satuan') }}" required>
            @error('satuan')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="jumlah" class="form-label">Jumlah</label>
            <input type="number" class="form-control @error('jumlah') is-invalid @enderror" id="jumlah" name="jumlah" value="{{ old('jumlah') }}" required>
            @error('jumlah')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        
        <button type="submit" class="btn btn-danger">Simpan</button>
        <a href="{{ route('asets.index') }}" class="btn btn-secondary ml-2">Kembali</a> <!-- Tombol Kembali -->
    </form>
</div>
@endsection
