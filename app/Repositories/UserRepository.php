<?php

namespace App\Repositories;

use App\Models\User;

interface UserRepository
{
    public function create(array $data): User;
    public function update(User $user, array $data): bool;
    public function delete(User $user): bool;
}
