<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - SmartDorm Tel-U</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<style>
    body {
        background-image: url('../assets/loginbg.png');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
    }

    .btn-red {
        background-color: #ED1C24;
        color: white;
        border: none;
    }

    .btn-red:hover {
        background-color: #cc0000;
    }

    .card {
        opacity: 0.9;
    }
</style>

<body class="bg-secondary">
    <div class="container">
        <div class="row vh-100 justify-content-center align-items-center">
            <div class="col-lg-6">
                <div class="card shadow px-5 py-5">
                    <div class="w-100 text-center mb-5">
                        <img class="" style="max-width: 125px;" src="../assets/dorm_logo.png" alt="SmartDorm Logo">
                    </div>

                    <h2 class="text-center mb-3">Daftar Akun</h2>

                    @if(session('message'))
                    <div class="alert alert-danger" role="alert">
                        {{ session('message') }}
                    </div>
                    @endif

                    <form method="POST" action="{{ route('register.post') }}">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="username" class="fw-bold">Username SSO</label>
                            <input type="text" id="username" class="form-control" name="username" placeholder="Username SSO" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="password" class="fw-bold">Password</label>
                            <input type="password" id="password" class="form-control" name="password" placeholder="Password" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="password_confirmation" class="fw-bold">Konfirmasi Password</label>
                            <input type="password" id="password_confirmation" class="form-control" name="password_confirmation" placeholder="Konfirmasi Password" required>
                        </div>
                        <button type="submit" class="btn btn-red px-5 w-100">Daftar</button>
                    </form>

                    <div class="mt-3 text-center">
                        Sudah punya akun? <a href="{{ route('login') }}">Login</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
