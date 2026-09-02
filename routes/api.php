<?php

use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProveedorController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//RUTAS CATEGORIA

Route::get('/categorias', [CategoriaController::class, 'index']);

Route::post('/categorias', [CategoriaController::class, 'store']);

Route::put('/categorias/{id}', [CategoriaController::class, 'update']);

Route::delete('/categorias/{id}', [CategoriaController::class, 'destroy']);

//RUTAS PROVEEDOR

Route::get('/proveedores', [ProveedorController::class, 'index']);

Route::post('/proveedores', [ProveedorController::class, 'store']);

Route::put('/proveedores/{id}', [ProveedorController::class, 'update']);

Route::delete('/proveedores/{id}', [ProveedorController::class, 'destroy']);