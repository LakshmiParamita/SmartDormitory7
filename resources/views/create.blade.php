<!DOCTYPE html>
<html>
<head>
    <title>Upload Video</title>
</head>
<body>
    <h1>Upload Video</h1>

    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('videos.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="title">Judul Video:</label>
        <input type="text" name="title" id="title" required><br><br>

        <label for="video">Pilih Video:</label>
        <input type="file" name="video" id="video" accept="video/*" required><br><br>

        <button type="submit">Upload Video</button>
    </form>

    <a href="{{ route('videos.index') }}">Lihat Semua Video</a>
</body>
</html>
