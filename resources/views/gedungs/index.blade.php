@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SmartLighting</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .container {
            padding: 20px;
            max-width: 1200px;
            margin: 0 auto;
        }
        .gedung-grid {
            display: grid;
            grid-template-columns: repeat(6, 1fr);
            gap: 20px;
            margin-top: 20px;
        }
        .gedung-item {
            text-align: center;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            transition: transform 0.2s;
            text-decoration: none;
            color: #333;
        }
        .gedung-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .gedung-icon {
            font-size: 2.5em;
            margin-bottom: 10px;
            color: #ED1C24;
        }
        .gedung-name {
            font-weight: bold;
            margin: 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1><center>Pilih Gedung</center></h1>
        
        <div class="gedung-grid">
            @foreach($gedungs as $gedung)
                <a href="{{ route('gedungs.show', $gedung->id) }}" class="gedung-item">
                    <i class="fas fa-building gedung-icon"></i>
                    <p class="gedung-name">{{ $gedung->name }}</p>
                </a>
            @endforeach
        </div>
    </div>
</body>
</html>
@endsection