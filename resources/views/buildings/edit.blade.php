@extends('layouts.app')

@section('title', 'CCTV')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/daisyui@1.14.0/dist/full.css" rel="stylesheet">
    <script>
        window.addEventListener('DOMContentLoaded', (event) => {
            document.documentElement.setAttribute('data-theme', 'light')
        });
    </script>
</head>
<body class="bg-white">
    <div class="container mx-auto p-4">
        <h1 class="text-3xl font-bold mb-4 text-black">Edit CCTV</h1>
        @if ($errors->any())
            <div class="alert alert-error mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('buildings.update', $building->id) }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded-lg shadow-lg border border-gray-200">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-black">Nama Gedung:</label>
                <input type="text" id="name" name="name" required class="input input-bordered w-full bg-white" value="{{ old('name', $building->name) }}">
            </div>
            <div class="mb-4">
                <label for="floor" class="block text-sm font-medium text-black">Lantai:</label>
                <input type="text" id="floor" name="floor" required class="input input-bordered w-full bg-white" value="{{ old('floor', $building->floor) }}">
            </div>
            <div class="mb-4">
                <label for="cctv_url_right" class="block text-sm font-medium text-black">CCTV Kanan:</label>
                <input type="file" id="cctv_url_right" name="cctv_url_right" accept="video/*" class="file-input file-input-bordered w-full bg-white">
            </div>
            <div class="mb-4">
                <label for="cctv_url_left" class="block text-sm font-medium text-black">CCTV Kiri:</label>
                <input type="file" id="cctv_url_left" name="cctv_url_left" accept="video/*" class="file-input file-input-bordered w-full bg-white">
            </div>
            <button type="submit" class="btn bg-red-500 hover:bg-red-600 text-white border-none w-full">Update</button>
        </form>
    </div>
</body>
</html>
@endsection