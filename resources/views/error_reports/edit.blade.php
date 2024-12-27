@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Laporan Error - {{ $buildingName }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }
        .header {
            background-color: #fefefe;
            padding: 20px;
            text-align: center;
        }
        .container {
            padding: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background-color: white;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }
        table th, table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        table th {
            background-color: #f4f4f4;
            font-weight: bold;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            font-weight: bold;
        }
        .form-group input, .form-group textarea {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        .form-actions {
            margin-top: 20px;
        }
        .btn-submit, .btn-cancel {
            padding: 10px 20px;
            font-size: 14px;
            border-radius: 5px;
            text-decoration: none;
            margin-right: 10px;
        }
        .btn-submit {
            background-color: #4CAF50;
            color: white;
        }
        .btn-cancel {
            background-color: #f44336;
            color: white;
        }
    </style>
</head>
<body>
    <h3>Edit Laporan</h3>
    <div class="container">
        <form action="{{ route('error_reports.update', [$buildingName, $errorReport->id]) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="title">Judul Laporan</label>
                <input type="text" id="title" name="error_title" value="{{ $errorReport->error_title }}" required>
            </div>

            <div class="form-group">
                <label for="description">Deskripsi Laporan</label>
                <textarea id="description" name="error_description" required>{{ $errorReport->error_description }}</textarea>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-submit">Perbarui</button>
                <a href="{{ route('error_reports.show', $buildingName) }}" class="btn-cancel">Batal</a>
            </div>
        </form>
    </div>
</body>
</html>
@endsection