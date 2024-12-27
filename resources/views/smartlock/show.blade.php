@extends('layouts.app')

@section('content')
<style>
    .lock-toggle-btn {
        height: 80px;              
        margin-bottom: 10px;       
        font-size: 16px;          
        font-weight: bold;        
        transition: all 0.3s;     
    }

    /* Style untuk tombol saat terkunci */
    .btn-danger.lock-toggle-btn,
    .btn-danger#lockAllBtn {
        background-color: #ED1C24;     /* Warna merah untuk locked */
        border-color: #ED1C24;
    }
    .btn-danger.lock-toggle-btn:hover,
    .btn-danger#lockAllBtn:hover {
        background-color: #c82333;     /* Warna merah lebih gelap saat hover */
        border-color: #c82333;
    }

    /* Style untuk tombol saat tidak terkunci */
    .btn-success.lock-toggle-btn,
    .btn-success#lockAllBtn {
        background-color: #28a745;     /* Warna hijau untuk unlocked */
        border-color: #28a745;
    }
    .btn-success.lock-toggle-btn:hover,
    .btn-success#lockAllBtn:hover {
        background-color: #218838;     /* Warna hijau lebih gelap saat hover */
        border-color: #1e7e34;
    }

    /* Style untuk icon */
    .lock-toggle-btn i,
    #lockAllBtn i {
        margin-left: 8px;          
        font-size: 18px;           
    }

    /* Efek saat tombol ditekan */
    .lock-toggle-btn:active,
    #lockAllBtn:active {
        transform: scale(0.95);    
    }
</style>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <b>Smart Lock Asrama</b>
                        <button 
                            class="btn btn-danger"
                            id="lockAllBtn"
                            onclick="toggleLockAll()"
                        >
                            <i class="fas fa-lock"></i> <span>Lock All Buildings</span>
                        </button>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row">
                        @foreach($buildings as $building)
                        <div class="col-md-2 mb-3">
                            <button 
                                class="btn btn-block w-100 lock-toggle-btn {{ $building->buildingLock?->is_locked ? 'btn-danger' : 'btn-success' }}"
                                data-building-id="{{ $building->id }}"
                                onclick="toggleLock(this)"
                            >
                                {{ $building->name }}
                                <i class="fas fa-{{ $building->buildingLock?->is_locked ? 'lock' : 'lock-open' }}"></i>
                            </button>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
function toggleLock(button) {
    const buildingId = button.dataset.buildingId;
    
    fetch(`/building-lock/${buildingId}/toggle`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            const btn = button;
            if (data.is_locked) {
                btn.classList.remove('btn-success');
                btn.classList.add('btn-danger');
                btn.querySelector('i').classList.remove('fa-lock-open');
                btn.querySelector('i').classList.add('fa-lock');
            } else {
                btn.classList.remove('btn-danger');
                btn.classList.add('btn-success');
                btn.querySelector('i').classList.remove('fa-lock');
                btn.querySelector('i').classList.add('fa-lock-open');
            }
        }
    });
}

function toggleLockAll() {
    const btn = document.getElementById('lockAllBtn');
    const isLocking = btn.querySelector('span').textContent.includes('Lock');
    const endpoint = isLocking ? '/building-lock/lock-all' : '/building-lock/unlock-all';
    
    fetch(endpoint, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            if (isLocking) {
                // Ubah semua tombol menjadi merah (locked)
                document.querySelectorAll('.lock-toggle-btn').forEach(btn => {
                    btn.classList.remove('btn-success');
                    btn.classList.add('btn-danger');
                    btn.querySelector('i').classList.remove('fa-lock-open');
                    btn.querySelector('i').classList.add('fa-lock');
                });
                // Ubah tombol lock all
                btn.querySelector('span').textContent = 'Unlock All Buildings';
                btn.classList.remove('btn-danger');
                btn.classList.add('btn-success');
                btn.querySelector('i').classList.remove('fa-lock');
                btn.querySelector('i').classList.add('fa-lock-open');
            } else {
                // Ubah semua tombol menjadi hijau (unlocked)
                document.querySelectorAll('.lock-toggle-btn').forEach(btn => {
                    btn.classList.remove('btn-danger');
                    btn.classList.add('btn-success');
                    btn.querySelector('i').classList.remove('fa-lock');
                    btn.querySelector('i').classList.add('fa-lock-open');
                });
                // Ubah tombol unlock all
                btn.querySelector('span').textContent = 'Lock All Buildings';
                btn.classList.remove('btn-success');
                btn.classList.add('btn-danger');
                btn.querySelector('i').classList.remove('fa-lock-open');
                btn.querySelector('i').classList.add('fa-lock');
            }
        }
    });
}
</script>
@endpush
@endsection
