<?php

use App\Http\Controllers\CategoriaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/categorias', [CategoriaController::class, 'index']);

Route::post('/categorias', [CategoriaController::class, 'store']);

Route::put('/categorias/{id}', [CategoriaController::class, 'update']);

Route::delete('/categorias/{id}', [CategoriaController::class, 'destroy']);