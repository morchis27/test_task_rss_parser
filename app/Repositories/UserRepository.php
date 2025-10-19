<?php

namespace App\Repositories;

use App\Contracts\Repository\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Contracts\Hashing\Hasher;

final readonly class UserRepository implements UserRepositoryInterface
{
    public function __construct(
        private User   $user,
        private Hasher $hasher
    )
    {
    }

    public function create(array $data): User
    {
        return $this->user->create($data);
    }

    public function findByEmail(string $email): ?User
    {
        return $this->user->where('email', $email)->first();
    }

    public function validateCredentials(string $email, string $password): ?User
    {
        $user = $this->findByEmail($email);
        if (!$user) {
            return null;
        }

        return $this->hasher->check($password, $user->password) ? $user : null;
    }
}
