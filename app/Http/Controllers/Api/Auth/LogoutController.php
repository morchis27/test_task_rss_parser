<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Api\ApiController;
use App\Services\Auth\AuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LogoutController extends ApiController
{
    /**
     * @OA\Post(
     *   path="/api/auth/logout",
     *   summary="Logout (revoke current token)",
     *   tags={"Auth"},
     *   security={{"sanctum":{}}},
     *   @OA\Response(response=200, description="OK", @OA\JsonContent(ref="#/components/schemas/SuccessMessage"))
     * )
     */
    public function __invoke(Request $request, AuthService $authService): JsonResponse
    {
        $authService->logout($request->user());

        return $this->successResponse();
    }
}
