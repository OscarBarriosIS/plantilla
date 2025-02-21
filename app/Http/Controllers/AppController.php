<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\DocumentoIne;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AppController extends Controller
{
    public function obtener_datos(Request $request)
    {
        $user = Auth::user()->load('attendancesToday');
        return response()->json($user, 200);
    }

    public function registrar_asistencia(Request $request)
    {
        try {
            $user = Auth::user();
            $idUser = $user->id;

            $data = $request->validate([
                'latitud' => 'required|string|max:20',
                'longitud' => 'required|string|max:20',
                'tipo' => 'required|string|in:Entrada,Salida,Inicio Descanso,Fin Descanso'
            ]);

            $fechaActual = Carbon::now('America/Mexico_City')->toDateString(); // Formato 'YYYY-MM-DD'
            $horaActual = Carbon::now('America/Mexico_City')->format('H:i:s'); // Formato 24h: 'HH:MM:SS'

            // $timestampActual = Carbon::now();  // 'YYYY-MM-DD HH:MM:SS'

            // Busca o crea el registro de asistencia
            $asistencia = Attendance::updateOrCreate(
                ['user_id' => $idUser, 'fecha' => $fechaActual],
                []
            );

            // Mapeo de tipos a campos
            $camposTipo = [
                'Entrada' => ['latitud_entrada', 'longitud_entrada', 'hora_entrada'],
                'Salida' => ['latitud_salida', 'longitud_salida', 'hora_salida'],
                'Inicio Descanso' => ['latitud_inicio_comida', 'longitud_inicio_comida', 'hora_inicio_comida'],
                'Fin Descanso' => ['latitud_fin_comida', 'longitud_fin_comida', 'hora_fin_comida']
            ];

            // Actualiza los campos dinámicamente
            if (isset($camposTipo[$request->tipo])) {
                $asistencia->update([
                    $camposTipo[$request->tipo][0] => $request->latitud,
                    $camposTipo[$request->tipo][1] => $request->longitud,
                    $camposTipo[$request->tipo][2] => $horaActual
                ]);
            }

            return response()->json([
                'message' => 'registro successful'
            ], 200);
        } catch (ValidationException $e) {
            // Capturar errores de validación y devolver un mensaje personalizado
            return response()->json([
                'message' => 'Error de validación',
                'errors' => $e->errors(), // Devolver los errores de validación
            ], 422);

        } catch (Exception $e) {
            // Capturar cualquier otro error (como un fallo al registrar el encuestado)
            return response()->json([
                'message' => 'Error al registrar el encuestado',
                'error' => $e->getMessage(), // Detalle del error (opcional)
            ], 500);
        }
    }

    public function obtener_asistencias(Request $request)
    {
        try {
            $user = Auth::user();

            if (!$user) {
                return response()->json([
                    'message' => 'No autenticado'
                ], 401);
            }

            // Obtener la fecha actual en la zona horaria correcta
            $hoy = Carbon::now('America/Mexico_City');

            // Asegurar que el inicio de la semana sea el lunes y el final el domingo
            $inicioSemana = $hoy->copy()->startOfWeek(Carbon::MONDAY); // Lunes
            $finSemana = $hoy->copy()->endOfWeek(); // Domingo

            // Generar un array con todos los días de la semana actual
            $diasSemana = [];
            for ($date = $inicioSemana->copy(); $date->lte($finSemana); $date->addDay()) {
                $diasSemana[$date->toDateString()] = [
                    'fecha' => $date->toDateString(),
                    'hora_entrada' => null,
                    'hora_inicio_comida' => null,
                    'hora_fin_comida' => null,
                    'hora_salida' => null,
                ];
            }

            // Filtrar asistencias dentro del rango de la semana actual
            $asistencias = Attendance::where('user_id', $user->id)
            ->whereBetween('fecha', [$inicioSemana, $finSemana])
            ->orderBy('fecha', 'desc')
            ->get([
                'fecha', 
                'hora_entrada', 
                'hora_inicio_comida', 
                'hora_fin_comida', 
                'hora_salida'
            ]);

            // Reemplazar los días que sí tienen registros
            foreach ($asistencias as $asistencia) {
                $diasSemana[$asistencia->fecha] = [
                    'fecha' => $asistencia->fecha,
                    'hora_entrada' => $asistencia->hora_entrada,
                    'hora_inicio_comida' => $asistencia->hora_inicio_comida,
                    'hora_fin_comida' => $asistencia->hora_fin_comida,
                    'hora_salida' => $asistencia->hora_salida,
                ];
            }

            // Convertir el array a un array de valores (manteniendo el orden)
            $asistenciasSemana = array_values($diasSemana);

            return response()->json([
                'message' => 'Asistencias de la semana actual obtenidas correctamente',
                'asistencias' => $asistenciasSemana
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Error al obtener las asistencias',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function guardarINE(Request $request)
    {
        DB::beginTransaction(); // Iniciar la transacción
        try{
            $data = $request->validate([
                'nombre' => 'required|string',
                'paterno' => 'required|string',
                'materno' => 'required|string',
                'curp' => 'required|string',
                'clave_elector' => 'required|string',
                'direccion' => 'required|string',
                'seccion' => 'required|string',
                'sexo' => 'required|string',
                'fecha_registro' => 'required|string',
                'fecha_emision' => 'required|string',
                'fecha_expiracion' => 'required|string',
                'ine' => 'required|file|mimes:png,jpg,jpeg|max:2048',
                'retrato' => 'file|mimes:png,jpg,jpeg|max:2048',
                'firma' => 'file|mimes:png,jpg,jpeg|max:2048',
                'correo' => 'required|string',
                'telefono' => 'required',
                'invito' => 'required|string',
                'fecha_nacimiento' => 'required',
                // 'password' => ['required', 'confirmed'],
            ]);

             // Manejo de archivos
            $ine = $request->hasFile('ine') ? $request->file('ine')->store('documentosIne', 'public') : null;
            $retrato = $request->hasFile('retrato') ? $request->file('retrato')->store('documentosIne', 'public') : null;
            $firma = $request->hasFile('firma') ? $request->file('firma')->store('documentosIne', 'public') : null;

            // // Crear el usuario en la tabla users
            // $user = User::create([
            //     'name' => $request->nombre . ' ' . $request->paterno,
            //     'email' => $request->correo,
            //     'password' => Hash::make($request->password),
            //     'apellido_paterno' => $request->paterno,
            //     'apellido_materno' => $request->materno,
            //     'sexo' => $request->sexo,
            //     'curp' => $request->curp,
            //     'telefono' => $request->telefono,
            //     'fecha_nacimiento' => $request->fecha_nacimiento,
            // ]);

            // $user->assignRole('Afiliado');

            $user_alta = Auth::user();
            $idUser_alta = $user_alta->id;
            $idUser = $user_alta->id;
            // $idUser = $user->id;
            
            $documentosIne = DocumentoIne::create([
                'clave_elector' => $request->clave_elector,
                'curp' => $request->curp,
                'nombre' => $request->nombre,
                'paterno' => $request->paterno,
                'materno' => $request->materno,
                'direccion' => $request->direccion,
                'seccion' => $request->seccion,
                'sexo' => $request->sexo,
                'fecha_registro' => $request->fecha_registro,
                'fecha_emision' => $request->fecha_emision,
                'fecha_expiracion' => $request->fecha_expiracion,
                'ine' => $ine,
                'retrato' => $retrato,
                'firma' => $firma,
                'version_ine' => "1",
                'estatus' => "1",
                'id_user' => $idUser,
                'id_user_alta' => $idUser_alta,
                'id_municipio' => '1',
                'fecha_nacimiento' => $request->fecha_nacimiento,
                'correo' => $request->correo,
                'telefono' => $request->telefono,
                'codigo_alta' => $request->invito,
            ]);

            $codigo = substr($request->curp, 0 ,4) . $documentosIne->id;

            $documentosIne->update([
                'codigo' => $codigo
            ]);

            DB::commit(); // Confirmar la transacción
            
            return response()->json([
                'id_afiliado' => $documentosIne->id, 
                'message' => 'Alta successful'
            ], 200);
        } catch (ValidationException $e) {
            // Capturar errores de validación y devolver un mensaje personalizado
            DB::rollBack(); // Revertir la transacción en caso de error de validación

            return response()->json([
                'message' => 'Error de validación',
                'errors' => $e->errors(), // Devolver los errores de validación
            ], 422);

        } catch (Exception $e) {
            // Capturar cualquier otro error (como un fallo al registrar el encuestado)
            DB::rollBack(); // Revertir la transacción en caso de error general
            
            return response()->json([
                'message' => 'Error al registrar al afiliado',
                'error' => $e->getMessage(), // Detalle del error (opcional)
            ], 500);
        }        
    }


}
