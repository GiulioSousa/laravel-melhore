<?php

namespace App\Repositories;

use App\Models\Video;
use App\Models\User;

interface VideoRepository
{
    public function create(int $user_id, array $data): Video;
    public function update(int $id, array $data): int;
    public function delete(int $id): int;
    public function findUser(int $id): User;
    public function findVideo(int $id): Video;
}