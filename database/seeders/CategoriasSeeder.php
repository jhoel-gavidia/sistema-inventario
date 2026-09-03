<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriasSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('categorias')->insert([
            [
                'nombre' => 'Electrónica',
                'descripcion' => 'Dispositivos electrónicos, computadoras y accesorios tecnológicos',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Alimentos y Bebidas',
                'descripcion' => 'Productos alimenticios, bebidas y víveres básicos',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Limpieza',
                'descripcion' => 'Productos de limpieza para el hogar y oficina',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Papelería',
                'descripcion' => 'Artículos de oficina, papelería y útiles escolares',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Ferretería',
                'descripcion' => 'Herramientas, materiales de construcción y ferretería en general',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Ropa y Textil',
                'descripcion' => 'Prendas de vestir, accesorios de tela y textile',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
