@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Tambah Monitor Baru</h3>
                    <div class="card-tools">
                        <a href="{{ route('water.index') }}" class="btn btn-secondary">Kembali</a>
                    </div>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('water.store') }}" method="POST">
                        @csrf
                        <div class="form-group mb-3">
                            <label>Kode Sensor</label>
                            <input type="text" name="kode_sensor" class="form-control" value="{{ old('kode_sensor') }}" required maxlength="4">
                        </div>
                        <div class="form-group mb-3">
                            <label>Nama Gedung</label>
                            <input type="text" name="nama_gedung" class="form-control" value="{{ old('nama_gedung') }}" required>
                        </div>
                        <div class="form-group mb-3">
                            <label>Kualitas Air</label>
                            <select name="kualitas_air" class="form-control" required>
                                <option value="">Pilih Kualitas Air</option>
                                <option value="Bersih" {{ old('kualitas_air') == 'Bersih' ? 'selected' : '' }}>Bersih</option>
                                <option value="Keruh" {{ old('kualitas_air') == 'Keruh' ? 'selected' : '' }}>Keruh</option>
                                <option value="Kotor" {{ old('kualitas_air') == 'Kotor' ? 'selected' : '' }}>Kotor</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection