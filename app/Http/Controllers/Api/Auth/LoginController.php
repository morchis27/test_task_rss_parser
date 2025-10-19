<?php

namespace App\Http\Controllers\Api\Auth;


use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\Auth\LoginRequest;
use App\Services\Auth\AuthService;
use Illuminate\Http\JsonResponse;

/**
 * @OA\Post(
 *   path="/api/auth/login",
 *   summary="Login and receive a token",
 *   tags={"Auth"},
 *   @OA\RequestBody(
 *     required=true,
 *     @OA\JsonContent(
 *       required={"email","password"},
 *       @OA\Property(property="email", type="string", format="email", example="jane@example.com"),
 *       @OA\Property(property="password", type="string", format="password", example="secret123")
 *     )
 *   ),
 *   @OA\Response(response=200, description="OK", @OA\JsonContent(ref="#/components/schemas/AuthTokenResponse")),
 *   @OA\Response(
 *         response=401,
 *         description="Invalid Credentials",
 *         @OA\JsonContent(ref="#/components/schemas/ErrorResponse")
 *   )
 * )
 */
class LoginController extends ApiController
{
    public function __invoke(LoginRequest $request, AuthService $authService): JsonResponse
    {
        $result = $authService->login($request->input('email'), $request->input('password'));

        if (!$result) {
            return $this->errorResponse(
                'Incorrect email or password',
                401
            );
        }

        return $this->successResponse([
            'token' => $result['token'],
            'user' => $result['user'],
        ]);
    }
}
