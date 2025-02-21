<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil</title>

    <!-- Font Awesome para íconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- Fuente Roboto de Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

    <!-- Estilos CSS actualizados -->
    <style>
        /* Estilos generales */
        body {
            margin: 0;
            padding: 0;
            font-family: 'Roboto', sans-serif;
            background-color: #f8f9fa;
        }

        /* Mejoras en la barra de desplazamiento */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-thumb {
            background: #29ABE2 ;
            border-radius: 4px;
        }

        /* Contenedor principal mejorado */
        .contenido-principal {
            margin-left: 250px;
            padding: 2rem;
            transition: all 0.3s ease;
        }

        .contenido-principal.colapsado {
            margin-left: 90px;
        }

        /* Tarjeta de perfil mejorada */
        .profile-container {
            max-width: 800px;
            margin: 2rem auto;
            background: white;
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 2.5rem;
            position: relative;
        }

        .profile-header {
            display: flex;
            align-items: center;
            margin-bottom: 2rem;
            border-bottom: 2px solid #eee;
            padding-bottom: 1.5rem;
        }

        .profile-image {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid #29ABE2 ;
            margin-right: 2rem;
        }

        .profile-info {
            flex: 1;
        }

        .profile-info h1 {
            color: #29ABE2 ;
            margin: 0;
            font-size: 2rem;
        }

        .profile-info p {
            color: #666;
            margin: 0.5rem 0;
        }

        .profile-actions {
            margin-top: 2rem;
            display: flex;
            gap: 1rem;
        }

        .btn-primary {
            background-color: #29ABE2 ;
            color: white;
            padding: 0.8rem 1.5rem;
            border: none;
            border-radius: 25px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 1rem;
        }

        .btn-primary:hover {
            background-color: #02354b;
            transform: translateY(-2px);
        }

        /* Modal de cambio de contraseña CORREGIDO */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1000;
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background: white;
            max-width: 500px;
            width: 90%;
            padding: 2rem;
            border-radius: 10px;
            position: relative;
        }

        .modal-header {
            border-bottom: 2px solid #eee;
            padding-bottom: 1rem;
            margin-bottom: 1.5rem;
            text-align: center;
        }

        .modal-header h2 {
            color: #29ABE2 ;
            margin: 0;
            font-size: 1.7rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            color: #444;
            text-align: left;
        }

        .form-group input {
            width: 100%;
            padding: 0.8rem;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1rem;
            box-sizing: border-box;
        }

        .close-modal {
            position: absolute;
            top: 1rem;
            right: 1rem;
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            color: #666;
        }

        /* Estilos responsivos */
        @media (max-width: 768px) {
            .profile-header {
                flex-direction: column;
                text-align: center;
            }

            .profile-image {
                margin-right: 0;
                margin-bottom: 1rem;
            }

            .contenido-principal {
                margin-left: 0;
                padding: 1rem;
            }
        }
    </style>
</head>

<body>
    @include('menu')
    @include('navbar')

    <div class="contenido-principal" id="contenidoPrincipal">
        <div class="profile-container">
            <div class="profile-header">
                <img src="{{ asset('storage/' . $user->imagen) }}" alt="Imagen de perfil" class="profile-image">
                <div class="profile-info">
                    <h1>{{ $user->name }} {{ $user->apellido_paterno }} {{ $user->apellido_materno }}</h1>
                    <p><i class="fas fa-envelope"></i> {{ $user->email }}</p>
                    <p><i class="fas fa-phone"></i> {{ $user->telefono }}</p>
                </div>
            </div>

            <div class="profile-actions">
                <button class="btn-primary" onclick="openModal()">
                    <i class="fas fa-lock"></i> Cambiar Contraseña
                </button>
            </div>
            @if (session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4"
                    role="alert">
                    <strong class="font-bold">¡Error!</strong>
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif

            <!-- Success Alert -->
            @if (session('success'))
                <div class="alert px-4 py-3 rounded relative mb-4" role="alert">
                    <strong class="font-bold">¡Éxito!</strong>
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif
        </div>
    </div>

    <!-- Modal de Cambio de Contraseña -->
    <div id="passwordModal" class="modal">
        <div class="modal-content">
            <button class="close-modal" onclick="closeModal()">×</button>
            <div class="modal-header">
                <h2>Cambiar Contraseña</h2>
            </div>
            <form method="POST" action="{{ route('perfil.password.update') }}">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="current_password">Contraseña Actual</label>
                    <input type="password" id="current_password" name="current_password" required>
                </div>
                <div class="form-group">
                    <label for="password">Nueva Contraseña</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <div class="form-group">
                    <label for="password_confirmation">Confirmar Nueva Contraseña</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" required>
                </div>
                <button type="submit" class="btn-primary">Guardar Cambios</button>
            </form>
        </div>
    </div>

    <script>
        // Funciones para el modal
        function openModal() {
            document.getElementById('passwordModal').style.display = 'flex';
        }

        function closeModal() {
            document.getElementById('passwordModal').style.display = 'none';
        }

        // Cerrar modal al hacer clic fuera
        window.onclick = function(event) {
            const modal = document.getElementById('passwordModal');
            if (event.target == modal) {
                closeModal();
            }
        }

        // Código del menú lateral
        document.addEventListener('DOMContentLoaded', () => {
            const desplegablesMenu = document.querySelectorAll('.desplegable-menu');
            const barraLateral = document.getElementById('barraLateral');
            const botonColapsar = document.getElementById('botonColapsar');
            const contenidoPrincipal = document.getElementById('contenidoPrincipal');
            const COOKIE_NAME = "menuState";

            // Funciones para cookies
            const setCookie = (name, value, days) => {
                let expires = "";
                if (days) {
                    const date = new Date();
                    date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
                    expires = "; expires=" + date.toUTCString();
                }
                document.cookie = name + "=" + (value || "") + expires + "; path=/";
            }

            const getCookie = (name) => {
                const nameEQ = name + "=";
                const ca = document.cookie.split(';');
                for (let i = 0; i < ca.length; i++) {
                    let c = ca[i];
                    while (c.charAt(0) === ' ') c = c.substring(1, c.length);
                    if (c.indexOf(nameEQ) === 0) return c.substring(nameEQ.length, c.length);
                }
                return null;
            }

            // Restaurar estado del menú
            const restoreMenuState = () => {
                const savedState = getCookie(COOKIE_NAME);
                if (savedState) {
                    const state = JSON.parse(savedState);
                    if (state.collapsed) {
                        barraLateral.classList.add('colapsada');
                        contenidoPrincipal.classList.add('colapsado');
                    }
                    // Resto de la lógica de restauración...
                }
            }

            restoreMenuState();

            // Eventos del menú
            desplegablesMenu.forEach(desplegable => {
                desplegable.addEventListener('click', (e) => {
                    e.preventDefault();
                    const submenu = desplegable.nextElementSibling;
                    desplegable.classList.toggle('activo');
                    submenu.classList.toggle('activo');
                });
            });

            botonColapsar.addEventListener('click', () => {
                barraLateral.classList.toggle('colapsada');
                contenidoPrincipal.classList.toggle('colapsado');
            });
        });
    </script>

</body>

</html>
