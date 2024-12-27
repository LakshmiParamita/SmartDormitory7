@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Daftar Aset</h2>
    <a href="{{ route('asets.create') }}" class="btn btn-danger mb-3">Tambah Aset</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Aset</th>
                <th>Harga</th>
                <th>Satuan</th>
                <th>Jumlah</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($asets as $aset)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $aset->nama_aset }}</td>
                <td>{{ $aset->harga }}</td>
                <td>{{ $aset->satuan }}</td>
                <td>{{ $aset->jumlah }}</td>
                <td>
                    <a href="{{ route('asets.edit', $aset->id) }}" class="btn btn-warning btn-sm">Update</a>
                    <form action="{{ route('asets.destroy', $aset->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
