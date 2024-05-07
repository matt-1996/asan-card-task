<?php

namespace App\Interface;

use Illuminate\Http\Request;

interface NewsRepositoryInterface
{
    public static function get(Request $request);

    public function getById(string $id);

    public static function create(array $data);

    public function update(array $data) : bool;

    public function destroy(string $id) : bool;

}
