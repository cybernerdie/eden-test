<?php

namespace App\Traits;

trait ApiResponse
{
    public static function successResponse( $message = 'success', $code = 200 )
    {
        return response()->json([ 'success' => true, 'message' => $message], $code );
    }

    public static function successResponseWithToken( $data = [], $message = 'success', $code = 200, $token = null )
    {
            return response()->json([ 'success' => true, 'message' => $message, 'data' => $data, 'token' => $token ], $code );
    }

    public static function successResponseWithData( $data = [], $message = 'success', $code = 200 )
    {
        return response()->json([ 'success' => true, 'message' => $message, 'data' => $data ], $code );
    }

    public static function errorResponse( $message = 'An error occured', $code = 400 )
    {
        return response()->json([ 'success' => false, 'message' => $message ], $code );
    }
}
