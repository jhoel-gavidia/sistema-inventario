<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use function Illuminate\Support\now;

class ProductoController extends Controller
{
    public function index()
    {
        $select = DB::select(
        "SELECT 
        p.nombre, 
        p.descripcion,
        p.precio,
        p.stock_actual,
        c.nombre AS categoria,
        r.nombre AS proveedor 
        FROM productos p
        INNER JOIN categorias c ON p.categoria_id = c.id
        INNER JOIN proveedores r ON p.proveedor_id = r.id");

        return response()->json($select);
    }

    public function store(Request $request)
    {
        $nombre = $request->input('nombre');
        $descripcion = $request->input('descripcion');
        $precio = $request->input('precio');
        $stock_actual = $request->input('stock_actual');
        $categoria_id = $request->input('categoria_id');
        $proveedor_id = $request->input('proveedor_id');

        $request->validate([
            'nombre' => ['required', 'string', 'max:255'],
            'descripcion' => ['nullable', 'string'],
            'precio' => ['required', 'numeric', 'min:0'],
            'stock_actual' => ['required', 'integer', 'min:0'],
            'categoria_id' => ['required', 'integer', 'exists:categorias,id'],
            'proveedor_id' => ['required', 'integer', 'exists:proveedores,id'],
        ]);

        DB::insert(
            "INSERT INTO productos
            (nombre, descripcion, precio, stock_actual, categoria_id, proveedor_id, created_at, updated_at)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)",
            [$nombre, $descripcion, $precio, $stock_actual, $categoria_id, $proveedor_id, now(), now()]
        );

        $id = (int) DB::getPdo()->lastInsertId();

        return response()->json([
            'id' => $id,
            'nombre' => $nombre,
            'descripcion' => $descripcion,
            'precio' => $precio,
            'stock_actual' => $stock_actual,
            'categoria_id' => $categoria_id,
            'proveedor_id' => $proveedor_id,
        ], 201);
    }

    public function update(Request $request, int $id) {
        $nombre = $request->input('nombre');
        $descripcion = $request->input('descripcion');
        $precio = $request->input('precio');
        $stock_actual = $request->input('stock_actual');
        $categoria_id = $request->input('categoria_id');
        $proveedor_id = $request->input('proveedor_id');

        $request->validate([
            'nombre' => ['required', 'string', 'max:255'],
            'descripcion' => ['nullable', 'string'],
            'precio' => ['required', 'numeric', 'min:0'],
            'stock_actual' => ['required', 'integer', 'min:0'],
            'categoria_id' => ['required', 'integer', 'exists:categorias,id'],
            'proveedor_id' => ['required', 'integer', 'exists:proveedores,id'],
        ]);

        $update = DB::update(
            "UPDATE productos
            SET nombre = ?, descripcion = ?, precio = ?, stock_actual = ?, categoria_id = ?, proveedor_id = ?, updated_at = ?
            WHERE id = ?",
            [$nombre, $descripcion, $precio, $stock_actual, $categoria_id, $proveedor_id, now(), $id]
        );

        if($update === 0) {
            return response()->json(['message' => 'Producto no encontrado'], 404);
        }

        return response()->json([
            'id' => $id,
            'nombre' => $nombre,
            'descripcion' => $descripcion,
            'precio' => $precio,
            'stock_actual' => $stock_actual,
            'categoria_id' => $categoria_id,
            'proveedor_id' => $proveedor_id,
        ], 200);
    }

    public function destroy(int $id) {
        $delete = DB::delete(
            "DELETE FROM productos WHERE id = ?",
            [$id]
        );

        if($delete === 0) {
            return response()->json(['message'=>'Producto no encontrado'], 404);
        }
        return response()->json([
            'message' => 'Producto eliminado con exito'
        ], 200);
    }
}
