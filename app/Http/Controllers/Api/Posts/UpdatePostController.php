<?php

namespace App\Http\Controllers\Api\Posts;

use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Resources\PostResource;
use App\Services\Post\PostService;
use Illuminate\Http\JsonResponse;

/**
 * @OA\Put(
 *   path="/api/posts/{id}",
 *   summary="Update post",
 *   tags={"Posts"},
 *   security={{"sanctum":{}}},
 *   @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
 *   @OA\RequestBody(
 *     @OA\JsonContent(ref="#/components/schemas/PostUpdateRequest")
 *   ),
 *   @OA\Response(
 *     response=200,
 *     description="OK",
 *     @OA\JsonContent(ref="#/components/schemas/SuccessWrapperPost")
 *   ),
 *   @OA\Response(
 *           response=404,
 *           description="No results found",
 *           @OA\JsonContent(ref="#/components/schemas/ErrorResponse")
 *   ),
 *   @OA\Response(
 *      response=422,
 *      description="Validation failed",
 *      @OA\JsonContent(ref="#/components/schemas/ValidationErrorResponse")
 *   )
 * )
 */
class UpdatePostController extends ApiController
{
    public function __invoke(int $id, UpdatePostRequest $request, PostService $service): JsonResponse
    {
        $post = $service->update($id, $request->validated());

        return $this->successResponse(new PostResource($post));
    }
}

