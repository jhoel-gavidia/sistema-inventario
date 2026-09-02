<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MovimientoStockController extends Controller
{
    public function index()
    {
        $select = DB::select(
            "SELECT 
            m.id,
            p.nombre AS producto,
            u.name AS usuario,
            m.tipo,
            m.cantidad,
            m.motivo,
            m.created_at
            FROM movimientos_stock m
            INNER JOIN productos p ON m.producto_id = p.id
            INNER JOIN users u ON m.user_id = u.id
            ORDER BY m.created_at DESC"
        );

        return response()->json($select);
    }

    public function store(Request $request)
    {
        $producto_id = $request->input('producto_id');
        $user_id = $request->input('user_id');
        $tipo = $request->input('tipo');
        $cantidad = $request->input('cantidad');
        $motivo = $request->input('motivo');

        $request->validate([
            'producto_id' => ['required', 'integer', 'exists:productos,id'],
            'user_id' => ['required', 'integer', 'exists:users,id'],
            'tipo' => ['required', 'in:entrada,salida'],
            'cantidad' => ['required', 'integer', 'min:1'],
            'motivo' => ['nullable', 'string', 'max:255'],
        ]);

        return DB::transaction(function () use (
            $producto_id,
            $user_id,
            $tipo,
            $cantidad,
            $motivo
        ) {

            $producto = DB::selectOne(
                "SELECT id, stock_actual
             FROM productos
             WHERE id = ?
             FOR UPDATE",
                [$producto_id]
            );

            if ($tipo === 'salida' && $cantidad > $producto->stock_actual) {
                return response()->json([
                    'message' => 'Stock insuficiente'
                ], 422);
            }

            if ($tipo === 'entrada') {
                $stock_nuevo = $producto->stock_actual + $cantidad;
            } else {
                $stock_nuevo = $producto->stock_actual - $cantidad;
            }

            DB::insert(
                "INSERT INTO movimientos_stock
            (producto_id, user_id, tipo, cantidad, motivo, created_at, updated_at)
            VALUES (?, ?, ?, ?, ?, ?, ?)",
                [
                    $producto_id,
                    $user_id,
                    $tipo,
                    $cantidad,
                    $motivo,
                    now(),
                    now()
                ]
            );

            DB::update(
                "UPDATE productos
             SET stock_actual = ?, updated_at = ?
             WHERE id = ?",
                [$stock_nuevo, now(), $producto_id]
            );

            return response()->json([
                'message' => 'Movimiento registrado correctamente',
                'producto_id' => $producto_id,
                'tipo' => $tipo,
                'cantidad' => $cantidad,
                'stock_anterior' => $producto->stock_actual,
                'stock_nuevo' => $stock_nuevo
            ], 201);
        });
    }
}
