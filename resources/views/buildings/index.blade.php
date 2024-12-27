@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CCTV</title>
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
        <h1 class="text-3xl font-bold mb-4 text-black">CCTV</h1>
        <a href="{{ route('buildings.create') }}" class="btn bg-red-500 hover:bg-red-600 text-white border-none mb-4">Tambah CCTV</a>        @if (session('success'))
            <div class="alert alert-success mb-4">
                <p>{{ session('success') }}</p>
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-error mb-4">
                <p>{{ session('error') }}</p>
            </div>
        @endif
        <div class="overflow-x-auto bg-white shadow-lg rounded-lg">
            <table class="table w-full bg-white">
                <thead>
                    <tr>
                        <th class="text-black bg-white border-b">Nama Gedung</th>
                        <th class="text-black bg-white border-b">Lantai</th>
                        <th class="text-black bg-white border-b">CCTV</th>
                        <th class="text-black bg-white border-b">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($buildings as $building)
                        <tr class="hover:bg-gray-50 bg-white">
                            <td class="border-b">{{ $building->name }}</td>
                            <td class="border-b">{{ $building->floor }}</td>
                            <td class="border-b">
                                <a href="{{ route('buildings.show', $building->id) }}" class="link font-bold text-blue-500">CCTV</a>
                            </td>
                            <td class="border-b">
                                <a href="{{ route('buildings.edit', $building->id) }}" class="btn bg-yellow-500 hover:bg-yellow-600 text-white border-none">Edit</a>
                                <form action="{{ route('buildings.destroy', $building->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn bg-red-500 hover:bg-red-600 text-white border-none" onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
@endsection