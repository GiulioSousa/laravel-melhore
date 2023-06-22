<?php

namespace App\Repositories;

use App\Models\Video;
use App\Models\User;

class EloquentVideoRepository implements VideoRepository
{
    public function create(int $user_id, array $data): Video
    {
        $client = $this->findUser($user_id);
        return $client->videos()->create($data);
    }

    public function update(int $id, array $data): int
    {
        $video = $this->findVideo($id);
        $video->update($data);
        return $video->users_id;
    }

    public function delete(int $id): int
    {
        $video = $this->findVideo($id);
        $video->delete();
        return $video->users_id;
    }

    public function findUser(int $id): User
    {
        return User::find($id);
    }

    public function findVideo(int $id): Video
    {
        return Video::find($id);
    }
}