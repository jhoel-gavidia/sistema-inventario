<?php

namespace App\Services;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    public function register(string $name, string $email, string $password): object
    {
        $hashedPassword = Hash::make($password);

        DB::insert(
            'INSERT INTO users (name, email, password, created_at, updated_at) VALUES (?, ?, ?, NOW(), NOW())',
            [$name, $email, $hashedPassword]
        );

        $users = DB::select(
            'SELECT id, name, email FROM users WHERE email = ? LIMIT 1',
            [$email]
        );

        return $users[0];
    }

    public function findByEmail(string $email): ?object
    {
        $users = DB::select(
            'SELECT id, name, email, password FROM users WHERE email = ? LIMIT 1',
            [$email]
        );

        return $users[0] ?? null;
    }

    public function findById(int $id): ?object
    {
        $users = DB::select(
            'SELECT id, name, email FROM users WHERE id = ? LIMIT 1',
            [$id]
        );

        return $users[0] ?? null;
    }

    public function validateCredentials(string $email, string $password): ?object
    {
        $user = $this->findByEmail($email);

        if (! $user || ! Hash::check($password, $user->password)) {
            return null;
        }

        return $user;
    }

    public function generateToken(object $user): string
    {
        $secret = config('jwt.secret');
        $ttl = (int) config('jwt.ttl', 60);

        $now = time();

        $payload = [
            'sub' => $user->id,
            'email' => $user->email,
            'iat' => $now,
            'exp' => $now + ($ttl * 60),
        ];

        return JWT::encode($payload, $secret, 'HS256');
    }

    public function decodeToken(string $token): ?object
    {
        try {
            $secret = config('jwt.secret');

            return JWT::decode($token, new Key($secret, 'HS256'));
        } catch (\Exception $e) {
            return null;
        }
    }
}
