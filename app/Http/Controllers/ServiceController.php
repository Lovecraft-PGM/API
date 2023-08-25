<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  App\Http\controllers\ProductController;



class ServiceController extends Controller
{
    static function frontendResponse($status, $type, $data , $msgError = null)
    {

        $response = [
            'status' => $status,
            'type' => $type
        ];
        if (!is_null($data))
            $response['data'] = $data;
            
        if ($response['type'] == 'error') {
            if (!is_null($msgError))
                $response['error'] = ['message' => $msgError];
        }
        return response()->json($response);
    }
}

