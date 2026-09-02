<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class ProveedorController extends Controller
{
    public function index()
    {
        $select = DB::select(
            "SELECT * FROM proveedores"
        );

        return response()->json($select);
    }

   public function store(Request $request)
{
    $nombre = $request->input('nombre');
    $contacto = $request->input('contacto');
    $telefono = $request->input('telefono');
    $email = $request->input('email');

    $request->validate([
        'nombre' => ['required', 'string', 'max:255'],
        'contacto' => ['required', 'string', 'max:255'],
        'telefono' => ['nullable', 'regex:/^[0-9]{7,15}$/'],
        'email' => ['required', 'email', 'max:255', 'unique:proveedores,email'],
    ]);

    DB::insert(
        "INSERT INTO proveedores
        (nombre, contacto, telefono, email, created_at, updated_at)
        VALUES (?, ?, ?, ?, ?, ?)",
        [$nombre, $contacto, $telefono, $email, now(), now()]
    );

    $id = (int) DB::getPdo()->lastInsertId();

    return response()->json([
        'id' => $id,
        'nombre' => $nombre,
        'contacto' => $contacto,
        'telefono' => $telefono,
        'email' => $email,
    ], 201);
}

    public function update(Request $request, int $id)
    {
        $nombre = $request->input('nombre');
        $contacto = $request->input('contacto');
        $telefono = $request->input('telefono');
        $email = $request->input('email');

        $request->validate([
            'nombre'   => ['required', 'string', 'max:255'],
            'contacto' => ['required', 'string', 'max:255'],
            'telefono' => ['nullable', 'regex:/^[0-9]{7,15}$/'],
            'email'    => ['required', 'email', 'max:255', Rule::unique('proveedores', 'email')->ignore($id)],
        ]);

        $update = DB::update("UPDATE proveedores 
        SET nombre = ?, contacto = ?, telefono = ?, email = ?, updated_at = ? 
        where id = ?", 
        [$nombre, $contacto, $telefono, $email, now(), $id]);

        if($update === 0) {
            return response() -> json(['message' => 'Proveedor no encontrado'], 404);
        }

        return response()->json([
            'id' => $id,
            'nombre' => $nombre,
            'contacto' => $contacto,
            'telefono' => $telefono,
            'email' => $email,
        ], 200);
    }

    public function destroy(int $id) {
        $delete = DB::delete(
            "DELETE FROM proveedores WHERE id = ?",
            [$id]
        );

        if($delete === 0) {
            return response()->json(['message'=>'Proveedor no encontrado'], 404);
        }
        return response()->json([
            'message' => 'Proveedor eliminado con exito'
        ], 200);
    }
}
