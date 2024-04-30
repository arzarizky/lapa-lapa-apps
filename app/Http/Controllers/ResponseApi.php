<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ResponseApi extends Controller
{
    public static function success($data = [], $message = "Success respon api", $status = 200)
    {
        return response([
            'success' => true,
            'data' => $data,
            'message' => $message,
        ], $status);
    }

    public static function failed($message = "Error failed respon", $status = 422)
    {
        return response([
            'success' => false,
            'message' => $message,
        ], $status);
    }
}
