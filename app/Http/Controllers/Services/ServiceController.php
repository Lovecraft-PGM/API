<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ServiceController extends Controller
{
    static function frontendResponse($status, $type ,$data = null,$msgError = null) {

        $response =[
            'status' =>$status,
            'type' =>$type
        ];
        if ($data!= null){$response['data'] = $data;}

        if($response['type']== 'error'){
            if(!is_null($msgError))
            $response['error'] = ['message' => $msgError]; 
        }
        return response()-> json($response);   
    } 

   
}
