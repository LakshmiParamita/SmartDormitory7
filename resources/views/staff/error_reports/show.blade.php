@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Laporan Error - {{ $buildingName }}</h5>
                </div>

                <div class="card-body">
                    @if($errorReports->isEmpty())
                        <p class="text-center">Belum ada laporan error untuk gedung ini.</p>
                    @else
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Judul</th>
                                        <th>Deskripsi</th>
                                        <th>Status</th>
                                        <th>Tanggal</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($errorReports as $index => $report)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $report->error_title }}</td>
                                        <td>{{ Str::limit($report->error_description, 50) }}</td>
                                        <td>
                                            <form action="{{ route('staff.error-reports.update-status', $report->id) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <select name="status" class="form-select form-select-sm" onchange="this.form.submit()">
                                                    <option value="Diajukan" {{ $report->status == 'Diajukan' ? 'selected' : '' }}>Diajukan</option>
                                                    <option value="Diproses" {{ $report->status == 'Diproses' ? 'selected' : '' }}>Diproses</option>
                                                    <option value="Selesai" {{ $report->status == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                                                </select>
                                            </form>
                                        </td>
                                        <td>{{ $report->created_at->format('d/m/Y H:i') }}</td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#detailModal{{ $report->id }}">
                                                Detail
                                            </button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Modal untuk setiap laporan -->
                        @foreach($errorReports as $report)
                        <div class="modal fade" id="detailModal{{ $report->id }}" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Detail Laporan Error</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label class="fw-bold">Judul:</label>
                                            <p>{{ $report->error_title }}</p>
                                        </div>
                                        <div class="mb-3">
                                            <label class="fw-bold">Deskripsi:</label>
                                            <p>{{ $report->error_description }}</p>
                                        </div>
                                        <div class="mb-3">
                                            <label class="fw-bold">Tanggal Laporan:</label>
                                            <p>{{ $report->created_at->format('d/m/Y H:i') }}</p>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 