<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Vacaciones</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
       /* Sidebar - Menú lateral */
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

        /* Estilos para el contenido principal */
        .main-content {
            margin-left: 250px;
            padding: 20px;
            background-color: #f4f7fa;
            min-height: 100vh;
        }

        h1 {
            text-align: center;
            color: #2575fc;
            margin-bottom: 30px;
        }

        /* Estilo para la tabla */
        .table {
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
            background-color: #fff;
        }

        .table th,
        .table td {
            vertical-align: middle;
        }

        .table thead {
            background-color: #2575fc;
            color: white;
        }

        /* Estilo de botones */
        .btn-custom {
            font-weight: bold;
            padding: 8px 15px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .btn-custom:hover {
            opacity: 0.8;
        }

        .btn-success {
            background-color: #28a745;
            border: none;
        }

        .btn-danger {
            background-color: #dc3545;
            border: none;
        }

        /* Mensaje de éxito */
        .alert {
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    @include('menu')

    <div class="main-content">
        <h1>Permisos de los Empleados</h1>

        <!-- Mensaje de éxito -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Tabla de vacaciones -->
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>Empleado</th>
                    <th>Fecha Inicio</th>
                    <th>Fecha Fin</th>
                    <th>Total de Días</th>
                    <th>Estado</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($permisos as $permiso)
                    <tr>
                        <td>{{ $permiso->user->name }}</td>
                        <td>{{ \Carbon\Carbon::parse($permiso->fecha_inicio)->format('d/m/Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($permiso->fecha_fin)->format('d/m/Y') }}</td>
                        <td>{{ $permiso->dias_permiso }} días</td>
                        <td>
                            <span
                                class="badge 
                                @if ($permiso->estado == 'pendiente') badge-warning 
                                @elseif ($permiso->estado == 'autorizado') badge-success 
                                @else badge-danger @endif">
                                {{ ucfirst($permiso->estado) }}
                            </span>
                        </td>

                        <td>
                            @if ($permiso->estado == 'pendiente')
                                <form action="{{ route('autorizar_vacaciones') }}" method="POST"
                                    style="display: inline;">
                                    @csrf
                                    <input type="hidden" name="vacacion_id" value="{{ $permiso->id }}">
                                    <button type="submit" name="estado" value="autorizado"
                                        class="btn btn-success btn-custom">Autorizar</button>
                                    <button type="submit" name="estado" value="denegado"
                                        class="btn btn-danger btn-custom">Denegar</button>
                                </form>
                            @else
                                <span>Ya procesada</span>
                            @endif
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
