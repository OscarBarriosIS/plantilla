<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Asistencia</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
   {{--  <link rel="stylesheet" href="{{ asset('css/app.css') }}"> --}}
   <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

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
            margin-bottom: 20px;
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

            .form-section {
                margin-bottom: 30px;
                border-bottom: 2px solid #2575fc;
                padding-bottom: 10px;
            }

            .section-title {
                font-size: 20px;
                font-weight: bold;
                color: #2575fc;
                margin-bottom: 10px;
}
        }
    </style>
</head>

<body>
    @include('menu') 

    <div class="container" style="margin-left: 270px">
        <h1 style="text-align: center; margin-bottom: 30px;">Crear Cliente</h1>

        <div class="form-container">
            <form id="form_contra" action="{{ route('clientes.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-section">
                    <h2 class="section-title">Datos Generales</h2>
                </div>



                <!-- Información de la empresa -->
                <div class="form-group">
                    <label for="empresa">Empresa</label>
                    <input type="text" id="empresa" name="empresa" required>
                </div>

                <!-- Datos de dirección -->
                <div class="form-group-horizontal">
                    <div class="flex flex-wrap gap-4">
    <!-- Campo Código Postal -->
    <div class="form-group flex-1 mb-4">
        <label for="cp" class="block text-gray-700">Código Postal:</label>
        <input type="text" id="codigo_postal" name="cp" value="{{ old('cp') }}" class="form-input mt-1 block w-full" maxlength="5">
        <!-- <p id="cp-error" class="text-red-500 text-sm hidden">Parece que el código postal no es válido, por favor vuelve a intentarlo.</p> -->
        @error('cp')
            <p class="text-red-500 text-sm">{{ $message }}</p>
        @enderror
    </div>

    

    <!-- Campo Municipio -->
    <div class="form-group flex-1 mb-4">
        <label for="municipio" class="block text-gray-700">Municipio:</label>
        <input type="text" id="municipio" name="municipio" value="{{ old('municipio') }}" class="form-input mt-1 block w-full" readonly oninput="actualizarValor()">
        <input type="hidden" id="id_municipio" name="id_municipio" value="{{ old('id_municipio') }}">
    </div>

    <!-- Campo Colonia -->
    <div class="form-group flex-1 mb-4">
        <label for="colonia" class="block text-gray-700">Colonia:</label>
        <select id="colonia" name="colonia" class="form-select mt-1 block w-full">
            <option value="" disabled selected>Seleccione una colonia</option>
            @if ($colonias !== '-1')
                @foreach ($colonias as $c)
                    <option value="{{ $c->asentamiento ?: '' }}" {{ (old('colonia') == $c->asentamiento || ($cliente->cp && $cliente->colonia == $c->asentamiento)) ? 'selected' : '' }}>
                        {{ $c->asentamiento }}
                    </option>
                @endforeach
            @endif
        </select>
        @error('colonia')
            <p class="text-red-500 text-sm">{{ $message }}</p>
        @enderror
    </div>
</div>
                </div>

                <div class="form-group-horizontal">
                    <div class="half-width">
                        <label for="calle">Calle</label>
                        <input type="text" id="calle" name="calle" required>
                    </div>

                    <div class="half-width">
                        <label for="externo">Número Externo</label>
                        <input type="text" id="externo" name="externo" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="interno">Número Interno</label>
                    <input type="text" id="interno" name="interno">
                </div>

                 <!-- Estado -->
                <div class="form-group">
                    <label for="estatus">Estatus</label>
                    <select id="estatus" name="estatus" required>
                        <option value="activo">Activo</option>
                        <option value="inactivo">Inactivo</option>
                        <option value="p1">P1</option>
                        <option value="p2">P2</option>
                    </select>
                </div>

                <!-- Imagen -->
                <div class="form-group">
                    <label for="imagen">Imagen</label>
                    <input type="file" id="imagen" name="imagen" accept="image/*" required>
                </div>
                <br>

                <!-- Área Asignada -->
               <!--  <div class="form-group">
                    <label for="area_asignada">Área Asignada</label>
                    <select id="area_asignada" name="area_asignada" required>
                        <option value="desarrollo">Desarrollo</option>
                        <option value="produccion">Producción</option>
                    </select>
                </div>
                <br> -->
                




                <div class="form-section">
                    <h2 class="section-title">Datos Persona Enlace</h2>
                </div>

                <!-- Datos Enlace -->
                <div class="form-group-horizontal">
                    <div class="half-width">
                        <label for="nombre">Nombre</label>
                        <input type="text" id="nombre" name="nombre" required>
                    </div>

                    <div class="half-width">
                        <label for="paterno">Apellido Paterno</label>
                        <input type="text" id="paterno" name="paterno" required>
                    </div>
                </div>

                <div class="form-group-horizontal">
                    <div class="half-width">
                        <label for="materno">Apellido Materno</label>
                        <input type="text" id="materno" name="materno" required>
                    </div>

                    <div class="half-width">
                        <label for="telefono">Teléfono</label>
                        <input type="tel" id="telefono" name="telefono" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="correo">Correo Electrónico</label>
                    <input type="email" id="correo" name="correo" required>
                </div>

                

               
                <div class="form-group" style="text-align: center;">
                    <input type="submit" value="Enviar">
                </div>
            </form>
        </div>
    </div>

    <script>

   $(document).ready(function() {

    function actualizar_cp(id_colonia){
        var cp = document.getElementById('codigo_postal').value;
        var coloniaSelect = document.getElementById('colonia');
        var seccionSelect = document.getElementById('seccion');
        var municipioIdInput = document.getElementById('id_municipio');
        var municipioInput = document.getElementById('municipio');
        var cpError = document.getElementById('cp-error');
        coloniaSelect.innerHTML = '<option value="-1" selected>Todas las colonias</option>';
            fetch(`/colonias/${cp}`)
                .then(response => response.json())
                .then(data => {
                    if (data.length > 0) {
                        data.forEach(colonia => {
                            var option = document.createElement('option');
                            option.value = colonia.asentamiento;
                            option.textContent = colonia.asentamiento;
                             municipioIdInput.value=colonia.id_municipio;
                             municipioInput.value=colonia.municipio;

                            coloniaSelect.appendChild(option);
                        });
                        cpError.classList.add('hidden');

                    } else {
                        cpError.classList.remove('hidden');
                        municipioIdInput.value = null;
                    }
                })
                .catch(() => {
                    cpError.classList.remove('hidden');
                    municipioIdInput.value = null;
                });
    }


    


    document.getElementById('codigo_postal').addEventListener('change', function() {
        actualizar_cp(document.getElementById('codigo_postal').value);
    });

  

    
});


    </script>

</body>
</html>