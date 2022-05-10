<?php

namespace App\Interfaces;

use App\Interfaces\ResponseInterface;
use App\Http\Controllers\Controller;

class SendResponse extends Controller implements ResponseInterface {

    public function sendResponses($message,$data,$status){
        return response()->json([
            'message' => $message,
            'body' => $data,
            'status' => $status
        ]);
    }
}