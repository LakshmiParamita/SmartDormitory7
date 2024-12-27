@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Daftar Laporan Error</div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Gedung</th>
                                    <th>Judul</th>
                                    <th>Status</th>
                                    <th>Tanggal</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($errorReports as $index => $report)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $report->building_name }}</td>
                                    <td>{{ $report->error_title }}</td>
                                    <td>
                                        <span class="badge 
                                            @if($report->status == 'Diajukan') bg-warning
                                            @elseif($report->status == 'Diproses') bg-info
                                            @else bg-success
                                            @endif">
                                            {{ $report->status }}
                                        </span>
                                    </td>
                                    <td>{{ $report->created_at->format('d/m/Y H:i') }}</td>
                                    <td>
                                        <a href="{{ route('staff.error-reports.show', $report->id) }}" 
                                           class="btn btn-sm btn-primary">
                                            Detail
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 