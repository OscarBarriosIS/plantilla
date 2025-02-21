<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>

    <!-- Font Awesome para íconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
        integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Fuente Roboto de Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">

    <!-- Estilos CSS para el contenido principal -->
    <style>
        /* Estilos generales */
        body {
            margin: 0;
            padding: 0;
            font-family: 'Arial', sans-serif;
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
            /* Ancho inicial del menú lateral */
            padding: 40px 20px;
            width: calc(100% - 250px);
            /* Restar el ancho del menú */
            height: 100vh;
            background-color: #ffffff;
            display: flex;
            flex-direction: column;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.05);
            position: relative;
            transition: margin-left 0.3s ease, width 0.3s ease;
            /* Agregamos transición para el ancho */
            box-sizing: border-box;
            /* Importante para que el padding no afecte el ancho total */
        }

        /* Estilos cuando el contenido principal está colapsado */
        .contenido-principal.colapsado {
            margin-left: 90px;
            /* Ancho del menú lateral colapsado */
            width: calc(100% - 90px);
            /* Restar el ancho del menú colapsado */
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
    </style>

</head>

<body>

    @include('menu')
    @include('navbar')
    <div class="contenido-principal" id="contenidoPrincipal">
        <h1>Contenido Principal</h1>
        <p>Este es el contenido principal de tu páginaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa.</p>
    </div>

    <!-- JavaScript -->
    <script>
        function setCookie(name, value, days) {
            let expires = "";
            if (days) {
                const date = new Date();
                date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
                expires = "; expires=" + date.toUTCString();
            }
            document.cookie = name + "=" + (value || "") + expires + "; path=/";
        }

        function getCookie(name) {
            const nameEQ = name + "=";
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
            const COOKIE_NAME = "menuState";

            // Function to save menu state to cookie
            function saveMenuState() {
                let state = {
                    collapsed: barraLateral.classList.contains('colapsada'),
                    activeMenu: null
                };

                // Find the active menu
                desplegablesMenu.forEach(menu => {
                    if (menu.classList.contains('activo')) {
                        state.activeMenu = menu.dataset.menu;
                    }
                });
                setCookie(COOKIE_NAME, JSON.stringify(state), 7); // Save for 7 days
            }

            // Function to restore menu state from cookie
            function restoreMenuState() {
                const savedState = getCookie(COOKIE_NAME);

                if (savedState) {
                    const state = JSON.parse(savedState);

                    if (state.collapsed) {
                        barraLateral.classList.add('colapsada');
                        contenidoPrincipal.classList.add('colapsado');
                    } else {
                        barraLateral.classList.remove('colapsada');
                        contenidoPrincipal.classList.remove('colapsada');
                    }

                    if (state.activeMenu) {
                        desplegablesMenu.forEach(menu => {
                            if (menu.dataset.menu === state.activeMenu) {
                                menu.classList.add('activo');
                                menu.nextElementSibling.classList.add('activo');
                            }
                        });
                    }
                }
            }

            // Restore menu state on load
            restoreMenuState();

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

                    saveMenuState(); // Save state after click
                });
            });

            // Evento para colapsar/expandir la barra lateral
            botonColapsar.addEventListener('click', () => {
                barraLateral.classList.toggle('colapsada');
                contenidoPrincipal.classList.toggle('colapsado');
                saveMenuState(); // Save state after collapse
            });
        });
    </script>

</body>

</html>
