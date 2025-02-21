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
            max-width: 1200px;
            margin: 0 auto;
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
            max-width: 100%;
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
            background-color: #f5f5f5;
            color: #333;
        }

        input[type="text"]:read-only,
        input[type="email"]:read-only,
        input[type="tel"]:read-only,
        input[type="number"]:read-only {
            background-color: #f5f5f5;
            color: #888;
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
            flex-wrap: wrap;
            gap: 15px;
            justify-content: space-between;
        }

        .form-group-horizontal .one-third {
            flex: 1 1 32%;
        }

        .form-group-horizontal .half-width {
            flex: 1 1 48%;
        }

        /* Ajuste para tres columnas */
        .form-group-horizontal .column {
            flex: 1 1 30%;
            max-width: 32%;
        }

        /* Cambiar a dos columnas para los textarea */
        .form-group-horizontal .column-textarea {
            flex: 1 1 48%;
        }

        .back-link {
            display: block;
            text-align: center;
            margin-top: 20px;
            font-size: 16px;
        }

        @media (max-width: 768px) {
            .form-group-horizontal {
                flex-direction: column;
            }

            .form-group-horizontal .one-third,
            .form-group-horizontal .half-width,
            .form-group-horizontal .column {
                flex: 1 1 100%;
            }

            .form-group-horizontal .column-textarea {
                flex: 1 1 100%;
            }
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
    @include('menu')
    <div class="container" style="margin-left: 270px">
        <h1>Ver Ticket</h1>

        <div class="form-container">
            <form id="form_contra" action="{{ route('tickets.update',$ticket) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- CURP en una sola línea -->
                <div class="form-group">
                    <label for="curp">CURP:</label>
                    <input type="text" id="curp" name="curp" value="{{ ($ticket->curp) }}" readonly required>
                </div>

                <!-- Campos en tres columnas -->
                <div class="form-group-horizontal">
                    <div class="column">
                        <label for="nombre">Nombre:</label>
                        <input type="text" id="nombre" name="nombre" value="{{ ($ticket->nombre) }}" readonly required>
                    </div>
                    <div class="column">
                        <label for="paterno">Apellido Paterno:</label>
                        <input type="text" id="paterno" name="paterno" value="{{ ($ticket->paterno) }}" readonly required>
                    </div>
                    <div class="column">
                        <label for="materno">Apellido Materno:</label>
                        <input type="text" id="materno" name="materno" value="{{ ($ticket->materno) }}" readonly required>
                    </div>
                </div>

                <!-- Campos en tres columnas -->
                <div class="form-group-horizontal">
                    <div class="column">
                        <label for="estadoNacimiento">Estado de Nacimiento:</label>
                        <input type="text" id="estadoNacimiento" name="estadoNacimiento" value="{{ ($ticket->estadoNacimiento) }}" readonly required>
                    </div>
                    <div class="column">
                        <label for="fechaNacimiento">Fecha de Nacimiento:</label>
                        <input type="text" id="fechaNacimiento" name="fechaNacimiento" value="{{ ($ticket->fechaNacimiento) }}" readonly required>
                    </div>
                    <div class="column">
                        <label for="sexo">Sexo:</label>
                        <input type="text" id="sexo" name="sexo" value="{{ ($ticket->sexo) }}" readonly required>
                    </div>
                </div>

                <!-- Campos en tres columnas -->
                <div class="form-group-horizontal">
                    <div class="column">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" value="{{ ($ticket->email) }}" readonly required>
                    </div>
                    <div class="column">
                        <label for="telefono">Teléfono:</label>
                        <input type="text" id="telefono" name="telefono" value="{{ ($ticket->telefono) }}" readonly required>
                    </div>
                    <div class="column">
                        <label for="celular">Celular:</label>
                        <input type="text" id="celular" name="celular" value="{{ ($ticket->celular) }}" readonly required>
                    </div>
                </div>

                <!-- Campos en tres columnas -->
                <div class="form-group-horizontal">

                    <div class="half-width">
                        <label for="gradoEstudios">Último Grado de Estudios:</label>
                        <input type="text" id="gradoEstudios" name="gradoEstudios" value="{{ ($ticket->gradoEstudios) }}" readonly required>
                    </div>

                    <div class="half-width">
                        <label for="ocupacion">Ocupación:</label>
                        <input type="text" id="ocupacion" name="ocupacion" value="{{ ($ticket->ocupacion) }}" readonly required>
                    </div>

                </div>




                <div class="form-group-horizontal">

                <div class="column">

                    
                      <label for="cp">Código Postal:</label>
                    <input type="text" id="cp" name="cp"  value="{{ ($ticket->cp) }}"  class="input-gris" readonly required>
                    
                </div>

                 <!-- Campo Estado -->
                 <div class="column">
                    
                    <label for="estado">Estado:</label>
                    <input type="text" id="estado" name="estado"  value="{{ ($ticket->estado) }}"  class="input-gris" readonly required>
                    
                </div>

                <!-- Campo Municipio -->
                <div class="column">
                    
                    <label for="municipio">Municipio:</label>
                    <input type="text" id="municipio" name="municipio"  value="{{ ($ticket->municipio) }}"  class="input-gris" readonly required>
                    
                </div>

                

        </div>



        <div class="form-group-horizontal">

                    

            <!-- Campo Municipio -->
            <div class="column">

                <label for="colonia" class="block text-gray-700">Colonia:</label>
                <input type="text" id="colonia" class="input-gris" name="colonia"  value="{{ ($ticket->colonia) }}"  class="form-input mt-1 block w-full" readonly oninput="actualizarValor()">

            </div>

            <div class="column">
                <label for="calle">Calle</label>
                <input type="text" id="calle" name="calle" value="{{ ($ticket->calle) }}"  class="input-gris" readonly required>
            </div>

            <div class="column">
                <label for="externo">Número Externo</label>
                <input type="text" id="exterior" name="exterior" value="{{ ($ticket->exterior) }}"  class="input-gris" readonly required>
            </div>


        </div>


        <div class="form-group-horizontal">

                                
            <div class="column">
                            <label for="interno">Número Interno</label>
                            <input type="text" id="interior" value="{{ ($ticket->interior) }}"  class="input-gris" readonly name="interior">
            </div>



                <div class="column">
                        <label for="interno">Entre que calles</label>
                        <input type="text" id="entrecalles" value="{{ ($ticket->entrecalles) }}" name="entrecalles">
                </div>

                <div class="column">

                    
                        <label for="tipoCarretera">Tipo Carretera:*</label>
                        <input type="text" id="tipoCarretera" value="{{ ($ticket->tipoCarretera) }}" class="input-gris" readonly name="tipoCarretera">
                </div>

                

                        
        </div>


        <div class="form-group-horizontal">

            <div class="half-width">

                    
                        <label for="tipoCamino">Tipo camino:*</label>
                        <input type="text" id="tipoCamino" value="{{ ($ticket->tipoCamino) }}" class="input-gris" readonly name="tipoCamino">

                </div>
                

                <div class="half-width">
                        
                        
                        <label for="tipoAsentamientos">Tipo asentamiento:*</label>
                        <input type="text" id="tipoAsentamientos" value="{{ ($ticket->tipoAsentamientos) }}" class="input-gris" readonly name="tipoAsentamientos">

                    </div>

        </div>


        <div class="form-group-horizontal">
                <div class="half-width">

                    <label for="ticket">Nombre Ticket:</label>
                    <input type="text" id="ticket" name="ticket" value="{{ ($ticket->ticket) }}" class="input-gris" readonly required>
              
                </div>
                
            </div>

            <div class="form-group-horizontal">

            <div class="column">

               
                
                <label for="eje">Eje:*</label>
                <input type="text" id="eje" name="eje" value="{{ ($ticket->eje) }}" class="input-gris" readonly required>
           
            </div>

            <div class="column">

                
                
                <label for="eje">Dependenccia:*</label>
                <input type="text" id="dependencia" name="dependencia" value="{{ ($ticket->dependencia) }}" class="input-gris" readonly required>

            </div>

            <div class="column">

             
                   
                <label for="nombreTramite">Nombre Tramite:*</label>
                <input type="text" id="nombreTramite" name="nombreTramite" value="{{ ($ticket->nombreTramite) }}" class="input-gris" readonly required>

               
            </div>
        
        </div>


        <div class="form-group-horizontal">
            <!-- Aquí los campos del tercer paso -->
            <div class="column-textarea">
                    <label for="motivoTiket">Motivo del Ticket:</label>
                    <textarea id="motivoTiket" name="motivoTiket" rows="4" class="input-gris" readonly required>{{ ($ticket->motivoTiket) }}</textarea>
                </div>

                <div class="column-textarea">
                    <label for="InformacionTicket">Información del Ticket:</label>
                    <textarea id="InformacionTicket" name="InformacionTicket" rows="4" class="input-gris" readonly required>{{ ($ticket->InformacionTicket) }}</textarea>
                </div>
        </div>


        <div class="form-group-horizontal">
            <div class="half-width">
                        <label for="id_AsiganarUsuario">Usuario Asigando</label>
                        <input type="text" id="id_AsiganarUsuario" name="id_AsiganarUsuario" value="{{ ($ticket->usuario->name) }}" class="input-gris" readonly required>

                    </div>

                    <div class="half-width">
                    
                            
                        <label for="prioridad">Prioridad:</label>
                        <input type="text" id="prioridad" name="prioridad" value="{{ ($ticket->prioridad) }}" class="input-gris" readonly required>

                    </div>
         </div>

         <div class="form-group-horizontal">
         <div class="half-width">

                        <label for="observaciones">Observaciones:</label>
                        <textarea id="observaciones" name="observaciones" rows="4" readonly>{{ ($ticket->observaciones) }}</textarea>
                    </div>
            </div>




                

        <a class="button-verde" href="{{ route('tickets.index') }}" class="back-link">Regresar</a>
    </div>
</body>

</html>
