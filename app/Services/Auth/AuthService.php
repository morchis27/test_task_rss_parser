<?php

namespace App\Services\Auth;

use App\Contracts\Repository\UserRepositoryInterface;
use App\Models\User;

final readonly class AuthService
{
    public function __construct(
        private UserRepositoryInterface $userRepository,
    )
    {
    }

    public function register(array $data): array
    {
        $user = $this->userRepository->create($data);

        $token = $user->createToken('api')->plainTextToken;

        return [
            'user' => $user,
            'token' => $token
        ];
    }

    public function login(string $email, string $password): ?array
    {
        $user = $this->userRepository->validateCredentials($email, $password);
        if (!$user) {
            return null;
        }

        $token = $user->createToken('api')->plainTextToken;

        return ['user' => $user, 'token' => $token];
    }

    public function logout(User $user): void
    {
        $user->currentAccessToken()?->delete();
    }
}

