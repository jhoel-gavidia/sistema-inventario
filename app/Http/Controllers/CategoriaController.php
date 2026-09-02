<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoriaController extends Controller
{
    public function index()
    {
        $select = DB::select('select * from categorias');

        return response()->json($select);
    }

    public function store(Request $request)
    {
        $nombre = $request->input('nombre');
        $descripcion = $request->input('descripcion');

        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
        ]);

        DB::insert(
            "INSERT INTO categorias (nombre, descripcion, created_at, updated_at) VALUES(?,?,?,?)",
            [$nombre, $descripcion, now(), now()]
        );

        $id = (int) DB::getPdo()->lastInsertId();

        return response()->json([
            'id'=>$id,
            'nombre' => $nombre,
            'descripcion' => $descripcion,
        ], 201);
    }

    public function update(Request $request, int $id) {
        $nombre = $request->input('nombre');
        $descripcion = $request->input('descripcion');

        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
        ]);

        $update = DB::update(
            "UPDATE categorias 
            SET nombre = ?, descripcion = ?, updated_at = ?
            WHERE id = ?",
            [$nombre, $descripcion, now(), $id]
        );

        if($update === 0) {
            return response()->json(['message'=>'Categoria no encontrada'], 404);
        }

        return response()->json([
            'id'=>$id,
            'nombre'=>$nombre,
            'descripcion'=>$descripcion,
        ], 200);
    }
}
