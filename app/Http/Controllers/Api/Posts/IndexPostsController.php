<?php

namespace App\Http\Controllers\Api\Posts;

use App\Http\Controllers\Api\ApiController;
use App\Http\Resources\PostResource;
use App\Services\Post\PostService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * @OA\Get(
 *   path="/api/posts",
 *   summary="List posts",
 *   tags={"Posts"},
 *   security={{"sanctum":{}}},
 *   @OA\Parameter(name="page", in="query", @OA\Schema(type="integer")),
 *   @OA\Parameter(name="per_page", in="query", @OA\Schema(type="integer")),
 *   @OA\Parameter(name="sort", in="query", @OA\Schema(type="string", enum={"title","pub_date","created_at","updated_at"})),
 *   @OA\Parameter(name="order", in="query", @OA\Schema(type="string", enum={"asc","desc"})),
 *   @OA\Parameter(name="search", in="query", @OA\Schema(type="string")),
 *   @OA\Parameter(name="date_from", in="query", @OA\Schema(type="string", format="date")),
 *   @OA\Parameter(name="date_to", in="query", @OA\Schema(type="string", format="date")),
 *   @OA\Response(
 *     response=200,
 *     description="OK",
 *     @OA\JsonContent(ref="#/components/schemas/SuccessWrapperPosts")
 *   ),
 *   @OA\Response(
 *           response=404,
 *           description="No results found",
 *           @OA\JsonContent(ref="#/components/schemas/ErrorResponse")
 *  ),
 *  @OA\Response(
 *      response=422,
 *      description="Validation failed",
 *      @OA\JsonContent(ref="#/components/schemas/ValidationErrorResponse")
 *  )
 * )
 */
class IndexPostsController extends ApiController
{
    public function __invoke(Request $request, PostService $service): JsonResponse
    {
        $page = $service->list($request->query());

        return $this->successResponse(PostResource::collection($page));
    }
}
