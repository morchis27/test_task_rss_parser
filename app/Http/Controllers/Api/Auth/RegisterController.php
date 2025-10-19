<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Services\Auth\AuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * @OA\Post(
 *   path="/api/auth/register",
 *   summary="Register and receive a token",
 *   tags={"Auth"},
 *   @OA\RequestBody(
 *     required=true,
 *     @OA\JsonContent(
 *       required={"name","email","password","password_confirmation"},
 *       @OA\Property(property="name", type="string", example="Jane Doe"),
 *       @OA\Property(property="email", type="string", format="email", example="jane@example.com"),
 *       @OA\Property(property="password", type="string", format="password", example="secret123"),
 *       @OA\Property(property="password_confirmation", type="string", format="password", example="secret123")
 *     )
 *   ),
 *   @OA\Response(response=201, description="Registered", @OA\JsonContent(ref="#/components/schemas/AuthTokenResponse")),
 *   @OA\Response(
 *      response=422,
 *      description="Validation failed",
 *      @OA\JsonContent(ref="#/components/schemas/ValidationErrorResponse")
 *   )
 * )
 */
class RegisterController extends ApiController
{
    public function __invoke(RegisterRequest $request, AuthService $authService): JsonResponse
    {
        $result = $authService->register($request->validated());

        return $this->successResponse([
            'token' => $result['token'],
            'user' => $result['user'],
        ]);
    }

}
