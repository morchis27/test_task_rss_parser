<?php

namespace App\OpenApi;

/**
 * @OA\Schema(
 *   schema="AuthTokenResponse",
 *   type="object",
 *   required={"success","data"},
 *   @OA\Property(property="success", type="boolean", example=true),
 *   @OA\Property(
 *     property="data",
 *     type="object",
 *     @OA\Property(property="token", type="string", example="1|xxxx..."),
 *     @OA\Property(property="user", type="object",
 *       @OA\Property(property="id", type="integer", example=1),
 *       @OA\Property(property="name", type="string", example="Jane Doe"),
 *       @OA\Property(property="email", type="string", format="email", example="jane@example.com")
 *     )
 *   )
 * )
 *
 * @OA\SecurityScheme(
 *   securityScheme="sanctum",
 *   type="http",
 *   scheme="bearer",
 *   bearerFormat="Personal Access Token"
 * )
 */
class AuthSchemas
{

}
