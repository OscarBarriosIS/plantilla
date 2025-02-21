<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autorizar Vacaciones</title>
</head>
<body>

    <h1>Autorizar Vacaciones</h1>

    <!-- Aquí puedes mostrar un formulario para autorizar vacaciones -->
    <form action="{{ route('autorizar_vacaciones') }}" method="POST">
        @csrf
        <label for="empleado">Empleado:</label>
        <select name="empleado" id="empleado">
            <option value="empleado_1">Empleado 1</option>
            <option value="empleado_2">Empleado 2</option>
        </select>

        <button type="submit">Autorizar</button>
    </form>

</body>
</html>
