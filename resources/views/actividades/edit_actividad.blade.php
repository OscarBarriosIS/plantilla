<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Asistencia</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f6f9;
        }

        .container {
            padding: 30px;
            margin-left: 270px;
        }

        h1 {
            text-align: center;
            color: #2575fc;
            font-size: 28px;
            margin-bottom: 30px;
        }

        /* Estilos para el formulario */
        .form-container {
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            max-width: 900px;
            margin: 0 auto;
        }

        .form-container label {
            font-weight: bold;
            color: #333;
            margin-bottom: 8px;
            display: block;
        }

        .form-container input,
        .form-container select,
        .form-container textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 14px;
            margin-bottom: 20px;
            transition: border-color 0.3s;
        }

        .form-container input:focus,
        .form-container select:focus,
        .form-container textarea:focus {
            border-color: #2575fc;
            outline: none;
        }

        .form-container textarea {
            resize: vertical;
            min-height: 100px;
        }

        .form-container input[type="submit"] {
            background-color: #2575fc;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .form-container input[type="submit"]:hover {
            background-color: #1e64d4;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-group-horizontal {
            display: flex;
            justify-content: space-between;
            gap: 20px;
        }

        .form-group-horizontal .half-width {
            flex: 1;
        }

        @media (max-width: 768px) {
            .form-group-horizontal {
                flex-direction: column;
            }

            .form-group-horizontal .half-width {
                flex: none;
                width: 100%;
            }
        }

        /* Estilos para el menú */
        nav {
            background-color: #2575fc;
            padding: 10px;
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
    </style>
</head>

<body>
    @include('menu')

    <div class="container">
        <h1>Editar Actividad</h1>

        <div class="form-container">
            <form id="form_contra" action="{{ route('actividades.update',$actividad) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Datos de dirección -->
                <div class="form-group-horizontal">

                    <!-- Selección de Cliente -->
                    <div class="form-group half-width">
                        <label for="id_AsiganarCliente">Selecciona un Cliente</label>
                        <select id="id_AsiganarCliente" name="id_AsiganarCliente" required>
                            <option value="{{ ($actividad->empresa) }}">{{ ($actividad->empresa) }}</option>
                            <option value="">Selecciona un cliente</option>
                            @foreach ($clientes as $cliente)
                                <option value="{{ $cliente->id }}">{{ $cliente->empresa }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Actividad -->
                    <div class="form-group half-width">
                        <label for="actividad">Nombre de Actividad</label>
                        <input type="text" id="actividad" name="actividad" value="{{ ($actividad->actividad) }}" required>
                    </div>
                </div>

                <!-- Fecha -->
                <div class="form-group">
                    <label for="fecha">Fecha</label>
                    <input type="date" id="fecha" name="fecha" value="{{ ($actividad->fecha) }}" required>
                </div>

                <!-- Descripción -->
                <div class="form-group">
                    <label for="descripcion">Descripción</label>
                    <textarea id="descripcion" name="descripcion" required>{{ ($actividad->descripcion) }}</textarea>
                </div>

                <!-- Asignar Actividad -->
                <div class="form-group">
                    <label for="id_AsiganarUsuario">Asignar Actividad</label>
                    <select id="id_AsiganarUsuario" name="id_AsiganarUsuario" required>
                        <option value="{{ ($actividad->actividad) }}">Selecciona una persona</option>
                        <option value="">Selecciona una persona</option>
                        @foreach ($usuarios as $usuario)
                            <option value="{{ $usuario->id }}">{{ $usuario->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Prioridad -->
                <div class="form-group">
                    <label for="prioridad">Prioridad</label>
                    <select id="prioridad" name="prioridad" required>
                        <option value="{{ ($actividad->prioridad) }}">{{ ($actividad->prioridad) }}</option>
                        <option value="">Selecciona la prioridad</option>
                        <option value="alta">Alta</option>
                        <option value="media">Media</option>
                        <option value="baja">Baja</option>
                    </select>
                </div>

                <div class="form-group" style="text-align: center;">
                    <input type="submit" value="Actualizar Actividad">
                </div>

            </form>
        </div>

    </div>

</body>

</html>
