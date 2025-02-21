<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Editar Usuario</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f7fc;
            margin: 0;
        }

        .container {
            margin-top: 30px;
        }

        /* Estilos para el menú lateral */
        .sidebar {
            position: fixed;
            width: 250px;
            top: 0;
            left: 0;
            background-color: #2575fc;
            padding: 20px;
            color: white;
            height: 100vh;
            z-index: 1000;
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
        
            background-color: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
            max-width: 70%;
            margin: auto;
            margin-top: 50px;
            z-index: 999; 
            position: relative;
        }

        .form-container h2 {
            margin-bottom: 20px;
            font-weight: bold;
            color: #333;
        }

        .form-container .tab-content {
            margin-top: 20px;
        }

        .tabs {
            display: flex;
            justify-content: left;
            margin: 0;
            padding: 10px 0;
        }

        .tabs a {
            color: #333;
            padding: 12px 25px;
            text-decoration: none;
            text-align: center;
            font-size: 16px;
            margin-right: 15px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .tabs a:hover, .tabs a.active {
            background-color: #3498db;
            color: white;
        }

        .tab-content {
            display: none;
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .tab-content.active {
            display: block;
        }

        .profile-image {
            width: 160px;
            height: 160px;
            object-fit: cover;
            border-radius: 50%;
            border: 4px solid #ff0707;
            display: block;
            margin: 0 auto; 
            margin-bottom: 40px; /
        }

        .grid-container {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 30px;
            margin-top: 20px;
        }

        .column {
            background-color: #f4f4f4;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .mb-3 label {
            font-weight: bold;
            color: #555;
        }

        .form-control {
            border-radius: 8px;
            box-shadow: none;
            font-size: 15px;
            padding: 12px;
        }

        .form-control:focus {
            border-color: #3498db;
            box-shadow: 0 0 5px rgba(52, 152, 219, 0.5);
        }

        .btn-primary {
            background-color: #3498db;
            border: none;
            font-size: 16px;
            padding: 10px 20px;
            border-radius: 8px;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #2980b9;
        }

        .right-position {
            float: right;
        }

    </style>
</head>

<body>

    @include('menu') <!-- Incluir el menú aquí -->

    <div class="form-container">
        <h2>Editar Usuario</h2>

        <!-- Mensaje de éxito -->
        @if(session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        <div class="tabs">
            <a href="#" class="tab-link active" data-tab="pestañaDatosUsuario">Datos de Usuario</a>
            <a href="#" class="tab-link" data-tab="pestañaDatosEmpleo">Datos de Empleo</a>
            <a href="#" class="tab-link" data-tab="pestañaSalario">Salario</a>
        </div>

        <form action="{{ route('update_user', $user->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div id="pestañaDatosUsuario" class="tab-content active">
                <div class="grid-container">
                    <div class="column">
                        <!-- Mostrar la imagen de perfil actual -->
                        <div class="mb-3">
                            <label for="imagen" class="form-label" style="text-align: center">Imagen de Perfil</label>
                            <div class="mb-2">
                                <!-- Mostrar la imagen actual si existe -->
                                @if($user->imagen)
                                <img src="{{ asset('storage/' . $user->imagen) }}" alt="Imagen de perfil" class="profile-image">
                                @else
                                    <img src="{{ asset('storage/app/images/default-avatar.png') }}" alt="Imagen de perfil" class="profile-image">
                                @endif
                            </div>
                            <input type="file" name="imagen" id="imagen" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label for="name" class="form-label">Nombre</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ $user->name }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="apellido_paterno" class="form-label">Apellido Paterno</label>
                            <input type="text" name="apellido_paterno" id="apellido_paterno" class="form-control" value="{{ $user->apellido_paterno }}">
                        </div>

                        <div class="mb-3">
                            <label for="apellido_materno" class="form-label">Apellido Materno</label>
                            <input type="text" name="apellido_materno" id="apellido_materno" class="form-control" value="{{ $user->apellido_materno }}">
                        </div>

                        <div class="mb-3">
                            <label for="fecha_nacimiento" class="form-label">Fecha Nacimiento</label>
                            <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" class="form-control" value="{{ $user->fecha_nacimiento }}">
                        </div>
                    </div>

                    <div class="column">
                        <div class="mb-3">
                            <label for="sexo">Sexo</label>
                            <select name="sexo" id="sexo" class="form-control mt-2" required>
                                @foreach($sexos as $sexo)
                                    <option value="{{ $sexo }}" {{ $user->sexo == $sexo ? 'selected' : '' }}>{{ $sexo }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="estado_civil">Estado Civil</label>
                            <select name="estado_civil" id="estado_civil" class="form-control mt-2" required>
                                @foreach($estadosCiviles as $key => $estadoCivil)
                                    <option value="{{ $key }}" {{ $user->estado_civil == $key ? 'selected' : '' }}>{{ $estadoCivil }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="nacionalidad" class="form-label">Nacionalidad</label>
                            <input type="text" name="nacionalidad" id="nacionalidad" class="form-control" value="{{ $user->nacionalidad }}">
                        </div>

                        <div class="mb-3">
                            <label for="curp" class="form-label">CURP</label>
                            <input type="text" name="curp" id="curp" class="form-control" value="{{ old('curp', $user->curp)}}">
                            @if ($errors->has('curp'))
                                <p class="text-danger">{{ $errors->first('curp') }}</p>
                            @endif
                        </div>

                        <div class="mb-3">
                            <label for="rfc" class="form-label">RFC</label>
                            <input type="text" name="rfc" id="rfc" class="form-control" value="{{ old('rfc', $user->rfc) }}">
                            @if ($errors->has('rfc'))
                                <p class="text-danger">{{ $errors->first('rfc') }}</p>
                            @endif
                        </div>

                        <button type="submit" class="btn btn-primary right-position">Actualizar Usuario</button>
                    </div>
                </div>
            </div>

            
        </form>

    </div>

    <script>
        const links = document.querySelectorAll('.tab-link');
        const contents = document.querySelectorAll('.tab-content');

        links.forEach(link => {
            link.addEventListener('click', function(event) {
                event.preventDefault();

                links.forEach(link => link.classList.remove('active'));
                contents.forEach(content => content.classList.remove('active'));

                const tabId = this.getAttribute('data-tab');
                document.getElementById(tabId).classList.add('active');
                this.classList.add('active');
            });
        });
    </script>

</body>

</html>
