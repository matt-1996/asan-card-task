<?php

namespace App\Interface;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;

interface NewsRepositoryInterface
{
    public static function get(Request $request): Collection;

    public function getById(string $id);

    public static function create(array $data): Void;

    public function update(array $data) : Void;

    public function destroy(string $id) : Void;

    public static function getLastUpdatedAt() : String;

    public static function setLastUpdatedAt(string $date) : Void;

    public static function preventDuplicated($data) : Void;

}
