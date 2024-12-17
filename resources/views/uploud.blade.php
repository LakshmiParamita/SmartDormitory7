<form action="/upload-video" method="POST" enctype="multipart/form-data">
    @csrf
    <label for="video1">Pilih Video:</label>
    <input type="file" name="video" accept="video/*" required>
    <button type="submit">Upload Video</button>
</form>
