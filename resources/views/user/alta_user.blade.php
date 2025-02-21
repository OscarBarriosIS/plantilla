<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale: 1.0">
    <title>Alta Formulario</title>

    <!-- Font Awesome para íconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
        integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Fuente Roboto de Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <!-- Estilos CSS -->
    <style>
        /* Estilos generales */
        body {
            margin: 0;
            padding: 0;
            font-family: 'Arial', sans-serif;
            background-color: #f0f0f0;
        }

        /* Estilos de la barra de desplazamiento */
        ::-webkit-scrollbar {
            width: 10px;
        }

        ::-webkit-scrollbar-thumb {
            background: linear-gradient(1deg, #29ABE2 , #00648f);
            border-radius: 20px;
        }

        ::-webkit-scrollbar-track {
            background: #ffffff;
        }

        /* Estilos del contenido principal */
        .contenido-principal {
            margin-left: 250px;
            padding: 40px 20px;
            width: calc(100% - 250px);
            min-height: 100vh;
            background-color: #f2f2f2;
            display: flex;
            flex-direction: column;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.05);
            position: relative;
            transition: margin-left 0.3s ease, width 0.3s ease;
            box-sizing: border-box;
        }

        .contenido-principal.colapsado {
            margin-left: 90px;
            width: calc(100% - 90px);
        }

        /* Estilos responsivos */
        @media (max-width: 768px) {
            .contenido-principal {
                margin-left: 0;
                width: 100%;
            }

            .contenido-principal.colapsado {
                margin-left: 0;
                width: 100%;
            }
        }

        /* Estilos del título */
        .titulo {
            font-size: 24px;
            font-weight: bold;
            color: #333;
            margin-top: 30px;
            text-align: center;
        }

        .register-container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: #f2f2f2e8;
            padding: 20px;
        }

        .register-box {
            background: rgba(255, 255, 255, 0.8);
            /* Make background slightly transparent */
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 550px;
            text-align: center;
        }

        .register-box h4 {
            margin-bottom: 20px;
            color: #333;
            font-size: 18px;
        }

        .input-group {
            margin-bottom: 15px;
            position: relative;
        }

        .input-group label {
            display: none;
        }

        .input-group input {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border-radius: 5px;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }

        .input-group input:focus {
            outline: none;
            border-color: #29ABE2 ;
            box-shadow: 0 0 5px rgba(141, 27, 61, 0.3);
        }

        .input-group input::placeholder {
            color: #999;
        }

        .input-group select {
            width: 100%;
            /* Ajusta el ancho al 100% de su contenedor */
            padding: 8px;
            /* Espaciado interno */
            border: 1px solid #ccc;
            /* Borde gris claro */
            border-radius: 4px;
            /* Bordes redondeados */
            font-size: 16px;
            /* Tamaño de la fuente */
            background-color: #f9f9f9;
            /* Color de fondo */
        }

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
            background-color: #6b152d;
        }

        .error-message {
            color: red;
            font-size: 14px;
            margin-bottom: 10px;
        }

        .register-link {
            color: #29ABE2 ;
            text-decoration: none;
            font-size: 14px;
        }

        .register-link:hover {
            text-decoration: underline;
        }
    </style>

</head>

<body>

    @include('menu')
    <div class="register-container contenido-principal" id="contenidoPrincipal">
        <div class="register-box">

            <div class="titulo">
                <h2>Registro de Usuarios</h2>
            </div>
            <!-- Si hay errores de validación, se mostrarán aquí -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('user.store') }}" enctype="multipart/form-data">
                @csrf

                <!-- Imagen de Perfil (File Upload) -->
                <div class="input-group">
                    <label for="imagen">Imagen de Perfil</label>
                    <input type="file" name="imagen" id="imagen" class="form-control"
                        placeholder="Imagen de Perfil">
                </div>

                <!-- Nombre -->
                <div class="input-group">
                    <label for="name">Nombre</label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="Nombre"
                        value="{{ old('name') }}" required autofocus>
                </div>

                <!-- Apellido Paterno -->
                <div class="input-group">
                    <label for="apellido_paterno">Apellido Paterno</label>
                    <input type="text" name="apellido_paterno" id="apellido_paterno" class="form-control"
                        placeholder="Apellido Paterno" value="{{ old('apellido_paterno') }}" required autofocus>
                </div>

                <!-- Apellido Materno -->
                <div class="input-group">
                    <label for="apellido_materno">Apellido Materno</label>
                    <input type="text" name="apellido_materno" id="apellido_materno" class="form-control"
                        placeholder="Apellido Materno" value="{{ old('apellido_materno') }}" required autofocus>
                </div>

                <!-- Correo Electrónico -->
                <div class="input-group">
                    <label for="email">Correo Electrónico</label>
                    <input type="email" name="email" id="email" class="form-control"
                        placeholder="Correo Electrónico" value="{{ old('email') }}" required>
                </div>

                <!-- Teléfono -->
                <div class="input-group">
                    <label for="telefono">Teléfono</label>
                    <input type="text" name="telefono" id="telefono" maxlength="10" class="form-control"
                        placeholder="Teléfono" value="{{ old('telefono') }}" required
                        oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                </div>

                <!-- Contraseña -->
                <div class="input-group">
                    <label for="password">Contraseña</label>
                    <input type="password" name="password" id="password" class="form-control" placeholder="Contraseña"
                        required>
                    <i class="fas fa-eye password-toggle" id="password-toggle"></i>
                </div>

                <!-- Confirmar Contraseña -->
                <div class="input-group">
                    <label for="password_confirmation">Confirmar Contraseña</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control"
                        placeholder="Confirmar Contraseña" required>
                    <i class="fas fa-eye password-toggle" id="password-toggle2"></i>
                </div>

                <div class="input-group">
                    <label for="role">Selecciona un Rol</label>
                    <select name="role" id="role" class="form-control">
                        @foreach ($roles as $role)
                            <option value="{{ $role->name }}">{{ $role->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Botón de registro -->
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Registrar') }}
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- JavaScript -->
    <script>
        function establecerCookie(nombre, valor, dias) {
            let expires = "";
            if (dias) {
                const fecha = new Date();
                fecha.setTime(fecha.getTime() + (dias * 24 * 60 * 60 * 1000));
                expires = "; expires=" + fecha.toUTCString();
            }
            document.cookie = nombre + "=" + (valor || "") + expires + "; path=/";
        }

        function obtenerCookie(nombre) {
            const nameEQ = nombre + "=";
            const ca = document.cookie.split(';');
            for (let i = 0; i < ca.length; i++) {
                let c = ca[i];
                while (c.charAt(0) === ' ') c = c.substring(1, c.length);
                if (c.indexOf(nameEQ) === 0) return c.substring(nameEQ.length, c.length);
            }
            return null;
        }

        document.addEventListener('DOMContentLoaded', () => {
            const desplegablesMenu = document.querySelectorAll('.desplegable-menu');
            const barraLateral = document.getElementById('barraLateral');
            const botonColapsar = document.getElementById('botonColapsar');
            const contenidoPrincipal = document.getElementById('contenidoPrincipal');
            const NOMBRE_COOKIE = "menuState";

            // Function to save menu state to cookie
            function guardarEstadoMenu() {
                let estado = {
                    collapsed: barraLateral.classList.contains('colapsada'),
                    activeMenu: null
                };

                // Find the active menu
                desplegablesMenu.forEach(menu => {
                    if (menu.classList.contains('activo')) {
                        estado.activeMenu = menu.dataset.menu;
                    }
                });
                establecerCookie(NOMBRE_COOKIE, JSON.stringify(estado), 7); // Save for 7 days
            }

            // Function to restore menu state from cookie
            function restaurarEstadoMenu() {
                const estadoGuardado = obtenerCookie(NOMBRE_COOKIE);

                if (estadoGuardado) {
                    const estado = JSON.parse(estadoGuardado);

                    if (estado.collapsed) {
                        barraLateral.classList.add('colapsada');
                        contenidoPrincipal.classList.add('colapsado');
                    } else {
                        barraLateral.classList.remove('colapsada');
                        contenidoPrincipal.classList.remove('colapsado');
                    }

                    if (estado.activeMenu) {
                        desplegablesMenu.forEach(menu => {
                            if (menu.dataset.menu === estado.activeMenu) {
                                menu.classList.add('activo');
                                menu.nextElementSibling.classList.add('activo');
                            }
                        });
                    }
                }
            }

            // Restore menu state on load
            restaurarEstadoMenu();

            // Evento para desplegar/ocultar submenús
            desplegablesMenu.forEach(desplegable => {
                desplegable.addEventListener('click', (evento) => {
                    evento.preventDefault(); // Evita el comportamiento predeterminado del enlace
                    const submenu = desplegable.nextElementSibling;

                    if (desplegable.classList.contains('activo')) {
                        // Si el submenu está activo, lo cerramos
                        desplegable.classList.remove('activo');
                        submenu.classList.remove('activo');
                    } else {
                        // Si no está activo, cerramos todos los demás y abrimos este
                        desplegablesMenu.forEach(otroDesplegable => {
                            otroDesplegable.classList.remove('activo');
                            otroDesplegable.nextElementSibling.classList.remove('activo');
                        });
                        desplegable.classList.add('activo');
                        submenu.classList.add('activo');
                    }

                    guardarEstadoMenu(); // Save state after click
                });
            });

            // Evento para colapsar/expandir la barra lateral
            botonColapsar.addEventListener('click', () => {
                barraLateral.classList.toggle('colapsada');
                contenidoPrincipal.classList.toggle('colapsado');
                guardarEstadoMenu(); // Save state after collapse
            });
        });

        $(document).ready(function() {
            const passwordInput = document.getElementById('password');
            const passwordToggle = document.getElementById('password-toggle');
            const passwordInput2 = document.getElementById('password_confirmation');
            const passwordToggle2 = document.getElementById('password-toggle2');

            passwordToggle.addEventListener('click', function() {
                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                    passwordToggle.classList.remove('fa-eye');
                    passwordToggle.classList.add('fa-eye-slash');
                } else {
                    passwordInput.type = 'password';
                    passwordToggle.classList.remove('fa-eye-slash');
                    passwordToggle.classList.add('fa-eye');
                }
            });
            passwordToggle2.addEventListener('click', function() {
                if (passwordInput2.type === 'password') {
                    passwordInput2.type = 'text';
                    passwordToggle2.classList.remove('fa-eye');
                    passwordToggle2.classList.add('fa-eye-slash');
                } else {
                    passwordInput2.type = 'password';
                    passwordToggle2.classList.remove('fa-eye-slash');
                    passwordToggle2.classList.add('fa-eye');
                }
            });
        });
    </script>

</body>

</html>
