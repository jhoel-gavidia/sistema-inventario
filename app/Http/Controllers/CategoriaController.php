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

        $id = DB::getPdo()->lastInsertId();

        return response()->json([
            'id'=>$id,
            'nombre' => $nombre,
            'descripcion' => $descripcion,
        ], 201);
    }
}
