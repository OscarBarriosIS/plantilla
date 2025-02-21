<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Contraseña</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
        integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body {
            background: linear-gradient(to right,
                    #286e85,
                    /* Blue */
                    #29ABE2  50%),
                /* Blue */
                linear-gradient(to bottom,
                    rgba(240, 244, 247, 1) 0%,
                    /* White starts immediately after */
                    rgba(240, 244, 247, 1) 100%);
            /* White continues to the bottom */
            background-position: top, bottom;
            background-size: 100% 50%, 100% 50%;
            background-repeat: no-repeat, no-repeat;

            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            /* Ensure the gradient covers the full viewport height */
        }

        .login-container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            /* Use 100vh here too */
            background-color: transparent;
            /* Remove background color to see the body gradient */
            padding: 20px;
        }

        .login-box {
            /* Make background slightly transparent */
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        .login-box h1 {
            margin-bottom: 10px;
            color: #29ABE2 ;
            font-size: 28px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
        }


        .login-box img {
            max-width: 300px;
        }

        .input-group {
            margin-bottom: 15px;
            /* Adjusted spacing */
            position: relative;
            /* For password toggle icon positioning */
        }

        .input-group label {
            display: none;
            /* Hide labels */
        }

        .input-group input {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border-radius: 5px;
            border: 1px solid #ccc;
            box-sizing: border-box;
            /* Ensure padding is included in width */
        }

        .input-group input:focus {
            outline: none;
            border-color: #29ABE2 ;
            box-shadow: 0 0 5px #001b27;
        }

        .input-group input::placeholder {
            color: #999;
            /* Placeholder text color */
        }

        /* Password Toggle Icon */
        .password-toggle {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #555;
        }

        .btn {
            background-color: #29ABE2 ;
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
            background-color: #29ABE2 ;
        }

        .error-message {
            color: red;
            font-size: 14px;
            margin-bottom: 10px;
            /* Adjusted spacing */
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
            padding: 8px;
            border-radius: 5px;
            margin-bottom: 10px;
            /* Adjusted spacing */
            font-size: 14px;
            /* Smaller font size for alert messages */
        }

        .forgot-password-link {
            display: block;
            margin-top: 8px;
            /* Adjusted spacing */
            text-align: center;
            color: #555;
            text-decoration: none;
            font-size: 14px;
            /* Smaller font size for the link */
        }

        .forgot-password-link:hover {
            text-decoration: underline;
            color: #29ABE2 ;
        }

        .back-to-login-link {
            color: #29ABE2 ;
            text-decoration: none;
            font-size: 14px;
            /* Smaller font size for the link */
        }

        .back-to-login-link:hover {
            text-decoration: underline;
        }

        .inicioST {
            color: aliceblue;
            margin-bottom: 80px;
        }
    </style>
</head>

<body>
    <div class="login-container">
        <div class="login-box">
            <img src="{{ asset('img/logo.png') }}" alt="Logo">
            <h4 class="inicioST">Recuperar Contraseña</h4>

            <!-- Mostrar mensaje de éxito -->
            @if (session('status'))
                <div class="alert-success">
                    {{ session('status') }}
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

            <!-- Formulario de Recuperación de Contraseña -->
            <form method="POST" action="{{ route('password.recover') }}">
                @csrf
                <div class="input-group">
                    <input id="email" type="email" placeholder="Correo electrónico"
                        class="form-control @error('email') is-invalid @enderror" name="email"
                        value="{{ old('email') }}" required autocomplete="email" autofocus>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <button type="submit" class="btn">
                    {{ __('Enviar enlace de restablecimiento de contraseña') }}
                </button>
            </form>

            <a class="back-to-login-link" href="{{ route('login') }}">Volver al Inicio de Sesión</a>
        </div>
    </div>
</body>

</html>
