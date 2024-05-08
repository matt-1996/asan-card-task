<?php

namespace App\Domain\NYTimes\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Interface\NewsRepositoryInterface;
use Illuminate\Http\Request;
use Inertia\Inertia;


class NYTimesController extends Controller
{
    public function __construct(private NewsRepositoryInterface $repository){

    }


    /**
     * @OA\Get(
     *      path="/api/ny-times/index?source=New York Times&paginate=10&start_date=2024-05-01&end_date=2024-05-10",
     *      operationId="indexNYtimes",
     *      tags={"news"},
     *      summary="Get list of NyTimes News",
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
        return $this->setData($this->repository->get($request))->response() ;
    }

    /**
     * @OA\Get(
     *      path="/api/ny-times/show/{id}",
     *      operationId="indexNYtimesShow",
     *      tags={"news"},
     *      summary="Get Specific NyTimes Article",
     *      description="Get Article By ID",
     *
     *     @OA\Parameter(
     *           name="id",
     *           description="Article id",
     *           required=true,
     *           in="path",
     *           @OA\Schema(
     *               type="string"
     *           )
     *       ),
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
     * Returns News By ID
     */
    public function show($id){
        return $this->repository->getById($id);
    }

    public function showVue(String $id){
        return Inertia::render('SingleNews', ['id' => $id]);
    }
}
