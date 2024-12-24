<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Error</title>
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
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
        }
        .container {
            padding: 20px;
        }
        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }
        .card {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
            padding: 15px;
            cursor: pointer;
            transition: transform 0.2s;
        }
        .card:hover {
            transform: translateY(-5px);
        }
        .card img {
            width: 50px;
            height: 50px;
            margin-bottom: 10px;
        }
        .card p {
            margin-top: 10px;
            font-size: 16px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="header">
        <img src="https://yt3.ggpht.com/a/AATXAJysAvcbiz7dwyGwvB4RuLP8KBNhvtKDHERTRPhVkg=s900-c-k-c0xffffffff-no-rj-mo" 
            alt="Logo" style="height: 40px; vertical-align: middle;">
        <h1>Laporan Error</h1>
    </div>

    <div class="container">
        <div class="grid">
            @foreach ($buildings as $building)
                <a href="{{ route('error_reports.show', $building) }}" class="card">
                    <!-- Logo di atas -->
                    <img src="https://petunjuk.id/wp-content/uploads/2019/10/Tanda-Seru-Merah.jpg" alt="Logo Gedung">
                    <p>{{ $building }}</p>
                </a>
            @endforeach
        </div>
    </div>
</body>
</html>
