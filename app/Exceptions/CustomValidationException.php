<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;

class CustomValidationException extends Exception
{
    protected $errors;
    protected $status;

    public function __construct(array $errors, int $status = 409)
    {
        parent::__construct(implode(", ", $errors));
        $this->errors = $errors;
        $this->status = $status;
    }

    public function render(): JsonResponse
    {
        return response()->json([
            'success' => false,
            'errors' => $this->errors,
        ], $this->status);
    }
}