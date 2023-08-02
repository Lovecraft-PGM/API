<?php

namespace App\Http\Controllers;
use App\Http\Controllers\ServiceController as OS;
use Illuminate\Http\Request;

class OrderListController extends Controller
{
    public function orderList($params){
        foreach($params as $param){
            $data_param =[
                'id' =>$param-> id,
                'name' =>$param-> name,
                'typeParam' =>$param-> paramtype_id,
            ];

            $data[] = $data_param;
        }
        return OS::frontendResponse('200', 'success', $data, null);
    }
}
