@extends('layouts.app')

@section('title', 'Smart Lighting')

@section('content')
<div class="container">
    <h1>Tambah Gedung</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('gedungs.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Nama Gedung</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
    </form>
</div>
@endsection