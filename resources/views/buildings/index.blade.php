<!-- filepath: /d:/CODING/tubeswad/resources/views/buildings/index.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buildings</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/daisyui@1.14.0/dist/full.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    @include('components.navbar') <!-- Menggunakan direktif Blade untuk menyertakan navbar -->
    <div class="container mx-auto p-4">
        <h1 class="text-3xl font-bold mb-4">Buildings</h1>
        <a href="{{ route('buildings.create') }}" class="btn btn-error mb-4">Create New Building</a>        @if (session('success'))
            <div class="alert alert-success mb-4">
                <p>{{ session('success') }}</p>
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-error mb-4">
                <p>{{ session('error') }}</p>
            </div>
        @endif
        <div class="overflow-x-auto">
            <table class="table w-full">
                <thead>
                    <tr>
                        <th>Nama Gedung</th>
                        <th>Lantai</th>
                        <th>CCTV</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($buildings as $building)
                        <tr>
                            <td>{{ $building->name }}</td>
                            <td>{{ $building->floor }}</td>
                            <td>
                                <a href="{{ route('buildings.show', $building->id) }}" class="link font-bold text-blue-500">CCTV</a>
                            </td>
                            <td>
                                <a href="{{ route('buildings.edit', $building->id) }}" class="btn btn-warning">Edit</a>
                                <form action="{{ route('buildings.destroy', $building->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
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