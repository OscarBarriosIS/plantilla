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
        select,
        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
        }

        textarea {
            height: 100px;
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
    </style>
</head>

<body>
    @include('menu')
    <div class="container" style="margin-left: 270px">
        <h1 style="text-align: center; margin-bottom: 30px;">Crear Actividad</h1>

        <div class="form-container">
            <form id="form_contra" action="{{ route('actividades.store') }}" method="POST">
                @csrf

                <!-- Selección de Cliente -->
                <div class="form-group">
                    <label for="id_AsiganarCliente">Selecciona un Cliente</label>
                    <select id="id_AsiganarCliente" name="id_AsiganarCliente" required>
                        <option value="">Selecciona un cliente</option>
                         @foreach ($clientes as $cliente)
                           <option value="{{ $cliente->id }}">{{ $cliente->empresa }}</option>
                         @endforeach
                        
                    </select>
                </div>

                <!-- Actividad -->
                <div class="form-group">
                    <label for="actividad">Nombre de Actividad</label>
                    <input type="text" id="actividad" name="actividad" required>
                </div>

                <!-- Fecha -->
                <div class="form-group">
                    <label for="fecha">Fecha</label>
                    <input type="date" id="fecha" name="fecha" required>
                </div>

                <!-- Descripción -->
                <div class="form-group">
                    <label for="descripcion">Descripción</label>
                    <textarea id="descripcion" name="descripcion" required></textarea>
                </div>

                <!-- Asignar Actividad -->
                <div class="form-group">
                    <label for="id_AsiganarUsuario">Asignar Actividad</label>
                    <select id="id_AsiganarUsuario" name="id_AsiganarUsuario" required>
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
                        <option value="">Selecciona la prioridad</option>
                        <option value="alta">Alta</option>
                        <option value="media">Media</option>
                        <option value="baja">Baja</option>
                    </select>
                </div>

                <!-- Botón de Enviar -->
                <div class="form-group" style="text-align: center;">
                    <input type="submit" value="Enviar">
                </div>

            </form>
        </div>
    </div>
</body>

</html>


<script>

$(document).ready(function() {

// Define la función y la vincula al objeto window
function actualizar_cp(id_colonia){
    var cp = document.getElementById('cp').value;
    var coloniaSelect = document.getElementById('colonia');
    var municipioInput = document.getElementById('municipio');
    var municipioIdInput = document.getElementById('id_municipio');
    var cpError = document.getElementById('cp-error');

    if (cp.length === 5 ) {
        fetch(`/colonias/${cp}`)
            .then(response => response.json())
            .then(data => {
                coloniaSelect.innerHTML = '<option value="" disabled selected>Seleccione una colonia</option>';
                if (data.length > 0) {
                    data.forEach(colonia => {
                        municipioInput.value = colonia.municipio;
                        
                        municipioIdInput.value = colonia.id_municipio;
                        var option = document.createElement('option');
                        option.value = colonia.asentamiento;
                        option.textContent = colonia.asentamiento;
                        coloniaSelect.appendChild(option);
                    });
                    cpError.classList.add('hidden');

                    // Llama a la función para actualizar el correo
                    //actualizarCorreo();

                    if(id_colonia != -1){
                        $('#colonia').val(id_colonia);

                        
                    }

                    
                } else {
                    cpError.classList.remove('hidden');
                    municipioInput.value = null;
                    municipioIdInput.value = null;
                }
            })
            .catch(() => {
                cpError.classList.remove('hidden');
                municipioInput.value = null;
                municipioIdInput.value = null;
            });
    } else {
        coloniaSelect.innerHTML = '<option value="" disabled selected>Seleccione una colonia</option>';
        cpError.classList.add('hidden');
        municipioInput.value = null;
        municipioIdInput.value = null;
    }
    
    
    // // Función para actualizar el correo
    // function actualizarCorreo() {
    //             var nombre = $('#nombre').val().toLowerCase();
    //               // Elimina los acentos
    //               nombre = nombre.normalize("NFD").replace(/[\u0300-\u036f]/g, "");
                
    //               var municipio = $('#municipio').val().toLowerCase();
    //             // Elimina los acentos
    //              municipio = municipio.normalize("NFD").replace(/[\u0300-\u036f]/g, "");

    //             var correo = nombre +'.'+ municipio + '@macgto.com';
    //             $('#re').val(correo); // Muestra el correo en el input resultado
    //         }
}


// Selecciona el input por su ID
var input = $('#cp');
// Verifica si el campo ya tiene un valor
if (input.val().length === 5) {
    // var id_colonia = {{ old('colonia',-1) }};
    // var id_colonia = 2336;
    actualizar_cp(id_colonia);
}

// Añade el manejador para el evento input
document.getElementById('cp').addEventListener('input', function() {
    actualizar_cp(-1);
});

});


var colonia = $('#colonia').val();
var id_colonia = colonia || "{{ old('colonia', -1) }}";

</script>

</body>
</html>
