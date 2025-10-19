<?php

namespace App\Http\Controllers\Api\Posts;

use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\StorePostRequest;
use App\Http\Resources\PostResource;
use App\Services\Post\PostService;
use Illuminate\Http\JsonResponse;

/**
 * @OA\Post(
 *   path="/api/posts",
 *   summary="Create post",
 *   tags={"Posts"},
 *   security={{"sanctum":{}}},
 *   @OA\RequestBody(
 *     required=true,
 *     @OA\JsonContent(ref="#/components/schemas/PostCreateRequest")
 *   ),
 *   @OA\Response(
 *     response=201,
 *     description="Created",
 *     @OA\JsonContent(ref="#/components/schemas/SuccessWrapperPost")
 *   ),
 *   @OA\Response(
 *      response=422,
 *      description="Validation failed",
 *      @OA\JsonContent(ref="#/components/schemas/ValidationErrorResponse")
 *   )
 * )
 */
class StorePostController extends ApiController
{
    public function __invoke(StorePostRequest $request, PostService $service): JsonResponse
    {
        $post = $service->create($request->validated());

        return $this->successResponse(new PostResource($post));
    }
}

