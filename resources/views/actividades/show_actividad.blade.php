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
            background-color: #f0f2f5;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 30px;
        }

        h1 {
            text-align: center;
            font-size: 32px;
            color: #2c3e50;
            margin-bottom: 40px;
        }

        .form-container {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 10px;
            font-size: 16px;
            font-weight: 600;
            color: #2c3e50;
        }

        input[type="text"],
        input[type="email"],
        input[type="tel"],
        input[type="number"],
        select {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 16px;
            background-color: #f9f9f9;
            color: #333;
            transition: border-color 0.3s ease;
        }

        input[type="text"]:focus,
        input[type="email"]:focus,
        input[type="tel"]:focus,
        input[type="number"]:focus {
            border-color: #3498db;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group-horizontal {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
        }

        .half-width {
            flex: 1;
            min-width: 250px;
        }

        .full-width {
            flex: 3;
        }

        .form-group-horizontal .half-width input {
            width: 100%;
        }

        .back-link {
            display: inline-block;
            text-align: center;
            margin-top: 20px;
            font-size: 16px;
            color: #fff;
            text-decoration: none;
            padding: 10px 20px;
            background-color: #3498db;
            border-radius: 5px;
            transition: background-color 0.3s, color 0.3s;
        }

        .back-link:hover {
            background-color: #2980b9;
        }

        .form-container h2 {
            text-align: center;
            font-size: 24px;
            margin-bottom: 30px;
            color: #2c3e50;
        }

        .form-container .form-group-horizontal input {
            padding: 12px;
            font-size: 16px;
            color: #333;
        }

        .form-group-horizontal input:disabled {
            background-color: #eee;
            color: #888;
        }

        .sidebar {
            width: 250px;
            background-color: #2c3e50;
            color: white;
            height: 100vh;
            padding-top: 30px;
            position: fixed;
            top: 0;
            left: 0;
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
            background-color: #3498db;
        }
    </style>
</head>

<body>
    @include('menu')
    <div class="container">
        <h1>Ver Actividad</h1>

        <div class="form-container">
            <form id="form_contra" action="{{ route('actividades.update',$actividad) }}" method="POST">
                @csrf
                @method('PUT')

                
                    <div class="half-width">
                        <label for="actividad">Actividad</label>
                        <input type="text" id="actividad" name="actividad" value="{{ ($actividad->actividad) }}" required readonly>
                    </div>

                    <div class="half-width">
                        <label for="cliente">Cliente</label>
                        <input type="text" id="cliente" name="cliente" value="{{ ($actividad->cliente->empresa) }}" required readonly>
                    </div>

                    <div class="half-width">
                        <label for="usuario">Usuario Asignado</label>
                        <input type="text" id="usuario" name="usuario" value="{{ ($actividad->usuario->name) }}" required readonly>
                    </div>

                    <div class="half-width">
                        <label for="descripcion">Descripción</label>
                        <input type="text" id="descripcion" name="descripcion" value="{{ ($actividad->descripcion) }}" required readonly>
                    </div>

                    <div class="half-width">
                        <label for="prioridad">Prioridad</label>
                        <input type="text" id="prioridad" name="prioridad" value="{{ ($actividad->prioridad) }}" required readonly>
                    </div>
            

                <div class="form-group" style="text-align: center;">
                    <a href="{{ route('actividades.index') }}" class="back-link">Regresar</a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
