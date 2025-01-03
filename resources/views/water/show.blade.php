@extends('layouts.app')

@section('title', 'Monitoring Air')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Detail Monitor</h3>
                    <div class="card-tools">
                        <a href="{{ route('water.index') }}" class="btn btn-secondary">Kembali</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="form-group mb-3">
                        <label>Kode Sensor</label>
                        <p>{{ $water->kode_sensor }}</p>
                    </div>
                    <div class="form-group mb-3">
                        <label>Nama Gedung</label>
                        <p>{{ $water->nama_gedung }}</p>
                    </div>
                    <div class="form-group mb-3">
                        <label>Kualitas Air</label>
                        <p>
                            <span id="kualitasAir" class="badge bg-{{ $water->kualitas_air == 'Bersih' ? 'success' : ($water->kualitas_air == 'Keruh' ? 'warning' : 'danger') }}">
                                {{ $water->kualitas_air }}
                            </span>
                        </p>
                    </div>
                    
                    <div class="form-group mb-3">
                        <label>Status</label>
                        <p id="statusContainer">
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
                            @elseif($water->tekanan_air < \App\Models\Water::BATAS_MIN_TEKANAN)
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
                        </p>
                    </div>
                    
                    <div id="buttonContainer">
                        @if(strtolower($water->kualitas_air) == 'kotor')
                            <button onclick="buangAir({{ $water->id }})" class="btn btn-danger">Buang Air</button>
                        @endif

                        @if(strtolower($water->kualitas_air) == 'keruh')
                            <button onclick="filterAir({{ $water->id }})" class="btn btn-warning">Filter Air</button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
function buangAir(id) {
    fetch(`/water/${id}/buang`, {
        method: 'PUT',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if(data.success) {
            document.getElementById('kualitasAir').textContent = data.kualitas_air;
            document.getElementById('kualitasAir').className = 'badge bg-success';
            document.getElementById('buttonContainer').innerHTML = '';
            document.getElementById('statusContainer').innerHTML = '<span class="badge bg-success">Normal</span>';
            alert(data.message);
        }
    })
    .catch(error => console.error('Error:', error));
}

function filterAir(id) {
    fetch(`/water/${id}/filter`, {
        method: 'PUT',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if(data.success) {
            document.getElementById('kualitasAir').textContent = data.kualitas_air;
            document.getElementById('kualitasAir').className = 'badge bg-success';
            document.getElementById('buttonContainer').innerHTML = '';
            document.getElementById('statusContainer').innerHTML = '<span class="badge bg-success">Normal</span>';
            alert(data.message);
        }
    })
    .catch(error => console.error('Error:', error));
}
</script>
@endpush
@endsection