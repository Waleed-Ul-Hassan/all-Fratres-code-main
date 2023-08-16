<?php

namespace App\Traits;

trait ApiResponse
{

    public function apiResponse($error, $code, $message, $data = null) {
        return response()->json([
            'error' => $error,
            'code' => (int)$code,
            'message' => $message,
            'data' => $data,
        ], 200);
    }

    public function success($message, $data = null) {
        return $this->apiResponse(false, 200, $message, $data);
    }

    public function error($message, $data = null) {
        return $this->apiResponse(true, 403, $message, $data);
    }

    public function notFound($message) {
        return $this->apiResponse(true, 404, $message);
    }

    public function invalidRequest($error) {
        return $this->apiResponse(true, 422, $error);
    }

    public function loginRequired($message) {
        if (config('app.env') == 'production') {
            return $this->apiResponse(true, 401, 'Sorry, you are not logged in.');
        }
        return $this->apiResponse(true, 401, $message);
    }

    public function forbidden($message, $code = 403) {
        return $this->apiResponse(true, $code, $message);

    }


}