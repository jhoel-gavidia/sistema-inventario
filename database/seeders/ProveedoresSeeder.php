<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProveedoresSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('proveedores')->insert([
            [
                'nombre' => 'Distribuidora Tech S.A.',
                'contacto' => 'Carlos Méndez',
                'telefono' => '555-1001',
                'email' => 'contacto@distributech.com',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Alimentos del Sur S.R.L.',
                'contacto' => 'María González',
                'telefono' => '555-2002',
                'email' => 'ventas@alimentosdelsur.com',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'LimpiezaTotal S.A.',
                'contacto' => 'Roberto Sánchez',
                'telefono' => '555-3003',
                'email' => 'info@limpiezatotal.com',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Papelera Nacional S.R.L.',
                'contacto' => 'Ana Torres',
                'telefono' => '555-4004',
                'email' => 'pedidos@papeleraNacional.com',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Ferretería Central S.A.',
                'contacto' => 'Luis Ramírez',
                'telefono' => '555-5005',
                'email' => 'ventas@ferreteriacentral.com',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'ModaTextil Import',
                'contacto' => 'Laura Fernández',
                'telefono' => '555-6006',
                'email' => 'compras@modatextil.com',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
