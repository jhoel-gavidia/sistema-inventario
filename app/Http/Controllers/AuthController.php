<?php

namespace App\Http\Controllers;

use App\Services\AuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function __construct(
        private readonly AuthService $authService
    ) {}

    public function register(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'password' => 'required|string|min:8|max:255',
        ], [
            'name.required' => 'El nombre es obligatorio.',
            'email.required' => 'El email es obligatorio.',
            'email.email' => 'El email debe tener un formato válido.',
            'password.required' => 'La contraseña es obligatoria.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Datos de entrada inválidos',
                'errors' => $validator->errors(),
            ], 422);
        }

        $email = $request->input('email');

        $existingUser = DB::select(
            'SELECT id FROM users WHERE email = ? LIMIT 1',
            [$email]
        );

        if (count($existingUser) > 0) {
            return response()->json([
                'message' => 'El email ya está registrado',
            ], 422);
        }

        try {
            $user = $this->authService->register(
                $request->input('name'),
                $email,
                $request->input('password')
            );

            return response()->json([
                'message' => 'Usuario registrado exitosamente',
                'user' => $user,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al registrar el usuario',
            ], 500);
        }
    }

    public function login(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string',
        ], [
            'email.required' => 'El email es obligatorio.',
            'email.email' => 'El email debe tener un formato válido.',
            'password.required' => 'La contraseña es obligatoria.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Datos de entrada inválidos',
                'errors' => $validator->errors(),
            ], 422);
        }

        $user = $this->authService->validateCredentials(
            $request->input('email'),
            $request->input('password')
        );

        if (! $user) {
            return response()->json([
                'message' => 'Credenciales inválidas',
            ], 401);
        }

        try {
            $token = $this->authService->generateToken($user);

            return response()->json([
                'message' => 'Login exitoso',
                'token' => $token,
                'user' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                ],
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al generar el token',
            ], 500);
        }
    }
}
