<?php

namespace App\Domain\NewsApi\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Interface\NewsRepositoryInterface;
use Illuminate\Http\Request;

class NewsApiController extends Controller
{
    public function __construct(private NewsRepositoryInterface $repository){

    }

    public function index(Request $request){
        return $this->repository->get();
    }
}
