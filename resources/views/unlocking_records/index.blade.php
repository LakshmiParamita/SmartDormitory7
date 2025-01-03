@extends('layouts.app')

@section('title', 'Smart Door')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        th {
            background-color: #f4f4f4;
        }
        .container {
            position: relative;
            width: 100%;
        }
        .header-info {
            display: flex;
            justify-content: space-between;
            align-items: right;
            margin-bottom: 10px;
        }
        .info-text {
            font-size: 16px;
        }
        .button-container {
            position: relative;
            margin-top: 20px;
            text-align: right;
        }
        .btn {
            padding: 10px 20px;
            background-color: #ED1C24;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .btn:hover {
            background-color: #c82333;
        }
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.9);
        }

        .modal-content {
            margin: auto;
            display: block;
            width: 80%;
            max-width: 700px;
            position: relative;
            top: 50%;
            transform: translateY(-50%);
        }

        .close {
            color: #fff;
            position: absolute;
            right: 25px;
            top: 10px;
            font-size: 35px;
            font-weight: bold;
            cursor: pointer;
        }

        .camera-icon {
            color: #4CAF50;
            cursor: pointer;
        }

        .camera-icon:hover {
            color: #45a049;
        }
    </style>
</head>
<body>
    
    <div class="container">
        <h3><b>Unlocking Records</b></h3>
        <div class="header-info">
            <h4 class="info-text">Gedung: 6 Kamar: 216</h4>
        </div>
        <table>
            <thead>
                <tr>
                    <th>Timestamp</th>
                    <th>Activity</th>
                    <th>View</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($records as $record)
                    <tr>
                        <td>{{ $record->timestamp }}</td>
                        <td>{{ $record->activity }}</td>
                        <td class="text-center">
                            @if($record->image)
                                <i class="fas fa-camera camera-icon" onclick="showImage('data:image/jpeg;base64,{{ base64_encode($record->image) }}')"></i>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="button-container">
            <form action="{{ route('unlocking_records.store') }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" class="btn">Kunci Pintu</button>
            </form>
        </div>
    </div>

    <div id="imageModal" class="modal">
        <span class="close" onclick="closeModal()">&times;</span>
        <img class="modal-content" id="modalImage">
    </div>

    <script>
        function showImage(imagePath) {
            var modal = document.getElementById("imageModal");
            var modalImg = document.getElementById("modalImage");
            modal.style.display = "block";
            modalImg.src = imagePath;
        }

        function closeModal() {
            document.getElementById("imageModal").style.display = "none";
        }

        window.onclick = function(event) {
            var modal = document.getElementById("imageModal");
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>
</body>
</html>
@endsection