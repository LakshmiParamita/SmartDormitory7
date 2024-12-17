<!DOCTYPE html>
<html>
<head>
    <title>Daftar Video</title>
</head>
<body>
    <h1>Daftar Video</h1>

    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <a href="{{ route('vidio1') }}">Upload Video Baru</a><br><br>

    @foreach ($videos as $video)
        <div>
            <h3>{{ $video->title }}</h3>
            <video width="320" height="240" controls>
                <source src="{{ asset('storage/' . $video->video_path) }}" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        </div>
    @endforeach
</body>
</html>
