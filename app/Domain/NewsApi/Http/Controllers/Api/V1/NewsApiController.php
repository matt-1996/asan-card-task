<?php

namespace App\Domain\NewsApi\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Interface\NewsRepositoryInterface;
use Illuminate\Http\Request;


/**
 * @OA\Info(title="My First API", version="0.1")
 */
class NewsApiController extends Controller
{
    public function __construct(private NewsRepositoryInterface $repository){

    }

    /**
     * @OA\Get(
     *      path="/api/news-api/index",
     *      operationId="index",
     *      tags={"news"},
     *      summary="Get list of News-api News",
     *      description="Returns list of News",
     *      @OA\Response(
     *          response=200,
     *          description="successful operation"
     *       ),
     *       @OA\Response(response=400, description="Bad request"),
     *       security={
     *           {"api_key_security_example": {}}
     *       }
     *     )
     *
     * Returns list of News
     */
    public function index(Request $request){
        return $this->repository->get($request);
    }
}
