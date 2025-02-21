<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ver Usuarios</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>

    <style>
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
        
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }

        .sidebar {
            width: 250px;
            background-color: #2575fc;
            padding: 20px;
            color: white;
            height: 100vh;
            position: fixed;
            top: 0;
        }

        .sidebar a {
            color: white;
            text-decoration: none;
            display: block;
            padding: 10px 20px;
            margin: 5px 0;
            font-size: 18px;
        }

        .sidebar a:hover {
            background-color: #6a11cb;
            border-radius: 5px;
        }


        .form-container {
            margin-left: 260px;
            margin-top: 30px;
        }

        .table {
            background-color: white;
            border-radius: 8px;
            width: 200px;
            margin-top: 40px;
        }

        .table th, .table td {
            text-align: center;
            vertical-align: middle;
        }

        .table th, .table td {
            padding: 10px;
        }

        .table td {
            word-wrap: break-word;
            max-width: 200px; 
            text-overflow: ellipsis;
            overflow: hidden;
        }

        .btn-sm {
            font-size: 12px;
            padding: 5px 10px;
        }

        .table-responsive {
            margin-top: 20px;
        }

        .text-center {
            text-align: center;
        }

        /* Estilo para la imagen de perfil en un óvalo pequeño */
        .profile-img-small {
            width: 40px;
            height: 40px;
            object-fit: cover;
            border-radius: 50%; /* Hace la imagen circular */
            margin: 0 auto;
        }

        /* Estilo para una imagen predeterminada */
        .default-img-small {
            background-image: url('https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_640.png'); /* Imagen predeterminada */
            background-size: cover;
            width: 40px;
            height: 40px;
            border-radius: 50%; /* Hace la imagen circular */
            margin: 0 auto;
        }
    </style>
</head>

<body>

    @include('menu')
    @include('navbar')

    <div class="form-container">
        <h2 class="text-center mb-4">Lista de Usuarios</h2>

        @if(session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        <div class="table-responsive">
            <table id="usersTable" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Foto</th> <!-- Nueva columna para la imagen -->
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Rol</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>
                                <!-- Verificar si el usuario tiene imagen de perfil -->
                                @if($user->imagen && !Str::endsWith($user->imagen, 'default.png'))
                                    <img src="{{ asset('storage/' . $user->imagen) }}" alt="Foto de perfil" class="profile-img-small">
                                @else
                                    <div class="default-img-small"></div> <!-- Imagen predeterminada -->
                                @endif
                            </td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            {{-- <td>{{ $user->role ? $user->role->name : 'Sin rol' }}</td> --}}
                            <td>
                                @foreach($user->getRoleNames() as $role)  <!-- Aquí obtenemos los roles -->
                                    <span>{{ $role }}</span>
                                @endforeach
                            </td>
                            <td>
                                <a href="{{ route('edit_user', $user->id) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i> Editar
                                </a>
                            
                                <a href="{{ route('show_user', $user->id) }}" class="btn btn-info btn-sm">
                                    <i class="fas fa-eye"></i> Ver
                                </a>
                            
                                <form action="{{ route('delete_user', $user->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar este usuario?')">
                                        <i class="fas fa-trash"></i> Eliminar
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script>
        $(document).ready(function() {
            $('#usersTable').DataTable({
                dom: 'Bfrtip', 
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print' 
                ],
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.11.5/i18n/es_es.json' 
                },
                responsive: true 
            });
        });
    </script>

</body>
</html>
