<?php

namespace App\Http\Controllers\Api\Posts;

use App\Http\Controllers\Api\ApiController;
use App\Services\Post\PostService;
use Illuminate\Http\JsonResponse;

/**
 * @OA\Delete(
 *   path="/api/posts/{id}",
 *   summary="Delete post",
 *   tags={"Posts"},
 *   security={{"sanctum":{}}},
 *   @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
 *   @OA\Response(
 *     response=200,
 *     description="OK",
 *     @OA\JsonContent(ref="#/components/schemas/SuccessMessage")
 *   ),
 *   @OA\Response(
 *          response=404,
 *          description="No results found",
 *          @OA\JsonContent(ref="#/components/schemas/ErrorResponse")
 *   )
 * )
 */
class DeletePostController extends ApiController
{
    public function __invoke(int $id, PostService $service): JsonResponse
    {
        $service->delete($id);

        return $this->successResponse();
    }
}

