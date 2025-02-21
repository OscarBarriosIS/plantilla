<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Control de Asistencia</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        body {
            background-color: #f4f7fa;
            font-family: 'Roboto', sans-serif;
        }

        .login-container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: linear-gradient(to right, #bb1212, #2575fc);
        }

        .login-box {
            background: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        .login-box h2 {
            margin-bottom: 30px;
            color: #333;
            font-size: 24px;
        }

        .input-group {
            margin-bottom: 20px;
        }

        .input-group label {
            font-size: 16px;
            color: #555;
        }

        .input-group input {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border-radius: 5px;
            border: 1px solid #ccc;
            margin-top: 5px;
        }

        .input-group input:focus {
            outline: none;
            border-color: #6a11cb;
            box-shadow: 0 0 5px rgba(106, 17, 203, 0.3);
        }

        .btn {
            background-color: #2575fc;
            color: white;
            padding: 12px 20px;
            border-radius: 5px;
            font-size: 16px;
            border: none;
            cursor: pointer;
            width: 100%;
            transition: background-color 0.3s;
        }

        .btn:hover {
            background-color: #6a11cb;
        }

        .error-message {
            color: red;
            font-size: 14px;
            margin-bottom: 15px;
        }
    </style>
</head>

<body>
    <div class="login-container">
        <div class="login-box">
            <h1>CONTROL DE ASISTENCIA</h1>
            <h2>Iniciar sesión</h2>

            <!-- Mostrar mensaje de éxito -->
            @if(session('success'))
                <div class="alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Mostrar mensajes de error si existen -->
            @if ($errors->any())
                <div class="error-message">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Formulario de login -->
            <form action="{{ route('loginn') }}" method="POST">
                @csrf
                <div class="input-group mb-3">
                    <label for="email">Correo electrónico</label>
                    <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}"
                        required>
                </div>

                <div class="input-group mb-3">
                    <label for="password">Contraseña</label>
                    <input type="password" id="password" name="password" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-primary">Iniciar sesión</button>
            </form>
 
            @if (Route::has('password.request'))
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                href="{{ route('password.request') }}">
                {{ __('¿Has olvidado tu contraseña?') }}
            </a>
        @endif

            <!-- Enlace para redirigir a la página de registro -->
            <div class="mt-3 text-center">
                <p>¿No tienes una cuenta? <a href="{{ route('register') }}">Regístrate aquí</a></p>
            </div>

        </div>
    </div>
</body>

</html>
