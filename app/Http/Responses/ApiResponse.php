<?php

namespace App\Http\Responses;

class ApiResponse
{
    public static function success($data = [], $message = 'Request was successful', $code = 201)
    {
        return response()->json([
            'status' => 'success',
            'message' => $message,
            'code'=> $code,
            'data' => $data,
        ], $code);
    }

    public static function error($data = [], $message = 'There was an error', $code=200)
    {
        return response()->json([
            'status' => 'Error',
            'message' => $message,
            'code'=> 400,
            'data' => $data,
        ], $code);
    }

}

