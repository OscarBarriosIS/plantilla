<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registrar Usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f7fc;
            margin: 0;
            padding: 0;
        }

        .container-fluid {
            display: flex;
            justify-content: flex-start;
            min-height: 100vh;
        }

        .sidebar {
            width: 250px;
            background-color: #2575fc;
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
            background-color: #6a11cb;
        }

        .content {
            margin-left: 250px;
            padding: 20px;
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            height: 100vh;
            overflow-y: auto;
            padding-top: 30px; /* Añadido para que no se superponga con el menú */
        }

        .form-container {
            background-color: #fff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 550px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .form-container:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
        }

        .form-container h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #333;
            font-size: 28px;
            font-weight: 600;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-control {
            border-radius: 8px;
            padding: 15px;
            font-size: 16px;
            width: 100%;
            border: 1px solid #ddd;
            background-color: #f9f9f9;
            transition: border 0.3s;
        }

        .form-control:focus {
            border-color: #2575fc;
            box-shadow: 0 0 5px rgba(37, 117, 252, 0.4);
            outline: none;
        }

        .btn-primary {
            background-color: #2575fc;
            border: none;
            padding: 12px 20px;
            font-size: 18px;
            color: white;
            width: 100%;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #4e84f7;
        }

        .alert {
            margin-top: 20px;
            text-align: center;
            padding: 15px;
            background-color: #28a745;
            color: white;
            border-radius: 5px;
            font-size: 16px;
        }

        @keyframes slide-up {
            0% {
                transform: translateY(20px);
                opacity: 0;
            }

            100% {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .form-container {
            animation: slide-up 0.5s ease-out;
        }
    </style>
</head>

<body>

    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <div class="container-fluid">
        @include('menu')

        <div class="content">
            <div class="form-container">
                <h2>Registrar Usuario</h2>

                <form action="{{ route('registro_usuarios') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name">Nombre</label>
                        <input type="text" name="name" id="name" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="apellido_paterno">Apellido Paterno</label>
                        <input type="text" name="apellido_paterno" id="apellido_paterno" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="apellido_materno">Apellido Materno</label>
                        <input type="text" name="apellido_materno" id="apellido_materno" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="sexo">Sexo</label>
                        <select name="sexo" id="sexo" class="form-control" required>
                            <option value="" disabled selected>Selecciona un sexo</option>
                            <option value="M">Masculino</option>
                            <option value="F">Femenino</option>
                            <option value="O">Otro</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="estado_civil">Estado Civil</label>
                        <select name="estado_civil" id="estado_civil" class="form-control" required>
                            <option value="" disabled selected>Selecciona un estado civil</option>
                            <option value="Soltero">Soltero</option>
                            <option value="Casado">Casado</option>
                            <option value="Divorciado">Divorciado</option>
                            <option value="Viudo">Viudo</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="nacionalidad">Nacionalidad</label>
                        <select name="nacionalidad" id="nacionalidad" class="form-control" required>
                            <option value="" disabled selected>Selecciona una nacionalidad</option>
                            <option value="Mexicana">Mexicana</option>
                            <option value="Extranjera">Extranjera</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="rfc">RFC</label>
                        <input type="text" name="rfc" id="rfc" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="curp">CURP</label>
                        <input type="text" name="curp" id="curp" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="telefono">Telefono</label>
                        <input type="number" name="telefono" id="telefono" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="password">Contraseña</label>
                        <input type="password" name="password" id="password" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="fecha_nacimiento">Fecha de Nacimiento</label>
                        <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="role">Rol</label>
                        <select name="role_id" id="role" class="form-control" required>
                            <option value="" disabled selected>Selecciona un rol</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Registrar Usuario</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
