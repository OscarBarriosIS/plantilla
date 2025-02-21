<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Asistencia</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

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

        .semaforo {
            display: flex;
            justify-content: space-between;
            align-items: center;
            /* Centrar verticalmente */
        }

        .estatus-label {
            margin-left: 10px;
            /* Espaciado entre el círculo y la etiqueta */
        }

        .circulo {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background-color: lightgrey;
            /* Color por defecto */
            position: relative;
        }

        .circulo.activo {
            background-color: green;
        }

        .circulo.pasado {
            background-color: red;
        }

        .circulo.futuro {
            background-color: gray;
        }

        .grid-container {
            margin-right: 10%;
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 10px;
            align-self: flex-end;
        }

        select {
            width: 180px;
            padding: 5px;
            font-size: 16px;
            border: 1px solid gray;
            border-radius: 3px;
            text-overflow: ellipsis;
            margin-top: 4px
        }

    </style>
</head>

<body>
    @include('menu')
    <div class="container" style="margin-left: 270px">

        <div class="table-container mb-4">
            <h1>Línea del tiempo de Ticket</h1>

        <div class="mb-4">
            <strong>Folio: T-0{{ $ticket->id }}</strong>
        </div>
        <form action="{{ route('asignarUser') }}" method="POST" style="list-style-type: none; padding: 25px;">
            @csrf
            <div class="mb-4">
                <strong>Asignar a una dependencia</strong>
            </div>
            <div class="grid-container">
                <div>
                    <label for="id_dependencia" class="form_label">Dependencia:</label>
                    <select name="id_dependencia" id="id_dependencia">
                        <option>Seleccionar Dependencia</option>
                        @foreach ($dependencias as $dependencia)
                            <option value="{{ $dependencia->id }}">{{ $dependencia->nombre }}</option>
                        @endforeach
                    </select>
                    <input type="hidden" value="{{ $ticket->id }}" id="id_ticket" name="id_ticket">
                </div>

                <div>
                    <label for="id_user" class="block text-gray-700">Usuario:</label>
                    <select name="id_user" id="id_user">
                        <option>Seleccionar Usuario</option>
                        @foreach ($usuarios as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                <label for="estatus" class="block text-gray-700">Estatus:</label>
                <select name="estatus" id="estatus">
                    <option>Seleccionar Estatus</option>
                    @foreach ($statuses as $key => $label)
                        <option value="{{ $key }}" {{ $key == $estadoActual ? 'selected' : '' }}>
                            {{ $label }}</option>
                    @endforeach
                </select>
                </div>

                <div class="form-group flex-1 mb-4">
                    <label for="descripcion" class="block text-gray-700">Descripcion del ticket:</label>
                    <input type="text" id="descripcion" name="descripcion"
                        value="{{ old('descripcion', $ticket->descripcion) }}" class="form-input mt-1 block w-full"
                        required>
                    @error('descripcion')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group flex-1 mb-4">
                    <label for="comentarios" class="block text-gray-700">Comentarios sobre el ticket:</label>
                    <input type="text" id="comentarios" name="comentarios"
                        value="{{ old('comentarios', $ticket->comentarios) }}" class="form-input mt-1 block w-full"
                        required>
                    @error('comentarios')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="mt-2">
                <button type="submit" class="btn btn-primary">Guardar</button>
            </form>
        </div>

        <br>
        <div class="semaforo">
            @foreach ($statuses as $key => $label)
                @php
                    $class = '';
                    if ($key < $estadoActual) {
                        $class = 'pasado'; // Estado completado
                    } elseif ($key == $estadoActual) {
                        $class = 'activo'; // Estado actual
                    } else {
                        $class = 'futuro'; // Estado futuro
                    }
                @endphp
                <div class="circulo {{ $class }}" title="{{ $label }}"></div>
                <span class="estatus-label">{{ $label }}</span> <!-- Etiqueta del estatus -->
            @endforeach
        </div>
        <br>
        <body>
            <div class="mb-4">
                <strong>Cambios Realizados</strong>
            </div>
            <ul style="list-style-type: none; padding: 0;">
                @foreach ($lineaTiempo as $index => $tick)
                    <li style="margin-bottom: 10px; padding-bottom: 10px; display: flex; align-items: center;">
                        <div style="width: 10px; height: 40px; background-color: rgb(0, 79, 249); margin-right: 10px;">
                        </div>
                        <div>
                            <strong>{{ $tick->created_at->format('d/m/Y H:i') }} - {{ $tick->descripcion }}</strong>
                        </div>
                    </li>
                    <li style="margin-bottom: 10px;">
                        Usuario: {{ $tick->usuario->name }}
                    </li>
                    <li style="margin-bottom: 10px;">
                        Dependencia responsable: {{ $tick->dependencia->nombre }}
                    </li>
                    <li style="margin-bottom: 60px;">
                        Comentarios: {{ $tick->comentarios }}
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</body>

</html>