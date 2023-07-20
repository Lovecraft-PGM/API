<?php

namespace App\Http\Controllers;

use GuzzleHttp\Psr7\Message;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $order = Order::all() ; 
        return response()->json($order) ;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
      $order=new Order;
      $order->userid= $request ->userid;
      $order->code = $request ->   code;
      $order->date= $request ->  date;
      $order->total= $request ->   total;
      $order->param_paymethod= $request ->param_paymethod;
      $order->param_status= $request ->param_status;
      $order->param_state= $request ->param_state;
      $order-> save ();    // save
      $data=[
        'message' => 'order created successfully',
        'order' => $order,
      ];
      return response()->json($data);


    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        return response()->json($order);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
      
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        $order->userid= $request ->userid;
        $order->code = $request ->code;
        $order->date= $request ->date;
        $order->total= $request ->total;
        $order->param_paymethod=$request->param_paymethod;
        $order->param_status=$request->param_status;
        $order->param_state=$request->param_state;
        $order-> save ();    // save
        $data=[
          'message' => 'order updated successfully',
          'orders' => $order,
        ];
        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( Order $order)
    {
        $order->delete();
        $data = [
            'message' => 'orders deleted successfully',
            'order' => $order
        ];
        return response()->json($data);
    }
}
