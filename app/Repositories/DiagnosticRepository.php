<?php

namespace App\Repositories;

use App\Models\Diagnostic;
use App\Models\User;

interface DiagnosticRepository
{
    public function create(int $id, array $data): Diagnostic;
    public function update(int $id, array $data): int;
    public function delete(int $id): int;
    public function findUser(int $id): User;
    public function findDiagnostic(int $id): Diagnostic;
}
