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
            display: flex;
        }

        /* Estilo para el contenedor principal */
        .container {
            flex: 1;
            padding: 20px;
            margin-left: 250px; /* Espacio para el sidebar */
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

        /* Estilo para el sidebar */
        .sidebar {
            width: 250px;
            background-color: #2575fc;
            color: white;
            height: 100vh;
            padding-top: 30px;
            position: fixed;
            left: 0;
            top: 0;
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

        /* Estilo para el formulario */
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

            .container {
                margin-left: 0; /* Eliminar el espacio del sidebar en pantallas pequeñas */
            }
        }

        /* Estilo para los campos con clase 'input-gris' */
    .input-gris {
        background-color: #f0f0f0; /* Gris tenue */
        border: 1px solid #ccc; /* Borde gris claro */
        padding: 8px; /* Espaciado interno */
        border-radius: 4px; /* Bordes redondeados */
        width: 100%; /* O puedes ajustarlo a un tamaño específico */
        box-sizing: border-box; /* Para que el padding no afecte el tamaño total */
    }

        /* Estilo para el botón verde */
.button-verde {
  background-color: #28a745; /* Color verde */
  color: white; /* Texto blanco */
  padding: 12px 24px; /* Espaciado alrededor del texto */
  border-radius: 5px; /* Bordes redondeados */
  font-size: 16px; /* Tamaño de fuente */
  font-weight: bold; /* Negrita en el texto */
  border: none; /* Sin borde */
  cursor: pointer; /* Cambia el cursor al pasar por encima */
  transition: background-color 0.3s ease; /* Transición suave al pasar el ratón */
  text-decoration:none;
}

.button-verde:hover {
  background-color: #218838; /* Verde más oscuro al pasar el ratón */
}
    </style>
</head>

<body>
    <!-- Menú lateral (sidebar) -->
    @include('menu')

    <div class="container">
        <h1>Editar Ticket</h1>

        <div class="form-container">
            <form id="form_contra" action="{{ route('tickets.update',$ticket) }}" method="POST">
                @csrf
                @method('PUT')

               

            <div class="form-group-horizontal">
                <div class="half-width">
                    <label for="curp">CURP:</label>
                    <input type="text" id="curp" name="curp"  value="{{ ($ticket->curp) }}" readonly  required class="input-gris">
                </div>
               
            </div>


            <div class="form-group-horizontal">

                <div class="column">
                    <label for="nombre">Nombre:</label>
                    <input type="text" id="nombre" name="nombre"  value="{{ ($ticket->nombre) }}" readonly required class="input-gris">
                </div>

                <div class="column">
                    <label for="paterno">Apellido Paterno:</label>
                    <input type="text" id="paterno" name="paterno"  value="{{ ($ticket->paterno) }}" readonly required class="input-gris">
                </div>

                <div class="column">
                    <label for="materno">Apellido Materno:</label>
                    <input type="text" id="materno" name="materno"   value="{{ ($ticket->materno) }}" readonly required class="input-gris">
                </div>
             </div>


               
            <div class="form-group-horizontal">

                <div class="column">
                    <label for="estadoNacimiento">Estado de Nacimiento:</label>
                    <input type="text" class="input-gris" id="estadoNacimiento" name="estadoNacimiento"   value="{{ ($ticket->estadoNacimiento) }}" readonly required>
                </div>

                <div class="column">
                    <label for="fechaNacimiento">Fecha de Nacimiento:</label>
                    <input type="text" class="input-gris" id="fechaNacimiento" name="fechaNacimiento"  value="{{ ($ticket->fechaNacimiento) }}" readonly required>
                </div>

                <div class="column">
                    <label for="sexo">Sexo:</label>
                    <input type="text" class="input-gris" id="sexo" name="sexo"  value="{{ ($ticket->sexo) }}" readonly required>
                </div>

                </div>

                <div class="form-group-horizontal">

                <div class="column">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" value="{{ ($ticket->email) }}" required>
                </div>


                <!-- Aquí los campos del segundo paso -->
                <div class="column">
                    <label for="telefono">Teléfono:</label>
                    <input type="text" id="telefono" name="telefono"  value="{{ ($ticket->telefono) }}" required>
                </div>

                <div class="column">
                    <label for="celular">Celular:</label>
                    <input type="text" id="celular" name="celular"  value="{{ ($ticket->celular) }}" required>
                </div>

            </div>


            <div class="form-group-horizontal">
            
                <div class="half-width">
                    <label for="gradoEstudios">Último Grado de Estudios:</label>
                    <select id="gradoEstudios" name="gradoEstudios"  required>
                        <option value="{{ ($ticket->gradoEstudios) }}">{{ ($ticket->gradoEstudios) }}</option>                  
                        <option value="">Selecciona una Opcion</option>                   
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
                        <option value="{{ ($ticket->ocupacion) }}">{{ ($ticket->ocupacion)}}</option>
                        <option value="">Selecciona una Opcion</option>
                        <option value="Empleado">Empleado</option>
                        <option value="Freelance">Freelance</option>
                        <option value="Desempleado">Desempleado</option>
                    </select>
                    </div>
                </div>
            

                <div class="form-group-horizontal">

                <div class="column">
                    <label for="cp" class="block text-gray-700">Código Postal:</label>
                    <input type="text" id="cp" class="input-gris" name="cp"  value="{{ ($ticket->cp) }}" class="form-input mt-1 block w-full" maxlength="5" readonly>
                    <!-- <p id="cp-error" class="text-red-500 text-sm hidden">Parece que el código postal no es válido, por favor vuelve a intentarlo.</p> -->
                    @error('cp')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                 <!-- Campo Estado -->
                <div class="form-group flex-1 mb-4">
                    <label for="estado" class="block text-gray-700">Estado:</label>
                    <input type="text" id="estado" class="input-gris" name="estado"  value="{{ ($ticket->estado) }}"  class="form-input mt-1 block w-full" readonly oninput="actualizarValor()">
                    <input type="hidden" id="id_estado" name="id_estado" value="{{ old('id_estado') }}">
                </div>

                <!-- Campo Municipio -->
                <div class="column">
                    <label for="municipio" class="block text-gray-700">Municipio:</label>
                    <input type="text" id="municipio" class="input-gris" name="municipio"  value="{{ ($ticket->municipio) }}"  class="form-input mt-1 block w-full" readonly oninput="actualizarValor()">
                    <input type="hidden" id="id_municipio" name="id_municipio" value="{{ old('id_municipio') }}">
                </div>

                

        </div>

            
        <div class="form-group-horizontal">

            <!-- Campo Colonia
            <div class="column">
                        <label for="colonia" class="block text-gray-700">Colonia:</label>
                        <select id="colonia" name="colonia" class="form-select mt-1 block w-full">
                            <option value="" disabled selected>Seleccione una colonia</option>
                            <option value="prueba"  selected>Prueba</option>
                            @if ($colonias !== '-1')
                                @foreach ($colonias as $c)
                                    <option value="{{ $c->asentamiento ?: '' }}" {{ (old('colonia') == $c->asentamiento || ($ticket->cp && $ticket->colonia == $c->asentamiento)) ? 'selected' : '' }}>
                                        {{ $c->asentamiento }}
                                    </option>
                                @endforeach
                            @endif
                        </select>
                        @error('colonia')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div> -->

                      <!-- Campo Municipio -->
                <div class="column">
                    <label for="colonia" class="block text-gray-700">Colonia:</label>
                    <input type="text" id="colonia" class="input-gris" name="colonia"  value="{{ ($ticket->colonia) }}"  class="form-input mt-1 block w-full" readonly oninput="actualizarValor()">
                   
                </div>

                    <div class="column">
                            <label for="calle">Calle</label>
                            <input type="text" id="calle" name="calle" value="{{ ($ticket->calle) }}"  required>
                        </div>

                        <div class="column">
                            <label for="externo">Número Externo</label>
                            <input type="text" id="exterior" name="exterior" value="{{ ($ticket->exterior) }}" required>
                        </div>

                    
        </div>

        <div class="form-group-horizontal">

                    
            <div class="column">
                            <label for="interno">Número Interno</label>
                            <input type="text" id="interior" value="{{ ($ticket->interior) }}" name="interior">
            </div>



                <div class="column">
                        <label for="interno">Entre que calles</label>
                        <input type="text" id="entrecalles" value="{{ ($ticket->entrecalles) }}" name="entrecalles">
                </div>

                <div class="column">

                        <label for="prioridad">Tipo Carretera:*</label>
                        <select id="tipoCarretera" name="tipoCarretera" required>
                            <option value="{{ ($ticket->tipoCarretera) }}">{{ ($ticket->tipoCarretera)}}</option>
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
                        <option value="{{ ($ticket->tipoCamino) }}">{{ ($ticket->tipoCamino)}}</option>
                            <option value="Alta">Selecciona una Opción</option>
                            <option value="Alta">Camino</option>
                            <option value="Media">Terraceria</option>
                            <option value="Baja">Baja</option>
                        </select>
                </div>
                

                <div class="half-width">
                        <label for="tipoAsentamientos">Tipo asentamiento:*</label>
                        <select id="tipoAsentamientos" name="tipoAsentamientos" required>
                        <option value="{{ ($ticket->tipoAsentamientos) }}">{{ ($ticket->tipoAsentamientos)}}</option>
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


            <div class="form-group-horizontal">
                <div class="half-width">
                    <label for="ticket">Nombre Ticket:</label>
                    <input type="text" id="ticket" name="ticket" value="{{ ($ticket->ticket) }}" required>
                </div>
                
            </div>

        <div class="form-group-horizontal">

            <div class="column">

                <label for="eje">Eje:*</label>
                <select id="eje" name="eje" required>
                <option value="{{ ($ticket->eje) }}">{{ ($ticket->eje)}}</option>
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
                <option value="{{ ($ticket->dependencia) }}">{{ ($ticket->dependencia)}}</option>
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
                <option value="{{ ($ticket->nombreTramite) }}">{{ ($ticket->nombreTramite)}}</option>
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
                <textarea id="motivoTiket" name="motivoTiket" rows="4"  required>{{ ($ticket->motivoTiket) }}</textarea>
            </div>

            <div class="form-group">
                <label for="InformacionTicket">Información del Ticket:</label>
                <textarea id="InformacionTicket" name="InformacionTicket" rows="4"  required>{{ ($ticket->InformacionTicket) }}</textarea>
            </div>

            <div class="form-group">
                <label for="area">Área:</label>
                <select id="area" name="area" required>
                <option value="{{ ($ticket->area) }}">{{ ($ticket->area)}}</option>
                    <option value="Alta">Selecciona una Opción</option>
                    <option value="Producción">Producción</option>
                    <option value="Desarrollo">Desarrollo</option>
                </select>
            </div>

            <div class="form-group">
                <label for="id_AsiganarUsuario">Asignar Actividad</label>
                <select id="id_AsiganarUsuario" name="id_AsiganarUsuario" required>
                <option value="{{ ($ticket->id_AsiganarUsuario) }}">{{ ($ticket->usuario->name)}}</option>
                    <option value="">Selecciona una persona</option>
                    @foreach ($usuarios as $usuario)
                        <option value="{{ $usuario->id }}">{{ $usuario->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="prioridad">Prioridad:</label>
                <select id="prioridad" name="prioridad" required>
                <option value="{{ ($ticket->prioridad) }}">{{ ($ticket->prioridad)}}</option>
                    <option value="Alta">Selecciona una Opción</option>
                    <option value="Alta">Alta</option>
                    <option value="Media">Media</option>
                    <option value="Baja">Baja</option>
                </select>
            </div>

            <div class="form-group-horizontal">
            <label for="observaciones">Observaciones:</label>
            <textarea id="observaciones" name="observaciones" rows="4"  required>{{ ($ticket->observaciones) }}</textarea>
                
            </div>

<br>
           
            <div class="form-group" style="text-align: center;">
            <a class="button-verde" href="{{ route('tickets.index') }}" class="back-link">Regresar</a>
                <input type="submit" value="EditarTicket">
            </div>
         

              
            </form>
        </div>

    </div>

    <script>
        $(document).ready(function () {
            $('#consultar-curp').click(function () {
                var curp = $('#curp').val();
                if (curp) {
                    alert('Consultando CURP: ' + curp);
                    // Aquí puedes agregar el código para realizar la consulta de CURP
                }
            });
        });
    </script>

</body>

</html>
