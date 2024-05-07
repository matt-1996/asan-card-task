<?php

namespace App\Services\news\NewsAPI;

use App\Interface\NewsRepositoryInterface;
use Illuminate\Http\Request;

class NewsApiRepository implements NewsRepositoryInterface
{

    public static function get(Request $request)
    {
        // TODO: Implement get() method.
//        dd(2);
    }

    public function getById(string $id)
    {
        // TODO: Implement getById() method.
    }

    public static function create(array $data)
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
