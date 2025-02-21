<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Actividades</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

     <!--===== Codigo Datatable ======== -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

    <style>
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            padding: 20px;
        }

        /* Contenedor para la tabla con desplazamiento horizontal */
        .table-container {
            width: 100%;
            overflow-x: auto;
            margin-top: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 10px;
            text-align: center;
            border: 1px solid #ccc;
        }

        th {
            background-color: #2575fc;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #e6f0ff;
        }

        tr:hover {
            background-color: #b3d1ff;
        }

        .late {
            background-color: #f44336;
            color: white;
        }

        .ontime {
            background-color: #4CAF50;
            color: white;
        }

        .lunch {
            background-color: #f0ad4e;
            color: white;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .options-btns {
            display: flex;
            justify-content: center;
            gap: 10px;
        }

        .options-btns a,
        .options-btns button {
            padding: 0.25rem 0.75rem;
            border-radius: 0.375rem;
            text-decoration: none;
            font-size: 14px;
        }

        .options-btns a {
            color: #ffffff;
        }

        .options-btns a:hover {
            opacity: 0.8;
        }

        /* Estilos para cada botón */
        .options-btns .view {
            background-color: #3b82f6;
        }

        .options-btns .edit {
            background-color: #fbbf24;
        }

        .options-btns .delete {
            background-color: #ef4444;
            color: white;
        }

        /* Estilos para el menú */
        nav {
            background-color: #2575fc;
            padding: 15px;
            color: white;
        }

        nav ul {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            justify-content: space-around;
        }

        nav ul li {
            display: inline;
        }

        nav ul li a {
            color: white;
            text-decoration: none;
            padding: 10px 20px;
            font-size: 16px;
        }

        nav ul li a:hover {
            background-color: #6a11cb;
            border-radius: 5px;
        }

        /* Sidebar */
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

        .sidebar a i {
            margin-right: 8px;
            font-size: 18px;
            color: #333;
        }


        table {
    width: 100%;
    border-collapse: collapse;
    background-color: #fff;
    border-radius: 10px;
    overflow: hidden;
}

th,
td {
    padding: 12px 15px;
    text-align: center;
    border-bottom: 1px solid #ddd;
}

th {
    background-color: #4fa3d1; /* Color azul claro */
    color: white;
    font-size: 16px;
    font-weight: 600;
}

tr:nth-child(even) {
    background-color: #f9f9f9;
}

tr:hover {
    background-color: #f1f1f1;
    cursor: pointer;
}

.dataTables_filter input {
    border-radius: 8px;
    padding: 10px;
    border: 1px solid #ddd;
    margin-bottom: 15px;
    font-size: 14px;
}


.dataTables_paginate {
    text-align: center;
    margin-top: 15px;
}

.dataTables_paginate a {
    padding: 8px 16px;
    background-color: #4fa3d1; /* Azul claro */
    color: white;
    border-radius: 5px;
    margin: 0 3px;
    text-decoration: none;
}

.dataTables_paginate a:hover {
    background-color: #3b8bbd; /* Un tono más oscuro de azul */
}



    </style>
</head>

<body>
    @include('menu') 

    <div class="container" style="margin-left: 270px">
        <h1 style="text-align: center; margin-bottom: 30px;">Reporte de Actividades</h1>

        <!-- Contenedor para la tabla con desplazamiento horizontal -->
        <div class="table-container">
            <table id="miTabla">
                <thead>
                    <tr>
                        <th>Actividad</th>
                        <th>Cliente</th>
                        <th>Usuario Asignado</th>
                        <th>Descripción</th>
                        <th>Prioridad</th>
                        <th>Fecha Creación</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($actividades as $actividad)
                    <tr>
                        <td>{{ $actividad->actividad }}</td>
                        <td>{{ $actividad->cliente->empresa }}</td>
                        <td>{{ $actividad->usuario->name }}</td>
                        <td>{{ $actividad->descripcion }}</td>
                        <td>{{ $actividad->prioridad }}</td>
                        <td>{{ $actividad->fecha }}</td>
                        <td class="py-2 px-4">
                            <!-- Contenedor de botones con espaciado -->
                            <div class="options-btns">
                                <a href="{{ route('actividades.show', $actividad) }}" class="view">Ver</a>
                                <a href="{{ route('actividades.edit', $actividad) }}" class="edit">Editar</a>
                                <form action="{{ route('actividades.destroy', $actividad) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="delete">Eliminar</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>


    <script>
    $(document).ready(function () {
        $('#miTabla').DataTable({
            "language": {
                "url": "https://cdn.datatables.net/plug-ins/1.13.4/i18n/es_es.json"
            }
        });
    });
</script>



</body>
</html>
