<?php

namespace App\Utils;


use Exception;
use Illuminate\Http\JsonResponse;

final readonly class Utils
{
    public static function renderException(Exception $e, ?string $message = null, ?int $code = null): JsonResponse
    {
        return response()->json(
            [
                'success' => false,
                'message' => $message ?? $e->getMessage(),
            ],
            $code ?? $e->getCode()
        )->header('Content-Type', 'application/json');
    }
}
