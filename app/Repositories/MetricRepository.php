<?php

namespace App\Repositories;

use App\Models\Metric;
use App\Models\User;

interface MetricRepository
{
    public function create(int $user_id, array $data): Metric;
    public function update(int $id, array $data): int;
    public function delete(int $id): int;
    public function findUser(int $id): User;
    public function findMetric(int $id): Metric;
}