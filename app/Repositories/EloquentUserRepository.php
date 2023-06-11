<?php

namespace App\Repositories;

use App\Models\User;

class EloquentUserRepository implements UserRepository
{
    public function store(array $data): User
    {
        return User::store($data);
    }

    public function update(User $user, array $data): bool
    {
        return $user->update($data);
    }

    public function destroy(User $user): bool
    {
        return $user->destroy($user->id);
    }

    public function findById($id): ?User
    {
        return User::find($id);
    }
    // Implemente outros métodos do repositório, se necessário
}