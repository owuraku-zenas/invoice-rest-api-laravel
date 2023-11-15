<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;

class GeneralJsonException extends Exception
{
    public function render($request): JsonResponse
    {
        $statusCode = $this->code;

        if (!is_numeric($statusCode) || $statusCode < 100 || $statusCode >= 600) {
            $statusCode = 500; // Set to a default value (e.g., 500) if it's not valid
        }

        return new JsonResponse([
            'errors' => [
                "message" => $this->getMessage()
            ]
        ], $statusCode);
    }
}
