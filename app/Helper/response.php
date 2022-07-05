<?php

namespace App\Helper;


class response
{
    public static function returnResponse($message, $status, $body){
        return response()->json([
            'body' => $body,
            'message' => $message,
            'status' => $status
        ]);
    }
}