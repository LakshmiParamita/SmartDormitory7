@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Daftar Monitoring Air</h3>
                    <div class="card-tools">
                        <a href="{{ route('water.create') }}" class="btn btn-primary">Tambah Monitor</a>
                    </div>
                </div>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode Sensor</th>
                                <th>Nama Gedung</th>
                                <th>Kualitas Air</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        @if(isset($waters) && $waters->count() > 0)
                            @foreach($waters as $water)
                                <tr>
                                <td>{{ $water->id }}</td>
                                        <td>{{ $water->kode_sensor }}</td>
                                        <td>{{ $water->nama_gedung }}</td>
                                        <td>{{ $water->kualitas_air ?? '-'}}</td>
                                <td class="text-center">
                                    <div class="btn-group" role="group">
                                    <a href="{{ route('water.show', $water->id) }}"
                                                    class="btn btn-sm btn-info me-1">
                                                    Detail
                                                </a>
                                                <a href="{{ route('water.edit', $water->id) }}"
                                                    class="btn btn-sm btn-warning me-1">
                                                    Edit
                                                </a>
                                                <form action="{{ route('water.destroy', $water->id) }}" method="POST"
                                                    class="d-inline">
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"
                                                        onclick="return confirm('Yakin ingin menghapus dosen?')">
                                                        Hapus
                                                    </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection