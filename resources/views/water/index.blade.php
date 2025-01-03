@extends('layouts.app')

@section('title', 'Monitoring Air')

@php
    use App\Models\Water;
@endphp

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
                    @if (session('warning'))
                        <div class="alert alert-warning">
                            {{ session('warning') }}
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
                                <!-- <th>Tinggi Air (m)</th> -->
                                <th>Debit (L/detik)</th>
                                <th>Tekanan (bar)</th>
                                <th>Status</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        @if(isset($waters) && $waters->count() > 0)
                            @foreach($waters as $water)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $water->kode_sensor }}</td>
                                    <td>{{ $water->nama_gedung }}</td>
                                    <td>
                                        <span class="badge bg-{{ $water->kualitas_air == 'Bersih' ? 'success' : ($water->kualitas_air == 'Keruh' ? 'warning' : 'danger') }}">
                                            {{ $water->kualitas_air }}
                                        </span>
                                    </td>
                                    <!-- <td>{{ number_format($water->water_level, 2) }}</td> -->
                                    <td>
                                        {{ number_format($water->debit, 2) }}
                                        @if($water->debit > Water::BATAS_NORMAL_DEBIT)
                                            <span class="badge bg-danger">Melebihi Batas</span>
                                        @endif
                                    </td>
                                    <td>
                                        {{ number_format($water->tekanan_air, 2) }}
                                    </td>
                                    <td>
                                        @if($water->status_kebocoran)
                                            <span class="badge bg-danger">Terdeteksi Kebocoran</span>
                                            @if(!$water->status_penanganan)
                                                <button class="btn btn-warning btn-sm ms-1 panggil-teknisi" 
                                                        data-id="{{ $water->id }}"
                                                        data-gedung="{{ $water->nama_gedung }}">
                                                    Panggil Teknisi
                                                </button>
                                            @else
                                                <span class="badge bg-info">Dalam Penanganan</span>
                                                <button class="btn btn-success btn-sm ms-1 selesai-penanganan" 
                                                        data-id="{{ $water->id }}"
                                                        data-gedung="{{ $water->nama_gedung }}">
                                                    Selesai Penanganan
                                                </button>
                                            @endif
                                        @elseif($water->tekanan_air < Water::BATAS_MIN_TEKANAN)
                                            <span class="badge bg-warning">Tekanan Rendah</span>
                                            @if(!$water->status_cek_pompa)
                                                <button class="btn btn-info btn-sm ms-1 cek-pompa" 
                                                        data-id="{{ $water->id }}"
                                                        data-gedung="{{ $water->nama_gedung }}">
                                                    Cek Pompa Air
                                                </button>
                                            @else
                                                <span class="badge bg-info">Pompa Dalam Pengecekan</span>
                                                <button class="btn btn-success btn-sm ms-1 selesai-cek-pompa" 
                                                        data-id="{{ $water->id }}"
                                                        data-gedung="{{ $water->nama_gedung }}">
                                                    Selesai Cek Pompa
                                                </button>
                                            @endif
                                        @else
                                            <span class="badge bg-success">Normal</span>
                                        @endif
                                    </td>
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
                                            <form action="{{ route('water.destroy', $water->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="9" class="text-center">Tidak ada data</td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Handler untuk tombol panggil teknisi
    document.querySelectorAll('.panggil-teknisi').forEach(function(button) {
        button.addEventListener('click', function() {
            const id = this.dataset.id;
            const gedung = this.dataset.gedung;
            
            if (confirm(`Apakah Anda yakin ingin memanggil teknisi untuk ${gedung}?`)) {
                fetch(`/water/${id}/panggil-teknisi`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert(data.message);
                        location.reload();
                    } else {
                        alert(data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat memanggil teknisi');
                });
            }
        });
    });

    // Handler untuk tombol selesai penanganan
    document.querySelectorAll('.selesai-penanganan').forEach(function(button) {
        button.addEventListener('click', function() {
            const id = this.dataset.id;
            const gedung = this.dataset.gedung;
            
            if (confirm(`Apakah penanganan kebocoran di ${gedung} sudah selesai?`)) {
                fetch(`/water/${id}/selesai-penanganan`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert(data.message);
                        location.reload();
                    } else {
                        alert(data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat memproses selesai penanganan');
                });
            }
        });
    });

    // Handler untuk tombol cek pompa
    document.querySelectorAll('.cek-pompa').forEach(function(button) {
        button.addEventListener('click', function() {
            const id = this.dataset.id;
            const gedung = this.dataset.gedung;
            
            if (confirm(`Apakah Anda yakin ingin melakukan pengecekan pompa air di ${gedung}?`)) {
                fetch(`/water/${id}/cek-pompa`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert(data.message);
                        location.reload();
                    } else {
                        alert(data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat memproses pengecekan pompa');
                });
            }
        });
    });

    // Handler untuk tombol selesai cek pompa
    document.querySelectorAll('.selesai-cek-pompa').forEach(function(button) {
        button.addEventListener('click', function() {
            const id = this.dataset.id;
            const gedung = this.dataset.gedung;
            
            if (confirm(`Apakah pengecekan pompa air di ${gedung} sudah selesai?`)) {
                fetch(`/water/${id}/selesai-cek-pompa`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert(data.message);
                        location.reload();
                    } else {
                        alert(data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat menyelesaikan pengecekan pompa');
                });
            }
        });
    });
});
</script>
@endpush
@endsection