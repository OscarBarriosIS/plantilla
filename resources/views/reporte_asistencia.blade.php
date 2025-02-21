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
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            table-layout: fixed;
        }

        th,
        td {
            padding: 10px;
            text-align: center;
            border: 1px solid #ccc;
            word-wrap: break-word;
        }

        th {
            background-color: #2575fc;
            color: white;
        }

        .late {
            background-color: #f44336;
            color: white;
        }

        .ontime {
            background-color: #4CAF50;
            color: white;
        }

        .lunch {
            background-color: #f0ad4e;
            color: white;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        th:first-child,
        td:first-child {
            position: sticky;
            left: 0;
            background-color: #2575fc;
            z-index: 1;
            width: 140px;
            min-width: 200px;
        }

        th:last-child,
        td:last-child {
            position: sticky;
            right: 0;
            background-color: #2575fc;
            z-index: 2;
        }

        .scrollable {
            display: inline-block;
            overflow-x: auto;
            white-space: nowrap;
            max-width: 100%;
        }

        .scrollable table {
            table-layout: auto;
        }

        .scrollable td {
            max-width: 150px;
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
    </style>
</head>

<body>
    @php
        $month = request()->get('month', Carbon\Carbon::now()->month);
        $year = request()->get('year', Carbon\Carbon::now()->year);
    @endphp

    @include('menu')
    <div class="container" style="margin-left: 270px">
        <div class="header">
           
        </div> <h1>Reporte de Asistencia - {{ $year }} - {{ $month }}</h1>

        <div class="scrollable">
            <table>
                <thead style="font-size: 16px">
                    <tr>
                        <th>Nombre</th>
                        @for ($i = 1; $i <= Carbon\Carbon::parse("$year-$month-01")->daysInMonth; $i++)
                            <th colspan="2">{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}-{{ str_pad($month, 2, '0', STR_PAD_LEFT) }}-{{ $year }}</th>
                        @endfor
                        <th colspan="2">A / R</th>
                    </tr>
                    <tr>
                        <th>Nombre</th>
                        @for ($i = 1; $i <= Carbon\Carbon::parse("$year-$month-01")->daysInMonth; $i++)
                            <th>Asistencia (Entrada / Salida)</th>
                            <th>Comida (Inicio / Fin)</th>
                        @endfor
                        <th colspan="2">A / R</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        @php
                            $totalAsistencias = 0;
                            $totalRetardos = 0;
                        @endphp
                        <tr>
                            <td>{{ $user->name }}</td>

                            @for ($i = 1; $i <= Carbon\Carbon::parse("$year-$month-01")->daysInMonth; $i++)
                                @php
                                    $date = Carbon\Carbon::create($year, $month, $i)->format('Y-m-d');
                                    $attendance = $attendancesGrouped->get($user->id)?->firstWhere('fecha', $date);
                                    $entrada = $salida = $comida = 'NR';
                                    $classEntrada = $classSalida = $classComida = '';

                                    if ($attendance) {
                                        $horaEntrada = Carbon\Carbon::parse($attendance->hora_entrada);
                                        $horaLimite = Carbon\Carbon::createFromFormat('H:i', '09:15');
                                        $entrada = $horaEntrada->format('H:i');
                                        $salida = $attendance->hora_salida ? Carbon\Carbon::parse($attendance->hora_salida)->format('H:i') : 'NR';
                                        $classEntrada = $horaEntrada <= $horaLimite ? 'ontime' : 'late';
                                        if ($horaEntrada <= $horaLimite) {
                                            $totalAsistencias++;
                                        } else {
                                            $totalRetardos++;
                                        }
                                        if ($attendance->hora_inicio_comida && $attendance->hora_fin_comida) {
                                            $inicioComida = Carbon\Carbon::parse($attendance->hora_inicio_comida);
                                            $finComida = Carbon\Carbon::parse($attendance->hora_fin_comida);
                                            $comida = $inicioComida->format('H:i') . ' / ' . $finComida->format('H:i');
                                            $diffInMinutes = $finComida->diffInMinutes($inicioComida);
                                            if ($diffInMinutes > 60) {
                                                $classComida = 'lunch';
                                            }
                                        }
                                    }
                                @endphp
                                <td class="{{ $classEntrada }}">{{ $entrada }} / {{ $salida }}</td>

                                <td class="{{ $classComida }}">{{ $comida }}</td>
                            @endfor
                            <td>{{ $totalAsistencias }} / {{ $totalRetardos }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <h3>NR - No Registrada</h>

    </div>
</body>

</html>
