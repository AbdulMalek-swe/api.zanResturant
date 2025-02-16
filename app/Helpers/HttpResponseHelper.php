<?php

namespace App\Helpers;

use App\Exceptions\CustomValidationException;
use Illuminate\Http\JsonResponse;

class HttpResponseHelper{
    public static function successResponse(string $message,  $data = null, int $status = 200,): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $data,
        ], $status);
    }
    public static function errorResponse(array $errors, int $status)
    {
        throw new CustomValidationException($errors, $status);
    }

}