<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            ['name' => 'Admin', 'guard_name' => 'web'],
            ['name' => 'Coordinador', 'guard_name' => 'web'],
            ['name' => 'Afiliado', 'guard_name' => 'web'],
        ];

        foreach ($roles as $role) {
            Role::firstOrCreate(['name' => $role['name']], ['guard_name' => $role['guard_name']]);
        }
    }
}
