<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Asistencia</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <!-- Incluir el archivo CSS de DataTables -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">

    <!-- Incluir el archivo JS de jQuery (necesario para DataTables) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Incluir el archivo JS de DataTables -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            padding: 20px;
        }

        .table-container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            overflow-x: auto;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            margin-top: 30px;
            padding: 15px;
            background-color: #ffffff;
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
            background-color: #4fa3d1; /* Cambié el verde por azul claro */
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

        .dataTables_length select {
            padding: 10px;
            border-radius: 8px;
            border: 1px solid #ddd;
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

        .button-verde {
            background-color: #4fa3d1; /* Azul claro */
            color: white;
            padding: 12px 24px;
            border-radius: 5px;
            font-size: 16px;
            font-weight: bold;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
            text-decoration: none;
        }

        .button-verde:hover {
            background-color: #3b8bbd; /* Un tono más oscuro de azul */
        }

        .sidebar {
            width: 250px;
            background-color: #4fa3d1; /* Azul claro */
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
            background-color: #3b8bbd; /* Un tono más oscuro de azul */
        }

        .sidebar a i {
            margin-right: 8px;
            font-size: 18px;
            color: #333;
        }

    </style>
</head>

<body>
    @include('menu')
    <div class="container" style="margin-left: 270px">
        <h1 style="text-align: center; margin-bottom: 30px;">Información de TICKET</h1>

        <div class="table-container">
            <table id="miTabla">
                <thead>
                    <tr>
                        <th>Curp</th>
                        <th>Nombre</th>
                        <th>Apellido Paterno</th>
                        <th>Apellido Materno</th>
                        <th>Estado Nacimiento</th>
                        <th>Fecha Nacimiento</th>
                        <th>Sexo</th>
                        <th>Email</th>
                        <th>Telefono</th>
                        <th>Celular</th>
                        <th>Grado Estudios</th>
                        <th>Ocupacion</th>
                        <th>cp</th>
                        <th>estado</th>
                        <th>municipio</th>
                        <th>colonia</th>
                        <th>calle</th>
                        <th>Numero Exterior</th>
                        <th>Numero Interior</th>
                        <th>Entre Calles</th>
                        <th>Tipo Carretera</th>
                        <th>Tipo Camino</th>
                        <th>Tipo Asentamiento</th>
                        <th>Ticket</th>
                        <th>Eje</th>
                        <th>Dependencia</th>
                        <th>Nombre Tramite</th>
                        <th>Motivo Ticket</th>
                        <th>Información Ticket</th>
                        <th>Area</th>
                        <th>Usuario Asignado</th>
                        <th>Prioridad</th>
                        <th>Observaciones</th>
                        <th>Linea de Tiempo</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tickets as $ticket)
                    <tr>
                        <td>{{ $ticket->curp }}</td>
                        <td>{{ $ticket->nombre }}</td>
                        <td>{{ $ticket->paterno }}</td>
                        <td>{{ $ticket->materno }}</td>
                        <td>{{ $ticket->estadoNacimiento }}</td>
                        <td>{{ $ticket->fechaNacimiento }}</td>
                        <td>{{ $ticket->sexo }}</td>
                        <td>{{ $ticket->email }}</td>
                        <td>{{ $ticket->telefono }}</td>
                        <td>{{ $ticket->celular }}</td>
                        <td>{{ $ticket->gradoEstudios }}</td>
                        <td>{{ $ticket->ocupacion }}</td>
                        <td>{{ $ticket->cp}}</td>
                        <td>{{ $ticket->estado}}</td>
                        <td>{{ $ticket->municipio}}</td>
                        <td>{{ $ticket->colonia}}</td>
                        <td>{{ $ticket->calle}}</td>
                        <td>{{ $ticket->exterior}}</td>
                        <td>{{ $ticket->interior}}</td>
                        <td>{{ $ticket->entrecalles}}</td>
                        <td>{{ $ticket->tipoCarretera}}</td>
                        <td>{{ $ticket->tipoCamino}}</td>
                        <td>{{ $ticket->tipoAsentamientos}}</td>
                        <td>{{ $ticket->ticket }}</td>
                        <td>{{ $ticket->eje}}</td>
                        <td>{{ $ticket->dependencia}}</td>
                        <td>{{ $ticket->nombreTramite}}</td>                            
                        <td>{{ $ticket->motivoTiket }}</td>
                        <td>{{ $ticket->InformacionTicket }}</td>
                        <td>{{ $ticket->area }}</td>
                        <td>{{ $ticket->usuario?->name }}</td>
                        <td>{{ $ticket->prioridad }}</td>
                        <td>{{ $ticket->observaciones }}</td>

                        <td class="py-2 px-4">
                            <div style="display: flex; justify-content: center; gap: 10px;">
                                <a href="{{ route('tickets/linea_tiempo', $ticket->id) }}" 
                                   style="background-color: #4fa3d1; color: #ffffff; padding: 0.25rem 0.75rem; border-radius: 0.375rem; text-decoration: none;" 
                                   class="hover:bg-blue-600">
                                   Visualizar
                                </a>
                            </div>
                        </td>
                        <td class="py-2 px-4">
                            <div style="display: flex; justify-content: center; gap: 10px;">
                                <a href="{{ route('tickets.show', $ticket) }}" 
                                   style="background-color: #4fa3d1; color: #ffffff; padding: 0.25rem 0.75rem; border-radius: 0.375rem; text-decoration: none;" 
                                   class="hover:bg-blue-600">
                                   Ver
                                </a>
                                <a href="{{ route('tickets.edit', $ticket) }}" 
                                   style="background-color: #60a5fa; color: #ffffff; padding: 0.25rem 0.75rem; border-radius: 0.375rem; text-decoration: none;" 
                                   class="hover:bg-blue-600">
                                   Editar
                                </a>
                                <form action="{{ route('tickets.destroy', $ticket) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            style="background-color: #ef4444; color: #ffffff; padding: 0.25rem 0.75rem; border-radius: 0.375rem; text-decoration: none;" 
                                            class="hover:bg-red-600">
                                        Eliminar
                                    </button>
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
