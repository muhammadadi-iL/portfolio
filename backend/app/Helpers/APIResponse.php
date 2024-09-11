<?php

namespace App\Helpers;

use Illuminate\Http\JsonResponse;

class APIResponse
{
    /**
     * @param string $message
     * @param array $data
     * @return JsonResponse
     */
    public static function success($message = "Ok!", $data = []): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => $data,
            'message' => $message
        ]);
    }

    /**
     * @param string $message
     * @param array $data
     * @param int $code
     * @return JsonResponse
     */
    public static function error($message = "Something went wrong!", $data = [], $code = 200): JsonResponse
    {
        return response()->json([
            'error' => false,
            'data' => $data,
            'message' => $message
        ], $code);
    }
}
