<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\Diagnostic;

class EloquentDiagnosticRepository implements DiagnosticRepository
{
    public function create(int $user_id, array $data): Diagnostic
    {
        $client = $this->findUser($user_id);
        return $client->diagnostics()->create($data);
    }

    public function update(int $id, array $data): int
    {
        $diagnostic = $this->findDiagnostic($id);
        $diagnostic->update($data);
        return $diagnostic->users_id;
    }

    public function delete(int $id): int
    {
        $diagnostic = $this->findDiagnostic($id);
        $diagnostic->delete();
        return $diagnostic->users_id;
    }

    public function findUser(int $id): User
    {
        return User::find($id);
    }

    public function findDiagnostic(int $id): Diagnostic
    {
        return Diagnostic::find($id);
    }
}
