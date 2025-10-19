<?php

namespace App\Traits;


use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;

trait ApiTrait
{
    public function successResponse(array|Collection|JsonResource|\Illuminate\Support\Collection $data = [], int $statusCode = 200): JsonResponse
    {
        return response()->json(
            [
                'success' => true,
                'data' =>
                    $data
            ],
            $statusCode
        );
    }

    public function errorResponse(string $errorString, int $statusCode = 404): JsonResponse
    {
        return response()->json(
            [
                'success' => false,
                'message' => $errorString
            ],
            $statusCode
        );
    }
}
