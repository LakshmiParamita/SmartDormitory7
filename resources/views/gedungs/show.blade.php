@extends('layouts.app')

@section('content')
<div class="container">
    <div class="mb-3">
        <a href="{{ route('gedungs.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Kembali ke Daftar Gedung
        </a>
    </div>

    <h1><center><b>{{ $gedung->name }}</b></center></h1>
    
    <div class="row">
        @if($lamps && count($lamps) > 0)
            @foreach ($lamps as $lamp)
                <div class="col-3 text-center my-3">
                    <div class="d-flex flex-column align-items-center">
                        <button 
                            class="btn lamp-toggle fw-bold mb-2 {{ $lamp->is_on ? 'btn-on' : 'btn-off' }}"
                            data-id="{{ $lamp->id }}">
                            <i class="fas fa-lightbulb"></i> {{ $lamp->name }}
                        </button>
                        <button 
                            class="btn btn-danger btn-sm"
                            onclick="deleteLamp({{ $lamp->id }})">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>
            @endforeach
            
            <div class="d-flex justify-content-between align-items-center mt-4">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addLampModal">
                    <i class="fas fa-plus"></i> Tambah Lampu
                </button>
                <button class="btn fw-bold {{ $lamps->every(fn($lamp) => $lamp->is_on) ? 'btn-off' : 'btn-on' }}" id="toggle-all-lamps">
                    <i class="fas fa-lightbulb"></i> 
                    <span id="toggle-all-text">
                        {{ $lamps->every(fn($lamp) => $lamp->is_on) ? 'Matikan Semua Lampu' : 'Nyalakan Semua Lampu' }}
                    </span>
                </button>
            </div>
        @else
            <p>Tidak ada lampu untuk gedung ini.</p>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addLampModal">
                <i class="fas fa-plus"></i> Tambah Lampu
            </button>
        @endif
    </div>
</div>

<!-- Modal Tambah Lampu -->
<div class="modal fade" id="addLampModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Lampu Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="addLampForm">
                    <div class="mb-3">
                        <label class="form-label">Nama Lampu</label>
                        <input type="text" class="form-control" id="lampName" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" id="saveLamp">Simpan</button>
            </div>
        </div>
    </div>
</div>

<style>
    .btn-off {
        background-color: grey;
        color: white;
    }
    .btn-on {
        background-color: #ED1C24;
        color: white;
    }
    .btn-secondary {
        background-color: black;
        color: white;
        padding: 8px 15px;
        border-radius: 5px;
        text-decoration: none;
    }
    .btn-secondary:hover {
        background-color: #5a6268;
        color: white;
    }
</style>

<script>
    document.querySelectorAll('.lamp-toggle').forEach(button => {
        button.addEventListener('click', function() {
            const lampId = this.getAttribute('data-id');
            fetch(`/lamps/${lampId}/toggle`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    this.classList.toggle('btn-on', data.is_on);
                    this.classList.toggle('btn-off', !data.is_on);
                }
            });
        });
    });

    document.getElementById('toggle-all-lamps')?.addEventListener('click', function() {
        const isAllOn = this.classList.contains('btn-off');
        const endpoint = isAllOn ? 'turn-all-off' : 'turn-all-on';
        
        fetch(`/gedungs/{{ $gedung->id }}/${endpoint}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.querySelectorAll('.lamp-toggle').forEach(button => {
                    if (!isAllOn) {
                        button.classList.add('btn-on');
                        button.classList.remove('btn-off');
                    } else {
                        button.classList.add('btn-off');
                        button.classList.remove('btn-on');
                    }
                });
                
                // Update tombol toggle-all
                this.classList.toggle('btn-on', isAllOn);
                this.classList.toggle('btn-off', !isAllOn);
                document.getElementById('toggle-all-text').textContent = 
                    isAllOn ? 'Nyalakan Semua Lampu' : 'Matikan Semua Lampu';
            }
        });
    });

    // Script untuk menambah lampu
    document.getElementById('saveLamp').addEventListener('click', function() {
        const lampName = document.getElementById('lampName').value;
        
        if (!lampName) {
            alert('Mohon isi nama lampu');
            return;
        }

        fetch(`/gedungs/{{ $gedung->id }}/lamps`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            },
            body: JSON.stringify({
                name: lampName
            })
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert(data.message || 'Terjadi kesalahan saat menambah lampu');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan saat menambah lampu');
        });
    });

    // Script untuk menghapus lampu
    function deleteLamp(lampId) {
        if (confirm('Apakah Anda yakin ingin menghapus lampu ini?')) {
            fetch(`/lamps/${lampId}`, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload(); // Refresh halaman setelah menghapus
                } else {
                    alert('Terjadi kesalahan saat menghapus lampu');
                }
            });
        }
    }
</script>
@endsection