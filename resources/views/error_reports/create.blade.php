@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Laporan Error</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }
        .header {
            background-color: #fefefe;
            padding: 20px;
            text-align: center;
        }
        .container {
            padding: 20px;
            max-width: 600px;
            margin: 0 auto;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            font-size: 16px;
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }
        .form-group input, .form-group textarea {
            width: 100%;
            padding: 10px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .form-group textarea {
            resize: none;
            height: 100px;
        }
        .form-actions {
            text-align: center;
        }
        .form-actions button {
            padding: 10px 20px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .btn-submit {
            background-color: #28a745;
            color: white;
        }
        .btn-cancel {
            background-color: #dc3545;
            color: white;
            text-decoration: none;
            padding: 10px 20px;
            display: inline-block;
            border-radius: 5px;
        }
        .error-message {
            color: red;
            font-size: 14px;
            margin-top: 5px;
        }
    </style>
</head>
<body>
    <h3>Tambah Laporan Error</h3>

    <div class="container">
        @if ($errors->any())
            <div style="color: red; margin-bottom: 15px;">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('error_reports.store', $buildingName) }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="error_title">Judul Error</label>
                <input type="text"
                    name="error_title"
                    id="error_title"
                    class="form-control @error('error_title') is-invalid @enderror"
                    value="{{ old('error_title') }}"
                    required>
                @error('error_title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="error_description">Deskripsi Error</label>
                <textarea name="error_description"
                        id="error_description"
                        class="form-control @error('error_description') is-invalid @enderror" 
                        required>{{ old('error_description') }}</textarea>
                @error('error_description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn-submit">Submit</button>
        </form>
    </div>
</body>
</html>
@endsection