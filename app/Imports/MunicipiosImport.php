<?php
namespace App\Imports;

use App\Models\Municipio;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class MunicipiosImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // Comprobar si la fila está vacía o incompleta
        if (empty($row) || count($row) < 5) {
            return null; // Salir si la fila está vacía o no tiene suficientes columnas
        }

        return new Municipio([
            'id'                   => $row['id'], // Mapeamos usando el encabezado
            'nombre'               => $row['municipio'], // Usamos el encabezado 'municipio'
            'apodo'                => $row['apodo'],
            'id_municipio_sepomex' => $row['id_municipio_sepomex'],
            'id_estado'            => $row['id_estado'], // Asegúrate de que este ID existe en la tabla 'estados'
        ]);
    }
}
