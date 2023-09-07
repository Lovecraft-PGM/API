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
<<<<<<< Updated upstream
      return OS::frontendResponse('404', 'error',  $data, $msg = 'Orden no encontrada.' );
  }else{
      return OS::frontendResponse('200','success', $data, $msg = 'Orden encontrada.'); 
=======
      return OS::frontendResponse('404', 'error',  $data, $msg = 'No Encontrado.' );
  }else{
      return OS::frontendResponse('200','success', $data, $msg = 'Encontrado.'); 
>>>>>>> Stashed changes
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
      $data[] = $order;
        if ($data == null) {
<<<<<<< Updated upstream
            return OS::frontendResponse('404', 'error',  $data, $msg = 'Orden no creada.' );
        }else{
            return OS::frontendResponse('200','success', $data, $msg = 'Orden creada correctamente.'); 
=======
            return OS::frontendResponse('404', 'error',  $data,$msg = 'Orden no creada.' );
        }else{
            return OS::frontendResponse('200','success', $data, $msg ='Orden creada correctamente.'); 
>>>>>>> Stashed changes
        }


    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
      $data[] = $order;
      if ($data == null) {
          return OS::frontendResponse('404', 'error',  $data, $msg ='Ordenes no encontradas.' );
      }else{
<<<<<<< Updated upstream
          return OS::frontendResponse('200','success', $data, $msg = 'Ordenes encontradas.'); 
=======
          return OS::frontendResponse('200','success', $data,$msg = 'Ordenes encontradas.'); 
>>>>>>> Stashed changes
      }
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
        $data[]= $order;
        if ($data == null) {
<<<<<<< Updated upstream
            return OS::frontendResponse('404', 'error',  $data, $msg = 'Orden no Actualizado.' );
        }else{
            return OS::frontendResponse('201','success', $data, $msg = 'Orden Actualizado correctamente.'); 
=======
            return OS::frontendResponse('404', 'error',  $data,$msg = 'Orden no Actualizado.' );
        }else{
            return OS::frontendResponse('200','success', $data, $msg ='Orden Actualizado correctamente.'); 
>>>>>>> Stashed changes
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( Order $order, Request $request)
    {

        if ($order->param_state != 1652) {
            $order->param_state = 1652;
            $order->save();
            $data[] = $order;
<<<<<<< Updated upstream
            return OS::frontendResponse('200', 'success', $data, $msg = 'Usuario desactivado correctamente.');
        }else{
            return OS::frontendResponse('400', 'error', [], $msg = 'El usuario ya se encuentra inactivo.');
=======
            return OS::frontendResponse('200', 'success', $data, $msg ='oreden desactivado correctamente.');
        }else{
            return OS::frontendResponse('400', 'error', [], $msg ='la orden ya se encuentra inactivo.');
>>>>>>> Stashed changes
        }
    }
}
