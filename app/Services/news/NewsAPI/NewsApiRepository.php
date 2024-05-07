<?php

namespace App\Services\news\NewsAPI;

use App\Interface\NewsRepositoryInterface;

class NewsApiRepository implements NewsRepositoryInterface
{

    public function get()
    {
        // TODO: Implement get() method.
        dd(2);
    }

    public function getById(string $id)
    {
        // TODO: Implement getById() method.
    }

    public function create(array $data)
    {
        // TODO: Implement create() method.
    }

    public function update(array $data): bool
    {
        // TODO: Implement update() method.
    }

    public function destroy(string $id): bool
    {
        // TODO: Implement destroy() method.
    }
}
