<?php

namespace App\Http\Middleware;

use App\Services\AuthService;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class JwtMiddleware
{
    public function __construct(
        private readonly AuthService $authService
    ) {}

    public function handle(Request $request, Closure $next): Response
    {
        $authorization = $request->header('Authorization');

        if (! $authorization || ! str_starts_with($authorization, 'Bearer ')) {
            return response()->json([
                'message' => 'Token no proporcionado',
            ], 401);
        }

        $token = substr($authorization, 7);

        if (empty($token)) {
            return response()->json([
                'message' => 'Token no proporcionado',
            ], 401);
        }

        $payload = $this->authService->decodeToken($token);

        if (! $payload) {
            return response()->json([
                'message' => 'Token inválido o expirado',
            ], 401);
        }

        $user = $this->authService->findById((int) $payload->sub);

        if (! $user) {
            return response()->json([
                'message' => 'Usuario no encontrado',
            ], 401);
        }

        $request->setUserResolver(fn () => $user);

        return $next($request);
    }
}
