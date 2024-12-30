@extends('layouts.app')

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
                        <p id="kualitasAir">{{ $water->kualitas_air }}</p>
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
            document.getElementById('buttonContainer').innerHTML = '';
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
            document.getElementById('buttonContainer').innerHTML = '';
            alert(data.message);
        }
    })
    .catch(error => console.error('Error:', error));
}
</script>
@endpush
@endsection