<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>BUKSU SIAS</title>

    <!-- Custom fonts -->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,600,700" rel="stylesheet">

    <!-- Custom styles -->
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">

    <style>
        body {
            background: url("{{ asset('img/logo.png') }}") no-repeat center center fixed;
            background-size: contain;
            background-color:rgb(95, 90, 90);
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            font-family: 'Poppins', sans-serif;
        }

        body::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.4);
            z-index: 1;
        }

        .login-container {
            position: relative;
            z-index: 2;
            width: 100%;
            max-width: 400px;
            padding: 30px;
            border-radius: 15px;
            background: rgba(255, 255, 255, 0.2);
            box-shadow: 0px 8px 32px rgba(0, 0, 0, 0.2);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            text-align: center;
            color: #fff;
        }

        .login-container h3 {
            font-weight: 700;
            margin-bottom: 20px;
            color: #ffffff;
        }

        .form-control {
            border-radius: 30px;
            padding: 12px 20px;
            border: none;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease-in-out;
        }

        .form-control:focus {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
            transform: scale(1.02);
        }

        .btn-custom {
            border-radius: 30px;
            padding: 12px;
            font-weight: 600;
            letter-spacing: 1px;
            background: linear-gradient(135deg, #4e73df, #224abe);
            color: #fff;
            border: none;
            transition: all 0.3s ease-in-out;
        }

        .btn-custom:hover {
            background: linear-gradient(135deg, #224abe, #4e73df);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }

        .forgot-password {
            color: #d6e0ff;
            font-size: 14px;
            margin-top: 10px;
            display: block;
            transition: 0.3s;
        }

        .forgot-password:hover {
            text-decoration: underline;
        }

        @media (max-width: 768px) {
            .login-container {
                width: 90%;
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h3>BUKSU SIAS</h3>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <input type="hidden" name="role" id="roleInput">
            <div class="form-group">
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email Address..." value="{{ old('email') }}">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" id="password" name="password" placeholder="Password">
            </div>
            <div class="form-group">
                <div class="custom-control custom-checkbox small">
                    <input type="checkbox" class="custom-control-input" id="remember" name="remember">
                    <label class="custom-control-label" for="remember">Remember Me</label>
                </div>
            </div>
            <button type="submit" class="btn btn-custom btn-block">
                Login
            </button>
        </form>

        <a href="{{ route('password.request') }}" class="forgot-password">Forgot Password?</a>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>

    <script>
        // Get role from URL parameter
        function getRoleFromURL() {
            const urlParams = new URLSearchParams(window.location.search);
            return urlParams.get('role');
        }

        // Set role in login form
        document.addEventListener("DOMContentLoaded", function() {
            let role = getRoleFromURL();
            if (role) {
                document.getElementById('roleInput').value = role;
            }
        });
    </script>

</body>
</html>
