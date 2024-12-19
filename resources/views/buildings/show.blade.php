<!-- filepath: /D:/CODING/tubeswad/resources/views/buildings/show.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Building Details</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/daisyui@1.14.0/dist/full.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    @include('components.navbar') <!-- Menggunakan direktif Blade untuk menyertakan navbar -->
    <div class="container mx-auto p-4">
        <h1 class="text-3xl font-bold mb-4">Asrama Details</h1>
        <h2 class="text-2xl mb-4">Gedung: {{ $building->name }} - Lantai: {{ $building->floor }}</h2>      
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="card shadow-lg">
                <div class="card-body">
                    <h3 class="card-title">Right Corridor</h3>
                    <video width="320" height="240" controls class="rounded-lg">
                        <source src="{{ asset('storage/' . $building->cctv_url_right) }}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                </div>
            </div>
            <div class="card shadow-lg">
                <div class="card-body">
                    <h3 class="card-title">Left Corridor</h3>
                    <video width="320" height="240" controls class="rounded-lg">
                        <source src="{{ asset('storage/' . $building->cctv_url_left) }}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                </div>
            </div>
        </div>
        <a href="{{ route('buildings.index') }}" class="btn btn-error mt-4">Back to Buildings List</a>
    </div>
</body>
</html>