<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductosSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('productos')->insert([
            [
                'nombre' => 'Laptop HP 15"',
                'descripcion' => 'Laptop HP con procesador Intel i5, 8GB RAM, 256GB SSD',
                'precio' => 12999.99,
                'stock_actual' => 15,
                'categoria_id' => 1,
                'proveedor_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Mouse Inalámbrico Logitech',
                'descripcion' => 'Mouse inalámbrico Logitech M185, ergonomico, USB',
                'precio' => 189.50,
                'stock_actual' => 45,
                'categoria_id' => 1,
                'proveedor_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Teclado Mecánico Gamer',
                'descripcion' => 'Teclado mecánico RGB con switches Cherry MX, diseño gaming',
                'precio' => 499.00,
                'stock_actual' => 20,
                'categoria_id' => 1,
                'proveedor_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Arroz Premium 1kg',
                'descripcion' => 'Arroz grano largo, pacote de 1 kilogramo',
                'precio' => 25.90,
                'stock_actual' => 120,
                'categoria_id' => 2,
                'proveedor_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Aceite de Oliva Extra Virgen 500ml',
                'descripcion' => 'Aceite de oliva extra virgen, prensado en frío, botella 500ml',
                'precio' => 65.00,
                'stock_actual' => 80,
                'categoria_id' => 2,
                'proveedor_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Café Molido Especial 250g',
                'descripcion' => 'Café 100% arábica, tueste medio, bolsa 250g',
                'precio' => 45.50,
                'stock_actual' => 60,
                'categoria_id' => 2,
                'proveedor_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Detergente Líquido Multiusos 1L',
                'descripcion' => 'Detergente líquido concentrado para todo tipo de superficies',
                'precio' => 18.75,
                'stock_actual' => 200,
                'categoria_id' => 3,
                'proveedor_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Desinfectante en Spray 500ml',
                'descripcion' => 'Spray desinfectante con aroma a limón, mata 99.9% de bacterias',
                'precio' => 22.00,
                'stock_actual' => 150,
                'categoria_id' => 3,
                'proveedor_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Cuaderno Profesional 100hojas',
                'descripcion' => 'Cuaderno profesional de 100 hojas rayado, tamaño carta',
                'precio' => 12.50,
                'stock_actual' => 300,
                'categoria_id' => 4,
                'proveedor_id' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Martillo de Uña 16oz',
                'descripcion' => 'Martillo de uña profesional, mango de fibra de vidrio',
                'precio' => 89.00,
                'stock_actual' => 35,
                'categoria_id' => 5,
                'proveedor_id' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Cable USB-C a Lightning 1m',
                'descripcion' => 'Cable de carga y datos USB-C a Lightning, longitud 1 metro',
                'precio' => 59.90,
                'stock_actual' => 75,
                'categoria_id' => 1,
                'proveedor_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Camiseta Básica Algodón',
                'descripcion' => 'Camiseta 100% algodón, varios colores, tallas S-XL',
                'precio' => 75.00,
                'stock_actual' => 100,
                'categoria_id' => 6,
                'proveedor_id' => 6,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
