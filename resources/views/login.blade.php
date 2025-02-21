<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenida</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
        integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body {
            background-color: aliceblue;
            background-image: url("https://www.transparenttextures.com/patterns/beige-paper.png");
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            height: 100vh;
        }

        .login-container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: transparent;
            padding: 20px;
        }

        .login-box {
            padding: 1px;
            border-radius: 10px;
            width: 100%;
            max-width: 400px;
            text-align: center;
            border: 1px solid #00000049;
        }

        .login-box img {
            max-width: 300px;
            margin-bottom: 20px;
        }

        /* Tab Styles */
        .tab-container {
            display: flex;
        }

        .tab {
            padding: 10px 20px;
            cursor: pointer;
            border: none;
            background-color: aliceblue;
            color: #495057;
            border-radius: 5px 5px 0 0;
            flex: 1;
            text-align: center;
            transition: background-color 0.3s, color 0.3s;
        }

        .tab.active {
            background-color: #29ABE2;
            color: aliceblue;
            border-bottom: 2px solid #29ABE2;
        }

        /* Form Styles */
        .form-container {
            display: none;
        }

        .form-container.active {
            display: block;
        }

        .input-group {
            margin-bottom: 15px;
            position: relative;
        }

        .input-group label {
            display: none;
        }

        .input-group input,
        .input-group textarea,
        .input-group select {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border-radius: 5px;
            border: 1px solid aliceblue;
            box-sizing: border-box;
            font-family: 'Roboto', sans-serif;
            /* Match body font */
        }

        .input-group input:focus,
        .input-group textarea:focus,
        .input-group select:focus {
            outline: none;
            border-color: #29ABE2;
            box-shadow: 0 0 5px rgba(3, 41, 57, 0.3);
        }

        .input-group input::placeholder,
        .input-group textarea::placeholder {
            color: #999;
        }

        .btn {
            background-color: #29ABE2;
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
            background-color: #286e85;
        }

        /* Link Styles */
        .forgot-password-link {
            display: block;
            margin-top: 8px;
            text-align: center;
            color: #555;
            text-decoration: none;
            font-size: 14px;
        }

        .forgot-password-link:hover {
            text-decoration: underline;
            color: #29ABE2;
        }

        .register-link {
            color: #29ABE2;
            text-decoration: none;
            font-size: 14px;
        }

        .register-link:hover {
            text-decoration: underline;
        }

        /* Error Message Styles */
        .error-message {
            color: red;
            font-size: 14px;
            margin-bottom: 10px;
            text-align: left;
            /* Align errors */
        }

        .password-toggle {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #555;
        }

        .formulario {
            background-color: aliceblue;
            padding: 10px;
        }

        .grid-cols-2 {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 10px;
            /* Adjust the gap as needed */
        }

        .logoImg {
            background-color: aliceblue;
            background-image: url("img/personas.jpg");
            background-size: cover;
            background-position: center;
            align-content: center;
            height: 150px;
        }
    </style>
</head>

<body>
    <div class="login-container">
        <div class="login-box">

            <div class="logoImg">
                <h1 style="color:white">Bienvenido</h1>
            </div>

            <div class="tab-container">
                <button class="tab active" data-tab="login">Acceso</button>
                <button class="tab" data-tab="register">Registro</button>
            </div>
            <div class="formulario">
                <!-- Login Form -->
                <div id="login" class="form-container active">
                    @if (session('success'))
                        <div class="alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="error-message">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('loginn') }}" method="POST">
                        @csrf
                        <div class="input-group">
                            <input type="email" id="email" name="email" class="form-control"
                                placeholder="Correo electrónico" value="{{ old('email') }}" required>
                        </div>

                        <div class="input-group">
                            <input type="password" id="password" name="password" class="form-control"
                                placeholder="Contraseña" required>
                        </div>

                        <button type="submit" class="btn">Iniciar sesión</button>

                        <a class="register-link" href="{{ route('recuperarContrase') }}">¿Olvidaste tu contraseña?</a>

                    </form>
                </div>

                <!-- Registration Form -->
                <div id="register" class="form-container">
                    @if ($errors->any())
                        <div class="error-message">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form method="POST" action="{{ route('registerNel') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="grid-cols-2">

                            <div class="input-group">
                                <input type="text" name="name" id="name" class="form-control"
                                    placeholder="Nombre" value="{{ old('name') }}" required autofocus>
                            </div>

                            <div class="input-group">
                                <input type="text" name="apellido_paterno" id="apellido_paterno" class="form-control"
                                    placeholder="Apellido Paterno" value="{{ old('apellido_paterno') }}" required>
                            </div>

                            <div class="input-group">
                                <input type="text" name="apellido_materno" id="apellido_materno" class="form-control"
                                    placeholder="Apellido Materno" value="{{ old('apellido_materno') }}" required>
                            </div>

                            <div class="input-group">
                                <input type="email" name="email" id="email" class="form-control"
                                    placeholder="Correo Electrónico" value="{{ old('email') }}" required>
                            </div>

                            <div class="input-group">
                                <input type="text" name="telefono" id="telefono" maxlength="10" class="form-control"
                                    placeholder="Teléfono" value="{{ old('telefono') }}" required
                                    oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                            </div>

                            <div class="input-group">
                                <input type="password" name="password" id="password" class="form-control"
                                    placeholder="Contraseña" required>
                                <i class="fas fa-eye password-toggle" id="password-toggle-reg"></i>
                            </div>

                            <div class="input-group">
                                <input type="password" name="password_confirmation" id="password_confirmation"
                                    class="form-control" placeholder="Confirmar Contraseña" required>
                            </div>
                            <div class="input-group">
                                <input type="file" name="imagen" id="imagen" class="form-control"
                                    placeholder="Imagen de Perfil">
                            </div>
                        </div>

                        <button type="submit" class="btn">
                            {{ __('Registrar') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <script>
            const tabs = document.querySelectorAll('.tab');
            const forms = document.querySelectorAll('.form-container');

            tabs.forEach(tab => {
                tab.addEventListener('click', () => {
                    tabs.forEach(t => t.classList.remove('active'));
                    forms.forEach(f => f.classList.remove('active'));

                    tab.classList.add('active');
                    const tabId = tab.dataset.tab;
                    document.getElementById(tabId).classList.add('active');
                });
            });

            const passwordInputReg = document.getElementById('password');
            const passwordToggleReg = document.getElementById('password-toggle-reg');

            passwordToggleReg.addEventListener('click', function() {
                if (passwordInputReg.type === 'password') {
                    passwordInputReg.type = 'text';
                    passwordToggleReg.classList.remove('fa-eye');
                    passwordToggleReg.classList.add('fa-eye-slash');
                } else {
                    passwordInputReg.type = 'password';
                    passwordToggleReg.classList.remove('fa-eye-slash');
                    passwordToggleReg.classList.add('fa-eye');
                }
            });
        </script>
</body>

</html>
