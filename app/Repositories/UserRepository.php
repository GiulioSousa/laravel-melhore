<?php

namespace App\Repositories;

use App\Models\User;

interface UserRepository
{
    public function Store(array $data): User;
    public function update(User $user, array $data): bool;
    public function destroy(User $user): bool;
    public function findById($id): ?User;
}