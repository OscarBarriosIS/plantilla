<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CreateDependenciasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('dependencias')->insert([
            ['nombre' => 'Soporte Técnico'],
            ['nombre' => 'Desarrollo de Software'],
            ['nombre' => 'Infraestructura y Sistemas'],
            ['nombre' => 'Gestión de Proyectos'],
            ['nombre' => 'Recursos Humanos'],
            ['nombre' => 'Ventas'],
            ['nombre' => 'Marketing'],
            ['nombre' => 'Control de Calidad'],
            ['nombre' => 'Finanzas y Contabilidad'],
            ['nombre' => 'Logística y Almacén'],
            ['nombre' => 'Mantenimiento'],
        ]);
    }
}
