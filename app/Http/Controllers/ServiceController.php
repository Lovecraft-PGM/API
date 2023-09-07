<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  App\Http\controllers\ProductController;



class ServiceController extends Controller
{
    static function frontendResponse($status, $type, $data , $msg = null)
    {

        $response = [
            'status' => $status,
            'type' => $type
            
        ];
        if (!is_null($data))
            $response['data'] = $data;
            
        if ($response['type'] == 'error') {
            if (!is_null($msg))
                $response['error'] = ['message' => $msg];
        }
        if ($response['type'] == 'success') {
            if (!is_null($msg))
            $response['success'] = ['message' => $msg];
        }
    }
}