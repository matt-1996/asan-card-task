<?php

namespace App\Domain\NYTimes\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Interface\NewsRepositoryInterface;
use Illuminate\Http\Request;

class NYTimesController extends Controller
{
    public function __construct(private NewsRepositoryInterface $repository){

    }

    public function index(Request $request){
        return $this->repository->get($request);
    }

    public function show($id){
        return $this->repository->getById($id);
    }
}
