<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Asistencia</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
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
            align-items: center;
        }

        .form-group-horizontal .half-width {
            flex: 1;
        }

        #consultar-curp {
            padding: 6px 12px;
            font-size: 12px;
            width: auto;
            margin-left: 10px;
        }

        /* Estilo para los inputs de tres columnas */
        .three-column {
            display: flex;
            gap: 10px;
        }

        .three-column .column {
            flex: 1;
        }

        @media (max-width: 768px) {
            .three-column {
                flex-direction: column;
            }

            .three-column .column {
                width: 100%;
            }
        }

        #paso-1 {
            display: block;
        }

        #paso-2,
        #paso-3 {
            display: none;
        }

        /* Estilo para el botón verde */
        .button-verde {
            background-color: #28a745;
            /* Color verde */
            color: white;
            /* Texto blanco */
            padding: 12px 24px;
            /* Espaciado alrededor del texto */
            border-radius: 5px;
            /* Bordes redondeados */
            font-size: 16px;
            /* Tamaño de fuente */
            font-weight: bold;
            /* Negrita en el texto */
            border: none;
            /* Sin borde */
            cursor: pointer;
            /* Cambia el cursor al pasar por encima */
            transition: background-color 0.3s ease;
            /* Transición suave al pasar el ratón */
        }

        .button-verde:hover {
            background-color: #218838;
            /* Verde más oscuro al pasar el ratón */
        }

        /* Estilo para el botón azul */
        .button-azul {
            background-color: #007bff;
            /* Color azul */
            color: white;
            /* Texto blanco */
            padding: 12px 24px;
            /* Espaciado alrededor del texto */
            border-radius: 5px;
            /* Bordes redondeados */
            font-size: 16px;
            /* Tamaño de fuente */
            font-weight: bold;
            /* Negrita en el texto */
            border: none;
            /* Sin borde */
            cursor: pointer;
            /* Cambia el cursor al pasar por encima */
            transition: background-color 0.3s ease;
            /* Transición suave al pasar el ratón */
        }

        .button-azul:hover {
            background-color: #0056b3;
            /* Azul más oscuro al pasar el ratón */
        }
    </style>
</head>

<body>
    @include('menu')
    <div class="container" style="margin-left: 270px">
        <h1 style="text-align: center; margin-bottom: 30px;">Crear Ticket</h1>
        <br>

        <div class="form-container">
            <form id="form_contra" action="{{ route('tickets.store') }}" method="POST">
                @csrf
                <div id="paso-1">
                    <div class="form-group-horizontal">
                        <div class="half-width">
                            <label for="curp">CURP:</label>
                            <input type="text" id="curp" name="curp"
                                value="{{ old('curp', $user->curp ?? '') }}" required>
                        </div>
                        {{-- <div class="half-width">
                            <button type="button" id="btnCurp"
                                style="margin-left: 10px; background-color: #007bff; color: white; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer;">
                                Validar
                            </button>
                        </div> --}}
                    </div>

                    <div class="form-group-horizontal">
                        <div class="column">
                            <label for="nombre">Nombre:</label>
                            <input type="text" id="nombre" name="nombre"
                                value="{{ old('nombre', $user->name ?? '') }}" required>
                        </div>
                        <div class="column">
                            <label for="paterno">Apellido Paterno:</label>
                            <input type="text" id="paterno" name="paterno"
                                value="{{ old('paterno', $user->apellido_paterno ?? '') }}" required>
                        </div>
                        <div class="column">
                            <label for="materno">Apellido Materno:</label>
                            <input type="text" id="materno" name="materno"
                                value="{{ old('materno', $user->apellido_materno ?? '') }}" required>
                        </div>
                    </div>

                    <div class="form-group-horizontal">
                        <div class="column">
                            <label for="estadoNacimiento">Estado de Nacimiento:</label>
                            <input type="text" id="estadoNacimiento" name="estadoNacimiento"
                                value="{{ old('estadoNacimiento', $user->estadoNacimiento ?? '') }}" required>
                        </div>
                        <div class="column">
                            <label for="fechaNacimiento">Fecha de Nacimiento:</label>
                            <input type="text" id="fechaNacimiento" name="fechaNacimiento"
                                value="{{ old('fechaNacimiento', $user->fecha_nacimiento ?? '') }}" required>
                        </div>
                        <div class="column">
                            <label for="sexo">Sexo:</label>
                            <input type="text" id="sexo" name="sexo"
                                value="{{ old('sexo', $user->sexo ?? '') }}" required>
                        </div>
                    </div>

                    <div class="form-group-horizontal">
                        <div class="column">
                            <label for="email">Email:</label>
                            <input type="email" id="email" name="email"
                                value="{{ old('email', $user->email ?? '') }}" required>
                        </div>
                        <div class="column">
                            <label for="telefono">Teléfono:</label>
                            <input type="text" id="telefono" name="telefono"
                                value="{{ old('telefono', $user->telefono ?? '') }}" required>
                        </div>
                        <div class="column">
                            <label for="nacionalidad">Nacionalidad:</label>
                            <input type="text" id="nacionalidad" name="nacionalidad"
                                value="{{ old('nacionalidad', $user->nacionalidad ?? '') }}" required>
                        </div>
                    </div>
                    <div class="form-group-horizontal">
                        <div class="half-width">
                            <label for="gradoEstudios">Último Grado de Estudios:</label>
                            <select id="gradoEstudios" name="gradoEstudios" required>



                                <option value="">Selecciona una Opción</option>
                                <option value="Doctorado">Doctorado</option>
                                <option value="Maestría">Maestría</option>
                                <option value="Licenciatura">Licenciatura</option>
                                <option value="Preparatoria">Preparatoria</option>
                                <option value="Secundaria">Secundaria</option>

                            </select>
                        </div>
                        <div class="half-width">
                            <label for="ocupacion">Ocupación:</label>
                            <select id="ocupacion" name="ocupacion" required>
                                <option value="">Selecciona una Opción</option>
                                <option value="Empleado">Empleado</option>
                                <option value="Freelance">Freelance</option>
                                <option value="Desempleado">Desempleado</option>
                            </select>
                        </div>
                    </div>

                    <br>

                    <div class="form-group" style="text-align: center;">
                        <button class="button-verde" type="button" onclick="nextStep(1)">Siguiente</button>
                    </div>
                </div>

                <br>
                <div id="paso-2" style="display:none;">
                    <div class="form-group-horizontal">
                        <div class="column">
                            <label for="cp" class="block text-gray-700">Código Postal:</label>
                            <input type="text" id="codigo_postal" name="cp" value="{{ old('cp') }}"
                                class="form-input mt-1 block w-full" maxlength="5">
                            @error('cp')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group flex-1 mb-4">
                            <label for="estado" class="block text-gray-700">Estado:</label>
                            <input type="text" id="estado" name="estado" value="{{ old('estado') }}"
                                class="form-input mt-1 block w-full" oninput="actualizarValor()">
                            <input type="hidden" id="id_estado" name="id_estado" value="{{ old('id_estado') }}">
                        </div>
                        <div class="column">
                            <label for="municipio" class="block text-gray-700">Municipio:</label>
                            <input type="text" id="municipio" name="municipio" value="{{ old('municipio') }}"
                                class="form-input mt-1 block w-full" oninput="actualizarValor()">
                            <input type="hidden" id="id_municipio" name="id_municipio"
                                value="{{ old('id_municipio') }}">
                        </div>

                    </div>
                    <div class="form-group-horizontal">
                        <div class="column">
                            <label for="colonia" class="block text-gray-700">Colonia:</label>
                            <select id="colonia" name="colonia" class="form-select mt-1 block w-full">
                                <option value="" disabled selected>Seleccione una colonia</option>
                                <option value="prueba" selected>Prueba</option>
                                @if ($colonias !== '-1')
                                    @foreach ($colonias as $c)
                                        <option value="{{ $c->asentamiento ?: '' }}"
                                            {{ old('colonia') == $c->asentamiento || ($ticket->cp && $ticket->colonia == $c->asentamiento) ? 'selected' : '' }}>
                                            {{ $c->asentamiento }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                            @error('colonia')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="column">
                            <label for="calle">Calle</label>
                            <input type="text" id="calle" name="calle" required>
                        </div>
                        <div class="column">
                            <label for="externo">Número Externo</label>
                            <input type="text" id="exterior" name="exterior" required>
                        </div>

                    </div>
                    <div class="form-group-horizontal">

                        <div class="column">
                            <label for="interno">Número Interno</label>
                            <input type="text" id="interior" name="interior">
                        </div>
                        <div class="column">
                            <label for="interno">Entre que calles</label>
                            <input type="text" id="entrecalles" name="entrecalles">
                        </div>
                        <div class="column">
                            <label for="prioridad">Tipo Carretera:*</label>
                            <select id="tipoCarretera" name="tipoCarretera" required>

                                <option value="">Selecciona una Opción</option>
                                <option value="ampliacion">ampliacion</option>
                                <option value="Andador">Andador</option>
                                <option value="Avenida">Avenida</option>
                                <option value="Boulevard">Boulevard</option>
                                <option value="Calle">Calle</option>
                                <option value="Callejón">Callejón</option>
                                <option value="Calzada">Calzada</option>
                                <option value="Cerrada">Cerrada</option>
                                <option value="circuito">circuito</option>
                                <option value="circulación">circulación</option>
                                <option value="continuacion">continuacion</option>
                                <option value="Corredor">Corredor</option>
                                <option value="Diagonal">Diagonal</option>
                                <option value="Eje Vial">Eje Vial</option>
                                <option value="Pasaje">Pasaje</option>
                                <option value="Peatonal">Peatonal</option>
                                <option value="Periférico">Periférico</option>
                                <option value="Privada">Privada</option>
                                <option value="Prolongacion">Prolongacion</option>
                                <option value="Retorno">Retorno</option>
                                <option value="Viadcuto">Viadcuto</option>

                            </select>
                        </div>


                    </div>
                    <div class="form-group-horizontal">
                        <div class="half-width">
                            <label for="tipoCamino">Tipo camino:*</label>
                            <select id="tipoCamino" name="tipoCamino" required>
                                <option value="Alta">Selecciona una Opción</option>
                                <option value="Alta">Camino</option>
                                <option value="Media">Terraceria</option>
                                <option value="Baja">Baja</option>
                            </select>
                        </div>

                        <div class="half-width">
                            <label for="tipoAsentamientos">Tipo asentamiento:*</label>
                            <select id="tipoAsentamientos" name="tipoAsentamientos" required>
                                <option value="Alta">Selecciona una Opción</option>
                                <option value="Arepuerto">Arepuerto</option>
                                <option value="Ampliacion">Ampliacion</option>
                                <option value="Barrio">Barrio</option>
                                <option value="Cantón">Cantón</option>
                                <option value="Ciudad">Ciudad</option>
                                <option value="Ciudad Institucional">Ciudad Institucional</option>
                                <option value="Colonia">Colonia</option>
                                <option value="Condominio">Condominio</option>
                                <option value="Conjunto habitacional">Conjunto habitacional</option>
                                <option value="Corredor industrial">Corredor industrial</option>
                                <option value="Coto">Coto</option>
                                <option value="Cuartel">Cuartel</option>
                                <option value="Ejido">Ejido</option>
                                <option value="Exhacienda">Exhacienda</option>
                                <option value="Fraccion">Fraccion</option>
                                <option value="Fraccionamiento">Fraccionamiento</option>
                                <option value="Granja">Granja</option>
                                <option value="Hacienda">Hacienda</option>
                                <option value="Ingenio">Ingenio</option>
                                <option value="Manzana">Manzana</option>
                                <option value="Paraje">Paraje</option>
                                <option value="Parque Industrial">Parque Industrial</option>
                                <option value="Privada">Privada</option>
                                <option value="Prolongacion">Prolongacion</option>
                                <option value="Pueblo">Pueblo</option>
                                <option value="Puerto">Puerto</option>
                                <option value="Rancheria">Rancheria</option>
                                <option value="Rancho">Rancho</option>
                                <option value="Región">Región</option>
                                <option value="Residencial">Residencial</option>
                                <option value="Rinconada">Rinconada</option>
                                <option value="Sección">Sección</option>
                                <option value="Sector">Sector</option>
                                <option value="Super Manzana">Super Manzana</option>
                                <option value="Unidad">Unidad</option>
                                <option value="Unidad Habitacional">Unidad Habitacional</option>
                                <option value="Villa">Villa</option>
                                <option value="Zona Federal">Zona Federal</option>
                                <option value="Zona Militar">Zona Militar/option>
                                <option value="Zona Naval">Zona Naval</option>

                            </select>
                        </div>
                    </div>
                    <br>

                    <!--- -->
                    <div class="form-group" style="text-align: center;">
                        <button class="button-azul" type="button" onclick="prevStep(2)">Anterior</button>
                        <button class="button-verde" type="button" onclick="nextStep(2)">Siguiente</button>
                    </div>
                </div>
                <!-- Paso 3 -->
                <div id="paso-3" style="display:none;">
                    <div class="form-group-horizontal">
                        <div class="half-width">
                            <label for="ticket">Nombre Ticket:</label>
                            <input type="text" id="ticket" name="ticket" required>
                        </div>

                    </div>
                    <div class="form-group-horizontal">
                        <div class="column">
                            <label for="eje">Eje:*</label>
                            <select id="eje" name="eje" required>
                                <option value="">Selecciona una Opción</option>
                                <option value="ampliacion">Economia</option>
                                <option value="Andador">Salud</option>
                                <option value="Avenida">Inclusion</option>
                                <option value="Boulevard">Eduacion</option>


                            </select>
                        </div>
                        <div class="column">
                            <label for="dependencia">Dependenccia:*</label>
                            <select id="dependencia" name="dependencia" required>
                                <option value="">Selecciona una Opción</option>
                                <option value="ampliacion">Dependecia 1</option>
                                <option value="ampliacion">Dependecia 2</option>
                                <option value="ampliacion">Dependecia 3</option>
                                <option value="ampliacion">Dependecia 4</option>


                            </select>
                        </div>
                        <div class="column">
                            <label for="nombreTramite">Nombre Tramite:*</label>
                            <select id="nombreTramite" name="nombreTramite" required>
                                <option value="">Selecciona una Opción</option>
                                <option value="ampliacion">Nombre Tramite 1</option>
                                <option value="ampliacion">Nombre Tramite 2</option>
                                <option value="ampliacion">Nombre Tramite 3</option>
                                <option value="ampliacion">Nombre Tramite 4</option>

                            </select>
                        </div>

                    </div>
                    <!-- Aquí los campos del tercer paso -->
                    <div class="form-group">
                        <label for="motivoTiket">Motivo del Ticket:</label>
                        <textarea id="motivoTiket" name="motivoTiket" rows="4" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="InformacionTicket">Información del Ticket:</label>
                        <textarea id="InformacionTicket" name="InformacionTicket" rows="4" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="area">Área:</label>
                        <select id="area" name="area" required>
                            <option value="Alta">Selecciona una Opción</option>
                            <option value="Producción">Producción</option>
                            <option value="Desarrollo">Desarrollo</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="id_AsiganarUsuario">Asignar Actividad</label>
                        <select id="id_AsiganarUsuario" name="id_AsiganarUsuario" required>
                            <option value="">Selecciona una persona</option>
                            @foreach ($usuarios as $usuario)
                                <option value="{{ $usuario->id }}">{{ $usuario->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="prioridad">Prioridad:</label>
                        <select id="prioridad" name="prioridad" required>
                            <option value="Alta">Selecciona una Opción</option>
                            <option value="Alta">Alta</option>
                            <option value="Media">Media</option>
                            <option value="Baja">Baja</option>
                        </select>
                    </div>
                    <div class="form-group-horizontal">
                        <label for="observaciones">Observaciones:</label>
                        <textarea id="observaciones" name="observaciones" rows="4" required></textarea>

                    </div>
                    <div class="form-group" style="text-align: center;">
                        <button class="button-verde" type="button" onclick="prevStep(3)">Anterior</button>
                        <input type="submit" value="Registrar Ticket">
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script>
        function nextStep(paso) {
            document.getElementById('paso-' + paso).style.display = 'none';
            document.getElementById('paso-' + (paso + 1)).style.display = 'block';
        }

        function prevStep(paso) {
            document.getElementById('paso-' + paso).style.display = 'none';
            document.getElementById('paso-' + (paso - 1)).style.display = 'block';
        }


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




        $(document).ready(function() {
            $('#btnCurp').on('click', function(event) {
                event.preventDefault();
                var url = '{{ route('buscar_curp_tiket') }}';
                $.ajax({
                    url: url,
                    method: 'GET',
                    data: {
                        curp: $('#curp').val()
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.no) {
                            var curp = $('#curp').val();
                            $('#form_contra')[0].reset();
                            $('#curp').val(curp);
                            $.ajax({

                                url: '/api/validar_curp',
                                method: 'POST',
                                data: {
                                    curp: $('#curp').val()
                                },
                                dataType: 'json',
                                success: function(apiResponse) {
                                    console.log(apiResponse);
                                    $('#nombre').val(apiResponse.data.name);
                                    $('#paterno').val(apiResponse.data.lastname);
                                    $('#materno').val(apiResponse.data.surname);
                                    $('#fecha_nacimiento').val(apiResponse.data
                                        .birthDate);

                                    if (apiResponse.data.genre === 'H') {
                                        $('#genero').val('HOMBRE')
                                    } else if (apiResponse.data.genre === 'M') {
                                        $('#genero').val('MUJER');
                                    }
                                    const stateId = apiResponse.data.stateId;
                                    const stateAb = apiResponse.data.stateAbbr;
                                    console.log(stateId);
                                    $.ajax({
                                        url: `/estado_abreviacion/${stateAb}`,
                                        method: 'GET',
                                        success: function(response) {

                                            console.log(response);
                                            $('#estado_nacimiento').val(
                                                response[0].estado);
                                        },
                                        error: function(xhr) {
                                            if (xhr.status === 404) {
                                                $('#estado_nacimiento')
                                                    .val(
                                                        'Estado no encontrado'
                                                    );
                                            } else {
                                                $('#estado_nacimiento')
                                                    .val(
                                                        'Error al obtener estado'
                                                    );
                                            }
                                        }

                                    });

                                },
                                error: function(xhr, status, error) {
                                    console.error(error);
                                    $('#resultados').html(
                                        '<p class="text-red-500">Ocurrió un error al buscar los datos en la API externa.</p>'
                                    );
                                }
                            });
                        } else {
                            console.log(response);
                            $('#nombre').val(response.nombre);
                            $('#paterno').val(response.paterno);
                            $('#materno').val(response.materno);
                            $('#sexo').val(response.sexo);
                            $('#fechaNacimiento').val(response.fechaNacimiento);
                            $('#estadoNacimiento').val(response.estadoNacimiento);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                        $('#resultados').html(
                            '<p class="text-red-500">Ocurrió un error al buscar los datos.</p>'
                        );
                    }


                });



            });

        });
    </script>
</body>

</html>
