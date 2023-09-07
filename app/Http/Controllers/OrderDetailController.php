<?php

namespace App\Http\Controllers;
use App\Http\Controllers\ServiceController as OS;
use Illuminate\Http\Request;
use App\Models\OrderDetail;
class OrderDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(){
        $ordersDetails = OrderDetail::all()->sortBy('id');
        
        foreach ($ordersDetails as $orderDetail){
        $orderDetail['o_id']= $orderDetail -> o_id ;
        $orderDetail['product_id']= $orderDetail ->product_id ;
        $orderDetail['qty']= $orderDetail -> qty  ;
        $orderDetail['subtotal']=$orderDetail ->subtotal;
        $orderDetail['param_state']= $orderDetail ->param_state;
        $data[] = $orderDetail; 
        }
        if (count($ordersDetails) == null) {
            $data = $ordersDetails;
            return OS::frontendResponse('404', 'error',  $data, $msg = 'No encontrado' );
        }else{
            return OS::frontendResponse('200','success', $data, $msg = 'Encontrado'); 
        }
        }


    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $orderDetail=new orderDetail;
        $orderDetail->o_id= $request -> o_id ;
        $orderDetail->product_id= $request ->product_id ;
        $orderDetail->qty= $request -> qty  ;
        $orderDetail->subtotal=$request ->subtotal;
        $orderDetail->param_state= $request ->param_state;
        $orderDetail-> save ();    // save 
        $data[] = $orderDetail;
        if ($data == null) {
            return OS::frontendResponse('404', 'error',  $data, $msg = 'Detalle de orden Creado.' );
        }else{
            return OS::frontendResponse('201','success', $data, $msg = 'Detalle de orden no creado'); 
        }
  
    }

    /**
     * Display the specified resource.
     */
    public function show(orderDetail $orderDetail)
    {
        $data[] = $orderDetail;
        if ($data == null) {
            return OS::frontendResponse('404', 'error',  $data, $msg = 'Detalles de ordenes no encontrados.' );
        }else{
            return OS::frontendResponse('200','success', $data, $msg = 'Detalles de ordenes encontrados.'); 
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, orderDetail $orderDetail)
    {
        $orderDetail=new orderDetail;
        $orderDetail->o_id= $request -> o_id ;
        $orderDetail->product_id= $request ->product_id ;
        $orderDetail->qty= $request -> qty  ;
        $orderDetail->subtotal=$request ->subtotal;
        $orderDetail->param_state= $request ->param_state;
        $orderDetail-> save ();    // save
        $data[]= $orderDetail;
        if ($data == null) {
            return OS::frontendResponse('404', 'error',  $data, $msg = 'Detalle de orden no Actualizado.' );
        }else{
            return OS::frontendResponse('201','success', $data, $msg = 'Detalle de orden Actualizado correctamente.'); 
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(orderDetail $orderDetail, Request $request)
    {

        if ($orderDetail->param_state != 1652) {
            $orderDetail->param_state = 1652;
            $orderDetail->save();
            $data[] = $orderDetail;
            return OS::frontendResponse('200', 'success', $data, $msg = 'Usuario desactivado correctamente.');
        }else{
            return OS::frontendResponse('400', 'error', [], $msg = 'El usuario ya se encuentra inactivo.');
        }
    }
}
