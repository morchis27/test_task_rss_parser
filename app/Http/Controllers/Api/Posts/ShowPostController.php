<?php

namespace App\Http\Controllers\Api\Posts;

use App\Http\Controllers\Api\ApiController;
use App\Http\Resources\PostResource;
use App\Services\Post\PostService;
use Illuminate\Http\JsonResponse;

/**
 * @OA\Get(
 *   path="/api/posts/{id}",
 *   summary="Get post",
 *   tags={"Posts"},
 *   security={{"sanctum":{}}},
 *   @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
 *   @OA\Response(
 *     response=200,
 *     description="OK",
 *     @OA\JsonContent(ref="#/components/schemas/SuccessWrapperPost")
 *   ),
 *   @OA\Response(
 *           response=404,
 *           description="No results found",
 *           @OA\JsonContent(ref="#/components/schemas/ErrorResponse")
 *   )
 * )
 */
class ShowPostController extends ApiController
{
    public function __invoke(int $id, PostService $service): JsonResponse
    {
        return $this->successResponse(new PostResource($service->show($id)));
    }
}
