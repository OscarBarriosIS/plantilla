<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Estado;

class CreateEstadosSeeder extends Seeder
{
    public function run()
    {
      Estado::firstOrCreate(['id' => 2,'nombre' => 'BAJA CALIFORNIA','abreviacion' => 'BC']);
      Estado::firstOrCreate(['id' => 3,'nombre' => 'BAJA CALIFORNIA SUR','abreviacion' => 'BS']);
      Estado::firstOrCreate(['id' => 4,'nombre' => 'CAMPECHE','abreviacion' => 'CC']);
      Estado::firstOrCreate(['id' => 5,'nombre' => 'COAHUILA','abreviacion' => 'CL']);
      Estado::firstOrCreate(['id' => 6,'nombre' => 'COLIMA','abreviacion' => 'CM']);
      Estado::firstOrCreate(['id' => 7,'nombre' => 'CHIAPAS','abreviacion' => 'CS']);
      Estado::firstOrCreate(['id' => 8,'nombre' => 'CHIHUAHUA','abreviacion' => 'CH']);
      Estado::firstOrCreate(['id' => 9,'nombre' => 'CIUDAD DE MEXICO','abreviacion' => 'DF']);
      Estado::firstOrCreate(['id' => 10,'nombre' => 'DURANGO','abreviacion' => 'DG']);
      Estado::firstOrCreate(['id' => 11,'nombre' => 'GUANAJUATO','abreviacion' => 'GT']);
      Estado::firstOrCreate(['id' => 12,'nombre' => 'GUERRERO','abreviacion' => 'GR']);
      Estado::firstOrCreate(['id' => 13,'nombre' => 'HIDALGO','abreviacion' => 'HG']);
      Estado::firstOrCreate(['id' => 14,'nombre' => 'JALISCO','abreviacion' => 'JC']);
      Estado::firstOrCreate(['id' => 15,'nombre' => 'MEXICO','abreviacion' => 'MC']);
      Estado::firstOrCreate(['id' => 16,'nombre' => 'MICHOACAN','abreviacion' => 'MN']);
      Estado::firstOrCreate(['id' => 17,'nombre' => 'MORELOS','abreviacion' => 'MS']);
      Estado::firstOrCreate(['id' => 18,'nombre' => 'NAYARIT','abreviacion' => 'NT']);
      Estado::firstOrCreate(['id' => 19,'nombre' => 'NUEVO LEON','abreviacion' => 'NL']);
      Estado::firstOrCreate(['id' => 20,'nombre' => 'OAXACA','abreviacion' => 'OC']);
      Estado::firstOrCreate(['id' => 21,'nombre' => 'PUEBLA','abreviacion' => 'PL']);
      Estado::firstOrCreate(['id' => 22,'nombre' => 'QUERETARO','abreviacion' => 'QT']);
      Estado::firstOrCreate(['id' => 23,'nombre' => 'QUINTANA ROO','abreviacion' => 'QR']);
      Estado::firstOrCreate(['id' => 24,'nombre' => 'SAN LUIS POTOSI','abreviacion' => 'SP']);
      Estado::firstOrCreate(['id' => 25,'nombre' => 'SINALOA','abreviacion' => 'SL']);
      Estado::firstOrCreate(['id' => 26,'nombre' => 'SONORA','abreviacion' => 'SR']);
      Estado::firstOrCreate(['id' => 27,'nombre' => 'TABASCO','abreviacion' => 'TC']);
      Estado::firstOrCreate(['id' => 28,'nombre' => 'TAMAULIPAS','abreviacion' => 'TS']);
      Estado::firstOrCreate(['id' => 29,'nombre' => 'TLAXCALA','abreviacion' => 'TL']);
      Estado::firstOrCreate(['id' => 30,'nombre' => 'VERACRUZ','abreviacion' => 'VZ']);
      Estado::firstOrCreate(['id' => 31,'nombre' => 'YUCATAN','abreviacion' => 'YN']);
      Estado::firstOrCreate(['id' => 32,'nombre' => 'ZACATECAS','abreviacion' => 'ZS']);
      Estado::firstOrCreate(['id' => 1,'nombre' => 'AGUASCALIENTES','abreviacion' => 'AS']);
    }
}
