<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoriaController extends Controller
{
    public function index() {
        $select = DB::select('select * from categorias');

        return response()->json($select);
    }
}
