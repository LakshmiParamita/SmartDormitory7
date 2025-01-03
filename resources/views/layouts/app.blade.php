<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') - SmartDorm</title>
    <link rel="website icon" type="png" href="{{ asset('assets/dorm_logo.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        .container {
            max-width: 1500px;
            margin: 0 auto;
            padding: 20px;
            justify-content: center;
        }

        .header {
            background-color: #fff;
            border-radius: 0 0 20px 20px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
            margin-bottom: 30px;
            width: 100%;
        }

        .logo {
            max-width: 60px;
            height: auto;
        }

        .title {
            font-family: "Montserrat-SemiBold", Helvetica;
            font-size: 28px;
            font-weight: bold;
        }

        .logout {
            font-size: 24px;
        }
    </style>
    @yield('styles')
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="header">
            <a href="{{ route('dashboard') }}">
                <img class="logo" src="{{ asset('images/dorm_logo.png') }}" />   
            </a>
            <h1 class="title">SmartDorm</h1>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn logout">Logout</button>
            </form>
        </div>
    </nav>

    @yield('content')
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>