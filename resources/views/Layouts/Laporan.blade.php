<!-- resources/views/laporan.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1>Laporan Error</h1>
    <div class="row">
        <!-- Iterasi untuk menampilkan gedung-gedung -->
        @foreach($gedungs as $gedung)
        <div class="col-md-3 mb-4">
            <div class="card text-center">
                <div class="card-body">
                    <!-- Ikon peringatan -->
                    <div class="alert alert-danger" role="alert">
                        <i class="fas fa-exclamation-triangle fa-3x"></i>
                    </div>
                    <p>Gedung {{ $gedung }}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
