@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Building Details</title>
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
        <h1 class="text-3xl font-bold mb-4 text-black">Details</h1>
        <h2 class="text-2xl mb-4 text-black">{{ $building->name }} - Lantai {{ $building->floor }}</h2>      
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="card bg-white shadow-lg">
                <div class="card-body">
                    <h3 class="card-title text-black">Lorong Kanan</h3>
                    <video width="320" height="240" controls class="rounded-lg">
                        <source src="{{ asset('storage/' . $building->cctv_url_right) }}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                </div>
            </div>
            <div class="card bg-white shadow-lg">
                <div class="card-body">
                    <h3 class="card-title text-black">Lorong Kiri</h3>
                    <video width="320" height="240" controls class="rounded-lg">
                        <source src="{{ asset('storage/' . $building->cctv_url_left) }}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                </div>
            </div>
        </div>
        <a href="{{ route('buildings.index') }}" class="btn bg-red-500 hover:bg-red-600 text-white border-none mt-4">Kembali</a>
    </div>
</body>
</html>
@endsection 