@extends('layouts.app')

@section('title', 'Aset Gedung')

@section('content')
<div class="container mt-5">
    <h3><b>Daftar Aset</b></h3>
    
    <div class="row mb-3">
        <div class="col-md-6">
            <form action="{{ route('asets.index') }}" method="GET" class="form-inline">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Cari nama aset..." value="{{ request('search') }}">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">Cari</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-6 text-right">
            <a href="{{ route('asets.create') }}" class="btn btn-danger">Tambah Aset</a>
            <button onclick="cetakYangDipilih()" class="btn btn-success">Cetak Data Aset</button>
        </div>
    </div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th><input type="checkbox" id="check-all"></th>
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
                <td><input type="checkbox" class="aset-checkbox" value="{{ $aset->id }}"></td>
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

    <form id="pdf-form" action="{{ route('asets.pdf') }}" method="GET" target="_blank">
        <input type="hidden" name="selected_ids" id="selected-ids">
    </form>
</div>

<script>
document.getElementById('check-all').addEventListener('change', function() {
    let checkboxes = document.getElementsByClassName('aset-checkbox');
    for(let checkbox of checkboxes) {
        checkbox.checked = this.checked;
    }
});

function cetakYangDipilih() {
    let checkboxes = document.getElementsByClassName('aset-checkbox');
    let selectedIds = [];
    
    for(let checkbox of checkboxes) {
        if(checkbox.checked) {
            selectedIds.push(checkbox.value);
        }
    }
    
    if(selectedIds.length === 0) {
        alert('Pilih minimal satu aset untuk dicetak!');
        return;
    }
    
    document.getElementById('selected-ids').value = selectedIds.join(',');
    document.getElementById('pdf-form').submit();
}
</script>
@endsection
