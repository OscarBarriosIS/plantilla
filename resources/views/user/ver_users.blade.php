<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Usuarios</title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
        integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">

    <style>
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

        /* Estilos de la tabla */
        table.dataTable thead th {
            background-color: #f1f5f9;
            color: #1e293b;
        }

        table.dataTable tbody tr:hover {
            background-color: #f3f4f6;
        }

        /* Estilos para alertas */
        .alert {
            background-color: #e6fffa;
            border: 1px solid #38b2ac;
            color: #285e61;
        }

        /* Estilos para modales */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100vh;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1001;
            overflow-y: auto;
            align-items: center;
            justify-content: center;
        }

        .modal-content {
            position: relative;
            margin: auto;
            padding: 20px;
            border: 1px solid #888;
            width: 90%;
            max-width: 800px;
            background-color: #29ABE2 ;
            color: #fff;
            border-radius: 10px;
            display: none;
            /* Ocultar por defecto */
        }

        .close {
            position: absolute;
            right: 10px;
            top: 0;
            font-size: 20px;
            font-weight: bold;
            cursor: pointer;
            color: #fff;
        }

        /*  IMPORTANTE:  ESTILOS PARA LOS SUBMENÚS  */
        .submenu {
            display: none;
            padding-left: 20px;
        }

        .submenu.activo {
            display: block;
        }

        .desplegable-menu {
            cursor: pointer;
        }

        .modal-content input[type="text"],
        .modal-content input[type="number"],
        .modal-content input[type="date"] {
            background-color: #00648f;
            color: #fff;
            border-color: #00648f;
            padding: 8px;
            border-radius: 5px;
            width: 100%;
            margin-bottom: 10px;
            display: block;
        }

        .modal-content label {
            color: #fff;
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .modal-content input[type="text"]:disabled,
        .modal-content input[type="number"]:disabled,
        .modal-content input[type="date"]:disabled {
            opacity: 0.7;
            cursor: not-allowed;
        }

        /* Estilos para las imágenes en el modal */
        .modal-content img {
            max-width: 100%;
            height: auto;
            margin-bottom: 10px;
            border-radius: 5px;
        }

        .titulo {
            font-size: 24px;
            font-weight: bold;
            color: #333;
            margin-top: 30px;
            text-align: center;
        }

        /* Estilos para botones dentro del modal */
        .modal-buttons {
            display: flex;
            justify-content: space-around;
            margin-top: 20px;
        }

        .modal-buttons button {
            background-color: #6b7280;
            color: white;
            font-bold;
            padding: 0.5rem 1rem;
            /* py-2 px-4 */
            border-radius: 0.25rem;
            /* rounded */
            flex: 1;
            margin: 0 0.3125rem;
            /* 0 5px */
        }

        .modal-buttons button:hover {
            background-color: #4b5563;
        }

        /* Estilo para una imagen predeterminada */
        .default-img-small {
            background-image: url('https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_640.png');
            background-size: cover;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin: 0 auto;
        }

        .profile-img-small {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
            /* Evita la distorsión de la imagen */
        }
    </style>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>

    @include('menu')
    @include('navbar')
    <div class="contenido-principal" id="contenidoPrincipal">
        <div class="titulo">
            <h2>Listado de Usuarios</h2>
        </div>

        <!-- Mensajes de error -->
        @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
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

        <div class="buscador"></div>

        <!-- Table Section -->
        <div class="flex justify-center">
            <div class="w-full max-w-6xl bg-white p-6 rounded-lg shadow-lg">
                <div class="overflow-x-auto">
                    <table id="userTable" class="min-w-full bg-white border rounded-lg">
                        <thead>
                            <tr>
                                <th class="px-4 py-2 text-left text-xs font-medium uppercase">Foto</th>
                                <th class="px-4 py-2 text-left text-xs font-medium uppercase">Nombre</th>
                                <th class="px-4 py-2 text-left text-xs font-medium uppercase">Email</th>
                                <th class="px-4 py-2 text-left text-xs font-medium uppercase">Rol</th>
                                <th class="px-4 py-2 text-left text-xs font-medium uppercase">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200 text-sm">
                            @foreach ($users as $user)
                                <tr>
                                    <td>
                                        <!-- Verificar si el usuario tiene imagen de perfil -->
                                        @if ($user->imagen && !Str::endsWith($user->imagen, 'default.png'))
                                            <img src="{{ asset('storage/' . $user->imagen) }}" alt="Foto de perfil"
                                                class="profile-img-small">
                                        @else
                                            <div class="default-img-small"></div> <!-- Imagen predeterminada -->
                                        @endif
                                    </td>
                                    <td class="px-4 py-2">{{ $user->name }}</td>
                                    <td class="px-4 py-2">{{ $user->email }}</td>
                                    <td class="px-4 py-2">
                                        @foreach ($user->getRoleNames() as $role)
                                            <!-- Aquí obtenemos los roles -->
                                            <span
                                                class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full">{{ $role }}</span>
                                        @endforeach
                                    </td>
                                    <td class="px-4 py-2">
                                        <div class="flex gap-2">
                                            <button data-user="{{ json_encode($user) }}"
                                                class="ver-user bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded flex items-center gap-2">
                                                <i class="fas fa-eye"></i> Ver
                                            </button>
                                            <button data-user="{{ json_encode($user) }}"
                                                class="editar-user bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded flex items-center gap-2">
                                                <i class="fas fa-edit"></i> Editar
                                            </button>
                                            <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                                                onsubmit="return confirm('¿Estás seguro de que deseas eliminar este usuario?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded flex items-center gap-2">
                                                    <i class="fas fa-trash"></i> Eliminar
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @if (count($users) === 0)
                    <p class="mt-4 text-gray-500 italic">No se encontraron usuarios.</p>
                @endif
            </div>
        </div>
    </div>

    <!-- Modal para Ver Usuario -->
    <div id="verUserModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="cerrarModal('verUserModal')">×</span>
            <h2 class="text-xl font-semibold mb-4 text-white text-center">Detalles del Usuario</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label for="view_nombre" class="block text-sm font-semibold text-white">Nombre</label>
                    <input type="text" id="view_nombre" disabled
                        class="mt-1 block w-full border-gray-300 rounded-md bg-[#323E35] text-white"
                        placeholder="Nombre">
                </div>
                <div>
                    <label for="view_apellido_paterno" class="block text-sm font-semibold text-white">Apellido
                        Paterno</label>
                    <input type="text" id="view_apellido_paterno" disabled
                        class="mt-1 block w-full border-gray-300 rounded-md bg-[#323E35] text-white"
                        placeholder="Apellido Paterno">
                </div>
                <div>
                    <label for="view_apellido_materno" class="block text-sm font-semibold text-white">Apellido
                        Materno</label>
                    <input type="text" id="view_apellido_materno" disabled
                        class="mt-1 block w-full border-gray-300 rounded-md bg-[#323E35] text-white"
                        placeholder="Apellido Materno">
                </div>
                <div>
                    <label for="view_email" class="block text-sm font-semibold text-white">Correo</label>
                    <input type="text" id="view_email" disabled
                        class="mt-1 block w-full border-gray-300 rounded-md bg-[#323E35] text-white"
                        placeholder="Correo">
                </div>
                <div>
                    <label for="view_telefono" class="block text-sm font-semibold text-white">Teléfono</label>
                    <input type="text" id="view_telefono" disabled
                        class="mt-1 block w-full border-gray-300 rounded-md bg-[#323E35] text-white"
                        placeholder="Teléfono">
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para Editar Usuario -->
    <div id="editarUserModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="cerrarModal('editarUserModal')">×</span>
            <h2 class="text-xl font-semibold mb-4 text-white text-center">Editar Detalles del Usuario</h2>
            <form id="editarUserForm" action="#" method="POST" data-id="">
                @csrf
                @method('PUT')
                <!-- Campos del formulario -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label for="edit_nombre" class="block text-sm font-semibold text-white">Nombre</label>
                        <input type="text" id="edit_nombre" name="name"
                            class="mt-1 block w-full border-gray-300 rounded-md bg-[#323E35] text-white"
                            placeholder="Nombre">
                    </div>
                    <div>
                        <label for="edit_apellido_paterno" class="block text-sm font-semibold text-white">Apellido
                            Paterno</label>
                        <input type="text" id="edit_apellido_paterno" name="apellido_paterno"
                            class="mt-1 block w-full border-gray-300 rounded-md bg-[#323E35] text-white"
                            placeholder="Apellido Paterno">
                    </div>
                    <div>
                        <label for="edit_apellido_materno" class="block text-sm font-semibold text-white">Apellido
                            Materno</label>
                        <input type="text" id="edit_apellido_materno" name="apellido_materno"
                            class="mt-1 block w-full border-gray-300 rounded-md bg-[#323E35] text-white"
                            placeholder="Apellido Materno">
                    </div>
                    <div>
                        <label for="edit_email" class="block text-sm font-semibold text-white">Correo</label>
                        <input type="email" id="edit_email" name="email"
                            class="mt-1 block w-full border-gray-300 rounded-md bg-[#323E35] text-white"
                            placeholder="Correo">
                    </div>
                    <div>
                        <label for="edit_telefono" class="block text-sm font-semibold text-white">Teléfono</label>
                        <input type="text" id="edit_telefono" name="telefono"
                            class="mt-1 block w-full border-gray-300 rounded-md bg-[#323E35] text-white"
                            placeholder="Teléfono">
                    </div>
                </div>

                <div class="modal-buttons">
                    <button type="submit"
                        class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Guardar
                        Cambios</button>
                    <button type="button"
                        class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded"
                        onclick="cerrarModal('editarUserModal')">Cancelar</button>
                </div>
            </form>
        </div>
    </div>


    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script>
        function cerrarModal(modalId) {
            document.getElementById(modalId).style.display = "none";
        }

        document.addEventListener("DOMContentLoaded", function() {
            // Crear el contenedor del buscador
            const buscadorDiv = document.querySelector('.buscador');
            if (buscadorDiv) { // Verifica que el elemento exista
                const searchContainer = document.createElement('div');
                searchContainer.classList.add('mb-4', 'flex', 'items-center', 'justify-start', 'ml-8');

                // Crear el input del buscador
                const searchInput = document.createElement('input');
                searchInput.type = 'text';
                searchInput.placeholder = 'Buscar...';
                searchInput.className =
                    'rounded-lg border border-gray-300 px-4 py-2 text-sm w-64 focus:outline-none focus:ring-2 focus:ring-blue-500';
                searchInput.id = 'customSearchInput';

                // Añadir el input al contenedor
                searchContainer.appendChild(searchInput);
                buscadorDiv.prepend(searchContainer);

                const table = $('#userTable').DataTable({
                    language: {
                        url: "https://cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json"
                    },
                    responsive: true,
                    autoWidth: false,
                    dom: '<"flex justify-between items-center mb-4"l>tip',
                    initComplete: function() {
                        $('.dataTables_filter').addClass('hidden');
                        $('.dataTables_length select').addClass(
                            'rounded-lg border border-gray-300 px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500'
                        );
                    },
                });

                // Vincular el input personalizado con el buscador de DataTables
                searchInput.addEventListener('input', function() {
                    table.search(this.value).draw();
                });
            }

            // Modal Logic
            const verUserModal = document.getElementById("verUserModal");
            const editarUserModal = document.getElementById("editarUserModal");
            const botonesVer = document.querySelectorAll(".ver-user");
            const botonesEditar = document.querySelectorAll(".editar-user");

            botonesVer.forEach(boton => {
                boton.addEventListener("click", function() {
                    const user = JSON.parse(this.dataset.user);
                    console.log(user);
                    llenarModalVer(user);
                    verUserModal.querySelector('.modal-content').style.display =
                        "block"; // Mostrar el contenido del modal
                    verUserModal.style.display = "flex";
                });
            });

            botonesEditar.forEach(boton => {
                boton.addEventListener("click", function() {
                    const user = JSON.parse(this.dataset.user);
                    llenarModalEditar(user);
                    editarUserModal.querySelector('.modal-content').style.display =
                        "block"; // Mostrar el contenido del modal
                    editarUserModal.style.display = "flex";
                });
            });

            function llenarModalVer(user) {
                document.getElementById("view_nombre").value = user.name || '';
                document.getElementById("view_apellido_paterno").value = user.apellido_paterno || '';
                document.getElementById("view_apellido_materno").value = user.apellido_materno || '';
                document.getElementById("view_email").value = user.email || '';
                document.getElementById("view_telefono").value = user.telefono || '';
            }

            function llenarModalEditar(user) {
                document.getElementById("edit_nombre").value = user.name || '';
                document.getElementById("edit_apellido_paterno").value = user.apellido_paterno || '';
                document.getElementById("edit_apellido_materno").value = user.apellido_materno || '';
                document.getElementById("edit_email").value = user.email || '';
                document.getElementById("edit_telefono").value = user.telefono || '';

                document.getElementById("editarUserForm").dataset.id = user.id; // Establece el ID en el formulario
            }

            window.onclick = function(event) {
                if (event.target.classList.contains('modal')) {
                    event.target.style.display = "none";
                    // Ocultar el contenido del modal cuando se cierra
                    event.target.querySelector('.modal-content').style.display = "none";
                }
            }

            document.querySelectorAll('.close').forEach(button => {
                button.addEventListener('click', function() {
                    const modal = this.closest('.modal');
                    modal.style.display = "none";
                    modal.querySelector('.modal-content').style.display =
                        "none"; // oculta el contenido
                });
            });

            // En el bloque DOMContentLoaded, después de la función cerrarModal
            document.getElementById('editarUserForm').addEventListener('submit', function(event) {
                event.preventDefault(); // Evita el envío normal del formulario
                const userId = this.dataset.id; // Obtiene el ID del usuario del atributo data-id
                // Recopila los datos del formulario
                const formData = {
                    name: document.getElementById('edit_nombre').value,
                    apellido_paterno: document.getElementById('edit_apellido_paterno').value,
                    apellido_materno: document.getElementById('edit_apellido_materno').value,
                    email: document.getElementById('edit_email').value,
                    telefono: document.getElementById('edit_telefono').value,
                };

                // Realiza la petición PUT usando fetch
                fetch(`/users/${userId}`, {
                        method: 'PUT',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                .getAttribute(
                                    'content') // Asegúrate de tener la meta etiqueta CSRF en tu HTML
                        },
                        body: JSON.stringify(formData)
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        // Maneja la respuesta exitosa
                        console.log('Success:', data);
                        cerrarModal('editarUserModal'); // Cierra el modal
                        location.reload(); // Recargar la página
                    })
                    .catch(error => {
                        // Maneja los errores
                        console.error('Error:', error);
                        location.reload(); // Recargar la página
                    });
            });
        });
    </script>

    <!-- JavaScript para colapsar el menú -->
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
                        contenidoPrincipal.classList.remove('colapsado');
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
