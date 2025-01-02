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
                            <select name="kualitas_air" class="form-control">
                                @foreach(App\Models\Water::$kualitasAirValues as $value)
                                    <option value="{{ $value }}">{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                        <!-- <div class="form-group mb-3">
                            <label>Tinggi Air (m)</label>
                            <input type="number" name="water_level" class="form-control" value="{{ old('water_level', 1) }}" required step="0.01">
                        </div> -->
                        <div class="form-group mb-3">
                            <label>Tekanan Air (bar)</label>
                            <input type="number" name="tekanan_air" class="form-control" value="{{ old('tekanan_air', 40) }}" required step="0.01">
                            <small class="text-muted">Nilai normal: 3-6 bar</small>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection