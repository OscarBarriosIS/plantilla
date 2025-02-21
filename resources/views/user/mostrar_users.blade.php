<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Detalles del Usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        .sidebar {
            width: 250px;
            background-color: #2575fc;
            padding: 20px;
            color: white;
            height: 100vh;
            position: fixed;
            top: 0;
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

        .content-container {
            margin-left: 250px; 
            padding-top: 30px;
        }

        .card {
            width: 100%;
            max-width: 600px; 
            margin: 0 auto;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            padding: 20px;
            background-color: #fff;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px); 
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1); 
        }

        .card-title {
            font-size: 24px;
            font-weight: 600;
            color: #333;
            text-align: center;
            margin-top: 15px;
        }

        .card-text {
            font-size: 16px;
            margin-bottom: 15px;
            color: #555;
        }

        .btn-primary {
            background-color: #2575fc;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            text-align: center;
            font-size: 16px;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #6a11cb;
        }

        .profile-img {
            width: 250px;
            height: 220px;
            object-fit: cover;
            border-radius: 50%; 
            margin-left: auto;
            margin-right: auto;
            display: block;
            margin-bottom: 20px;
        }

        .content-container h2 {
            text-align: center;
            margin-bottom: 30px;
        }

        .btn-container {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .default-img {
            background-image: url('https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_640.png'); /* Imagen estática */
            background-size: cover;
            width: 250px;
            height: 220px;
            border-radius: 50%;
            margin-left: auto;
            margin-right: auto;
            display: block;
            margin-bottom: 40px;
        }
    </style>
</head>

<body>

    @include('menu')  

    <div class="content-container">
        <h2 class="text-center mb-4">Detalles del Usuario</h2>

        <div class="card">
            <div class="card-body">
                <div class="text-center">
                    @if($user->imagen)
                        <img src="{{ asset('storage/' . $user->imagen) }}" alt="Imagen de perfil" class="profile-img">
                    @else
                        <div class="default-img"></div> 
                    @endif
                </div>
                <h5 class="card-title">{{ $user->nombre_completo }}</h5><br>
                <p class="card-text"><strong>Email:</strong> {{ $user->email }}</p>
                <p class="card-text"><strong>Rol:</strong> {{ $user->role->nombre }}</p>
                <p class="card-text"><strong>Sexo:</strong> {{ $user->sexo }}</p>
                <p class="card-text"><strong>Fecha de Cumpleaños:</strong> {{ $user->fecha_nacimiento }}</p>
                <p class="card-text"><strong>Estado Civil:</strong> {{ $user->estado_civil }}</p>
                <p class="card-text"><strong>Nacionalidad:</strong> {{ $user->nacionalidad }}</p>
                <p class="card-text"><strong>CURP:</strong> {{ $user->curp }}</p>
                <p class="card-text"><strong>RFC:</strong> {{ $user->rfc }}</p>
                <p class="card-text"><strong>Telefono:</strong> {{ $user->telefono }}</p>

                <div class="btn-container">
                    <a href="{{ route('ver_users') }}" class="btn btn-primary">Volver a la lista de usuarios</a>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
