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
        }

        .container {
            padding: 20px;
        }

       
        .header {
            text-align: center;
            margin-bottom: 30px;
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
        
        .form-container {
    background-color: white;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    max-width: 800px;
    margin: auto;
}

h1 {
    text-align: center;
    margin-bottom: 20px;
    color: #2575fc;
}

label {
    display: block;
    margin-bottom: 8px;
    font-size: 14px;
    font-weight: bold;
}

input[type="text"],
input[type="email"],
input[type="tel"],
input[type="number"],
select {
    width: 100%;
    padding: 10px;
    margin-bottom: 20px; /* Aumenté el margen inferior para más espacio entre los campos */
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 14px;
}

input[type="submit"] {
    background-color: #2575fc;
    color: white;
    padding: 12px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
}

input[type="submit"]:hover {
    background-color: #1e64d4;
}

.form-group {
    margin-bottom: 20px;
}

.form-group-horizontal {
    display: flex;
    justify-content: space-between;
    gap: 15px;
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

     /* Estilo para los campos con clase 'input-gris' */
     /* Estilo para los campos con clase 'input-gris' */
    .input-gris {
        background-color: #f0f0f0; /* Gris tenue */
        border: 1px solid #ccc; /* Borde gris claro */
        padding: 8px; /* Espaciado interno */
        border-radius: 4px; /* Bordes redondeados */
        width: 100%; /* O puedes ajustarlo a un tamaño específico */
        box-sizing: border-box; /* Para que el padding no afecte el tamaño total */
    }


       
                    
                    
</style>
</head>

<body>
    @include('menu') 
    <div class="container" style="margin-left: 270px">
    <h1 style="text-align: center; margin-bottom: 30px;">Editar Cliente</h1>


    

    <div class="form-container">
    <form id="form_contra" action="{{ route('clientes.update',$cliente) }}" method="POST">
            @csrf
            @method('PUT')
        
        <!-- Información de la empresa -->
        <div class="form-group">
            <label for="empresa">Empresa</label>
            <input type="text" id="empresa" name="empresa" value="{{ ($cliente->empresa) }}" required>
        </div>

        <!-- Datos de dirección -->
        <div class="form-group-horizontal">

            <div class="half-width">
                <label for="cp">Código Postal</label>
                <input type="number" id="cp" name="cp" value="{{ ($cliente->cp) }}" class="input-gris" readonly>
            </div>

            <div class="half-width">
                <label for="cp">Estado</label>
                <input type="text" id="estado" name="estado" value="{{ ($cliente->cp) }}" class="input-gris" readonly>
            </div>

            <div class="half-width">
                <label for="cp">Municipio</label>
                <input type="text" id="municipio" name="municipio" value="{{ ($cliente->municipio) }}" class="input-gris" readonly>
            </div>

            <div class="half-width">
                <label for="colonia">Colonia</label>
                <input type="text" id="colonia" name="colonia" value="{{ ($cliente->colonia) }}"  class="input-gris" readonly>
            </div>
        </div>

        <div class="form-group-horizontal">
            <div class="half-width">
                <label for="calle">Calle</label>
                <input type="text" id="calle" name="calle"  value="{{ ($cliente->calle) }}" required>
            </div>

            <div class="half-width">
                <label for="externo">Número Externo</label>
                <input type="text" id="externo" name="externo" value="{{ ($cliente->externo) }}" required>
            </div>
        </div>

        <div class="form-group">
            <label for="interno">Número Interno</label>
            <input type="text" id="interno" name="interno" value="{{ ($cliente->interno) }}">
        </div>

        <!-- Datos personales -->
        <div class="form-group-horizontal">
            <div class="half-width">
                <label for="nombre">Nombre</label>
                <input type="text" id="nombre" name="nombre" required value="{{ ($cliente->nombre) }}">
            </div>

            <div class="half-width">
                <label for="paterno">Apellido Paterno</label>
                <input type="text" id="paterno" name="paterno" required value="{{ ($cliente->paterno) }}">
            </div>
        </div>

        <div class="form-group-horizontal">
            <div class="half-width">
                <label for="materno">Apellido Materno</label>
                <input type="text" id="materno" name="materno" required value="{{ ($cliente->materno) }}">
            </div>

            <div class="half-width">
                <label for="telefono">Teléfono</label>
                <input type="tel" id="telefono" name="telefono" required value="{{ ($cliente->telefono) }}">
            </div>
        </div>

        <div class="form-group">
            <label for="correo">Correo Electrónico</label>
            <input type="email" id="correo" name="correo" required value="{{ ($cliente->correo) }}">
        </div>

        <div class="form-group" style="text-align: center;">
            <input type="submit" value="Enviar">
        </div>
    </form>
</div>

</div>



</body>
</html>
