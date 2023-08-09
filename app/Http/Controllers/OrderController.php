<?php

namespace App\Http\Controllers;
use App\Http\Controllers\ServiceController as OS;
use GuzzleHttp\Psr7\Message;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    $orders = Order::all()->sortBy('id');

    foreach ($orders as $order){
      $order['user_id']= $order ->user_id;
      $order['code'] = $order ->   code;
      $order['date']= $order ->  date;
      $order['total']= $order ->   total;
      $order['param_paymethod']= $order ->param_paymethod;
      $order['param_status']= $order ->param_status;
      $order['param_state']= $order ->param_state;
      $data[] = $order; 
     }
     if (count($orders) == null) {
      $data = $orders;
      return OS::frontendResponse('404', 'error',  $data, $msgError = 'Not Found.' );
  }else{
      return OS::frontendResponse('200','success', $data, null); 
  }
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
      $order->user_id= $request ->user_id;
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
