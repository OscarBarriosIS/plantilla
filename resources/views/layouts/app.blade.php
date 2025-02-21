{{-- <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
</html> --}}

<style>
    .sidebar {
        width: 250px;
        background-color: #2575fc;
        color: white;
        height: 100vh;
        padding-top: 30px;
        position: fixed;
        display: flex;
        flex-direction: column;
    }

    .user-info {
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 20px;
        border-bottom: 1px solid #f1f1f1;
        text-align: center;
    }

    .user-avatar {
        width: 80px;
        height: 100px;
        border-radius: 50%;
        margin-bottom: 10px;
        object-fit: cover;
    }

    .user-name {
        font-size: 18px;
        font-weight: bold;
        color: white;
        margin-top: 5px;
    }

    .submenu-toggle {
        cursor: pointer;
    }

    .submenu {
        display: none;
        list-style: none;
        padding-left: 20px;
    }

    .submenu li a {
        font-size: 16px;
        color: #f1f1f1;
        padding: 10px 0;
        display: block;
    }

    .submenu li a:hover {
        background-color: #6a11cb;
    }

    .submenu.active {
        display: block;
    }
    .sidebar {
            width: 250px;
            background-color: #2575fc;
            color: white;
            height: 100vh;
            padding-top: 30px;
            position: fixed;
        }

        .sidebar h3 {
            text-align: center;
            margin-bottom: 30px;
            font-size: 24px;
        }

        .sidebar a {
            color: white;
            padding: 15px;
            display: block;
            text-decoration: none;
            font-size: 18px;
            border-bottom: 1px solid #f1f1f1;
            transition: background-color 0.3s;
        }

        .sidebar a:hover {
            background-color: #6a11cb;
        }
</style>



<div class="sidebar">
    <div class="user-info">
        @if (auth()->user()->imagen)
            <img src="{{ asset('storage/' . auth()->user()->imagen) }}" alt="Foto de perfil" class="user-avatar">
        @else
            <img src="{{ asset('images/default-avatar.png') }}" alt="Foto de perfil" class="user-avatar">
        @endif
        <div class="user-name">{{ auth()->user()->name }}</div>
    </div>

    <a href="{{ route('dashboard') }}"><i class="fas fa-tachometer-alt"></i> Dashboard</a>

    <a href="#" class="submenu-toggle"><i class="fas fa-ticket-alt"></i> Tickets <i
            class="fas fa-chevron-down"></i></a>
    <ul class="submenu">
        <li><a href="">Ver tickets</a></li>
        <li><a href="">Crear ticket</a></li>
        <li><a href="">Historial de tickets</a></li>
    </ul>

    <a href="#" class="submenu-toggle"><i class="fas fa-user-tie"></i> Clientes <i
            class="fas fa-chevron-down"></i></a>
    <ul class="submenu">
        <li><a href="">Ver clientes</a></li>
        <li><a href="">Agregar cliente</a></li>
        <li><a href="">Historial de clientes</a></li>
    </ul>

    <a href="#" class="submenu-toggle"><i class="fas fa-clipboard-list"></i> Actividades <i
            class="fas fa-chevron-down"></i></a>
    <ul class="submenu">
        <li><a href="">Ver actividades</a></li>
        <li><a href="">Agregar actividad</a></li>
        <li><a href="">Historial de actividades</a></li>
    </ul>

    <a href="#" class="submenu-toggle"><i class="fas fa-users"></i> Recursos Humanos <i
            class="fas fa-chevron-down"></i></a>
    <ul class="submenu">
        <li><a href="{{ route('ver_users') }}">Empleados</a></li>
        <li><a href="">Dashboard de Empleados</a></li>
        <li><a href="{{ route('registro_usuarios') }}">Alta Empleado</a></li>
        <li><a href="">Consulta Empleado</a></li>
    </ul>

    <a href="#" class="submenu-toggle"><i class="fas fa-calendar-check"></i> Reportes <i
            class="fas fa-chevron-down"></i></a>
    <ul class="submenu">
        <li><a href="{{ route('report') }}">Asistencia</a></li>
        <li><a href="{{ route('ver_vacaciones') }}">Vacaciones</a></li>
        <li><a href="{{ route('ver_permisos') }}">Permisos</a></li>
        
    </ul>


    <a href="#" class="submenu-toggle"><i class="fas fa-cogs"></i> Configuración <i
            class="fas fa-chevron-down"></i></a>
    <ul class="submenu">
        <li><a href="{{ route('change-profile-data', auth()->user()->id) }}"><i class="fas fa-edit"></i> Cambiar datos</a></li>
    </ul>

    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        <i class="fas fa-sign-out-alt"></i> Cerrar sesión
    </a>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
</div>



<script>
    const submenuToggles = document.querySelectorAll('.submenu-toggle');

    submenuToggles.forEach(toggle => {
        toggle.addEventListener('click', () => {
            const submenu = toggle.nextElementSibling;

            if (submenu.classList.contains('active')) {
                submenu.classList.remove('active');
            } else {
                submenu.classList.add('active');
            }
        });
    });
</script>
