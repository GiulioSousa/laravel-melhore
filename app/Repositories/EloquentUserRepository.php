<?php

namespace App\Repositories;

use App\Models\User;

class EloquentUserRepository implements UserRepository
{
    public function create(array $data): User
    {
        return User::create($data);
    }

    public function update(User $user, array $data): bool
    {
        return $user->update($data);
    }

    public function delete(User $user): bool
    {
        return $user->delete($user->id);
    }
}
