<!-- resources/views/festividades/create.blade.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Festividad</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <style>
        /* Menú lateral (Sidebar) */
        /* Sidebar - Menú lateral */
        .sidebar {
            width: 250px;
            background-color: #2c3e50;
            color: white;
            height: 100vh;
            padding-top: 30px;
            position: fixed;
            transition: width 0.3s ease;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .sidebar h3 {
            text-align: center;
            font-size: 26px;
            font-weight: 500;
            margin-bottom: 40px;
            color: #ecf0f1;
        }

        .sidebar a {
            color: white;
            padding: 15px;
            display: block;
            text-decoration: none;
            font-size: 18px;
            border-bottom: 1px solid #34495e;
            transition: background-color 0.3s ease, padding-left 0.3s;
        }

        .sidebar a:hover {
            background-color: #3498db;
            padding-left: 25px;
        }

        /* Contenedor principal */
        .container-main {
            margin-left: 260px; /* Espacio para el menú lateral */
            padding: 20px;
        }

        .form-container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border-radius: 8px;
            background-color: #f9f9f9;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .form-container h2 {
            margin-bottom: 30px;
            text-align: center;
        }

        .btn-submit {
            width: 100%;
            padding: 10px;
        }
    </style>
</head>
<body>
   
    @include('menu')
    
    <div class="container-main">
        <div class="form-container">
            <h2>Registrar Festividad</h2>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <form action="{{ route('festividades.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="fecha" class="form-label">Fecha:</label>
                    <input type="date" name="fecha" id="fecha" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="descripcion" class="form-label">Descripción:</label>
                    <input type="text" name="descripcion" id="descripcion" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="tipo_evento" class="form-label">Tipo de Evento:</label>
                    <input type="text" name="tipo_evento" id="tipo_evento" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="empresa" class="form-label">Empresa:</label>
                    <input type="text" name="empresa" id="empresa" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-primary btn-submit">Registrar Festividad</button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
