<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cambiar Correo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" 
          integrity="sha384-KyZXEJ6v2xFu1tT6oPtW2gbw9W1E/JQ1Vr6vxgU0LrRrmxB2Qd/ZwKQR9/m1jX0F" crossorigin="anonymous">
          <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f7fc;
            margin: 0;
            padding: 0;
        }

        .text-danger{
            color: red;
        }

        .container-fluid {
            display: flex;
            justify-content: flex-start;
            min-height: 100vh;
        }

        .content {
            margin-left: 250px;
            padding: 20px;
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
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
            margin-right: 25px;
        }

        .form-control {
            border-radius: 8px;
            padding: 15px;
            margin-top: 5px;
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

    </style>
</head>

<body>

    <div class="container-fluid">
        @include('menu')

        <div class="content">
            <div class="form-container">
                <h2>Cambiar Datos de Usuario</h2>

                @if(session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif

                <form action="{{ route('update-profile-data', $user->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
        
                    <div class="form-group">
                        <label for="name">Nombre</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ $user->name }}" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="apellido_paterno">Apellido Paterno</label>
                        <input type="text" name="apellido_paterno" id="apellido_paterno" class="form-control" value="{{ $user->apellido_paterno }}">
                    </div>

                    <div class="form-group">
                        <label for="apellido_materno">Apellido Materno</label>
                        <input type="text" name="apellido_materno" id="apellido_materno" class="form-control" value="{{ $user->apellido_materno }}">
                    </div>
        
                    <div class="form-group">
                        <label for="email">Correo Electrónico</label>
                        <input type="email" name="email" id="email" class="form-control" value="{{ $user->email }}" required>
                    </div>

                    <div class="form-group">
                        <label for="current_password">Contraseña actual  (dejar vacío si no desea cambiarla)</label>
                        <input type="password" name="current_password" id="current_password" class="form-control">
                        @if ($errors->has('current_password'))
                            <p class="text-danger">{{ $errors->first('current_password') }}</p>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="new_password">Nueva contraseña</label>
                        <input type="password" name="new_password" id="new_password" class="form-control">
                        @if ($errors->has('new_password'))
                            <p class="text-danger">{{ $errors->first('new_password') }}</p>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="new_password_confirmation">Confirmar nueva contraseña</label>
                        <input type="password" name="new_password_confirmation" id="new_password_confirmation" class="form-control">
                        @if ($errors->has('new_password_confirmation'))
                            <p class="text-danger">{{ $errors->first('new_password_confirmation') }}</p>
                        @endif
                    </div>
        
                    <button type="submit" class="btn btn-primary">Actualizar Usuario</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka9z21Jwv5VyrdMQ/9jU6+gF4Z9K0B+FJwy+ns3khqF0K1XeIsA7XY1b2rYwv6V1" crossorigin="anonymous"></script>

</body>

</html>
