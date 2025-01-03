@extends('layouts.app')

@section('title', 'Laporan Error')

@section('content')
<div class="container">
    
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    
    <div class="container">
        <h3><b>Daftar Laporan Error</b></h3>
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Judul Error</th>
                    <th>Deskripsi</th>
                    <th>Status</th>
                    <th>Tanggal Laporan</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($errorReports as $report)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $report->error_title }}</td>
                        <td>{{ $report->error_description }}</td>
                        <td>
                            <select class="status-dropdown" data-report-id="{{ $report->id }}">
                                <option value="Diajukan" {{ $report->status == 'Diajukan' ? 'selected' : '' }}>Diajukan</option>
                                <option value="Diproses" {{ $report->status == 'Diproses' ? 'selected' : '' }}>Diproses</option>
                                <option value="Selesai" {{ $report->status == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                            </select>
                        </td>
                        <td>{{ $report->created_at->format('d/m/Y H:i') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">Tidak ada laporan error</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<style>
    .container {
        padding: 20px;
    }
    .table {
        width: 100%;
        border-collapse: collapse;
        background-color: white;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        border-radius: 10px;
    }
    .table th, .table td {
        border: 1px solid #ddd;
        padding: 12px;
        text-align: left;
    }
    .table th {
        background-color: #f4f4f4;
        font-weight: bold;
    }
    .table tr:hover {
        background-color: #f5f5f5;
    }
    h3 {
        margin-bottom: 20px;
    }
    .alert {
        padding: 15px;
        margin-bottom: 20px;
        border: 1px solid transparent;
        border-radius: 4px;
    }
    .alert-success {
        color: #155724;
        background-color: #d4edda;
        border-color: #c3e6cb;
    }
    .status-dropdown {
        padding: 6px;
        border: 1px solid #ddd;
        border-radius: 4px;
        background-color: white;
        width: 100%;
    }
    
    .status-dropdown:focus {
        outline: none;
        border-color: #80bdff;
        box-shadow: 0 0 0 0.2rem rgba(0,123,255,.25);
    }
</style>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('.status-dropdown').change(function() {
        const reportId = $(this).data('report-id');
        const newStatus = $(this).val();
        
        $.ajax({
            url: `/staff/error/update-status/${reportId}`,
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                status: newStatus
            },
            success: function(response) {
                if(response.success) {
                    alert('Status berhasil diperbarui');
                }
            },
            error: function() {
                alert('Terjadi kesalahan saat memperbarui status');
                location.reload();
            }
        });
    });
});
</script>
@endsection