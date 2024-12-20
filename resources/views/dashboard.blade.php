<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin: 10px;
        }
        .btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h1>Dashboard</h1>
    
    <a href="{{ route('gedungs.index') }}" class="btn">
        SmartLighting
    </a>
    
    <a href="{{ route('building-lock.index') }}" class="btn">
        SmartLock
    </a>
    
</body>
</html>
