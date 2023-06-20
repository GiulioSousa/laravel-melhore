<?php

namespace App\Repositories;

use App\Models\Metric;
use App\Models\User;

class EloquentMetricRepository implements MetricRepository
{
    public function create(int $user_id, array $data): Metric
    {
        $client = $this->findUser($user_id);
        return $client->metrics()->create($data);
    }

    public function update(int $id, array $data): int
    {
        $metric = $this->findMetric($id);
        $metric->update($data);
        return $metric->users_id;
    }

    public function delete(int $id): int
    {
        $metric = $this->findMetric($id);
        $metric->delete();
        return $metric->users_id;
    }

    public function findUser(int $id): User
    {
        return User::find($id);
    }

    public function findMetric(int $id): Metric
    {
        return Metric::find($id);
    }
}