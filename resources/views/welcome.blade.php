<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Welcome page</title>

    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <style>
        body {
            font-family: 'Nunito', sans-serif;
            background-color: #1a1a2e; /* Black-blue background */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .login-box {
            background: #121212; /* Dark background for the box */
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.6);
            width: 350px;
            text-align: center;
            position: relative;
        }

        .login-box h2 {
            color: white;
            font-size: 1.5rem;
            margin-bottom: 40px;
        }

        .form-group {
            position: relative;
            margin-bottom: 30px;
        }

        .form-group label {
            color: white;
            font-size: 14px;
            position: absolute;
            top: -20px;
            left: 0;
            transition: 0.3s;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            background: none;
            border: none;
            border-bottom: 2px solid #fff;
            color: white;
            font-size: 14px;
        }

        .form-group input:focus {
            border-bottom: 2px solid #007bff;
            outline: none;
        }

        .form-group input::placeholder {
            color: rgba(255, 255, 255, 0.7);
        }

        .form-actions {
            margin-top: 20px;
        }

        .form-actions a {
            color: white;
            text-decoration: none;
            font-size: 14px;
            margin-right: 30px;
            transition: 0.3s;
        }

        .form-actions a:hover {
            color: #007bff;
        }

        .btn {
            padding: 10px 20px;
            background-color: #007bff; /* Button color */
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: 0.3s;
        }

        .btn-btn-grey{

            padding: 10px 20px;
            background-color: purple; /* Button color */
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: 0.3s;
        }

        .btn:hover {
            background-color: #0056b3;
        }

        /* Neon border effect */
        .login-box:before {
            content: '';
            position: absolute;
            top: -2px;
            left: -2px;
            right: -2px;
            bottom: -2px;
            background: linear-gradient(45deg, #00c6ff, #0072ff, #007bff, #ff00ff);
            z-index: -1;
            filter: blur(10px);
            border-radius: 15px;
        }

    </style>
</head>
<body>
    <div class="login-box">
        <h2>Get started!</h2>
        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="form-group">
            <div class="container">
        <a href="{{ route('login') }}" class="btn">Log in</a>
        <a href="{{ route('register') }}" class="btn-btn-grey">Register</a>
        </div>  
        </form>
    </div>
</body>
</html>
