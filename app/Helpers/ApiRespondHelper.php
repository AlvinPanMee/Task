<?php

use Illuminate\Http\JsonResponse;

if (!function_exists('api_success')) {
    function api_success($data, string $message = 'success'): JsonResponse {
        return response()->json([
            'status'    => 1,
            'message'   => $message,
            'data'      => $data
        ]);
    }
}

if (!function_exists('api_error')) {
    function api_error(array|string $error_message, $data = null): JsonResponse {
        return response()->json([
            'status'    => 0,
            'message'   => $error_message,
            'data'      => $data
        ]);
    }
}