<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

/**
 * Trait RestTrait
 */
trait RestTrait
{
    /**
     * Return a common formatted success response method.
     *
     * @param mixed  $data
     * @param string $message
     * @param int    $code
     *
     * @return JsonResponse
     */
    public function sendResponse(mixed $data, string $message = '', int $code = 200): JsonResponse
    {
        $response = [
            'code'    => $code,
            'message' => $message
        ];

        if (empty($data)) {
            return response()->json($response, $code);
        }

        return response()->json($response+['data' => $data], $code);
    }
}
