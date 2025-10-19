<?php

namespace App\Http\Controllers\Api;

use App\Traits\ApiTrait;

/**
 * @OA\Info(
 *   version="1.0.0",
 *   title="Test Task API",
 *   description="Test Task API"
 * )
 * @OA\Server(url="/")
 */
abstract class ApiController
{
    use ApiTrait;
}
