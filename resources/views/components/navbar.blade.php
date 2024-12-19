<!-- filepath: /D:/CODING/tubeswad/resources/views/components/navbar.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.22/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Navbar</title>
</head>
<body>
    <div class="navbar bg-base-100 rounded-xl shadow-md p-4">
        <img src="{{ asset('images/images 1.png') }}" alt="Image" class="ml-10">  
        <a href="{{ route('buildings.index') }}" class="text-4xl font-bold ml-10">DORMITORY</a>
    </div>
</body>
</html>