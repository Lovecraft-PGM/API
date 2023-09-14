<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ServiceController as OS;
use Illuminate\Http\Request;
use App\Models\OrderDetail;
use App\Models\Param;

class orderDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private function getParamName($paramId)
    {
        $param = Param::find($paramId);

        return $param ? $param->name : null;
    }



    public function index()
    {
        $ordersDetails = OrderDetail::all()->sortBy('id');

        foreach ($ordersDetails as $orderDetail) {
            $orderDetail['o_id'] = $orderDetail->o_id;
            $orderDetail['product_id'] = $orderDetail->product_id;
            $orderDetail['qty'] = $orderDetail->qty;
            $orderDetail['subtotal'] = $orderDetail->subtotal;
            $orderDetail['param_state'] = $this->getParamName($orderDetail->param_state);
            $data[] = $orderDetail;
        }
        if (count($ordersDetails) == null) {
            $data = $ordersDetails;
            return OS::frontendResponse('404', 'error',  $data, $msg = 'Detalles de ordenes no encontradas.');
        } else {
            return OS::frontendResponse('200', 'success', $data, $msg = 'Detalles de ordenes encontradas.');
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
        $orderDetail = new OrderDetail;
        $orderDetail->o_id = $request->o_id;
        $orderDetail->product_id = $request->product_id;
        $orderDetail->qty = $request->qty;
        $orderDetail->subtotal = $request->subtotal;
        $orderDetail->param_state = $request->param_state;
        $orderDetail->save();    // save 
        $data[] = $orderDetail;
        if ($data == null) {
            return OS::frontendResponse('404', 'error',  $data, $msg = 'Detalle de orden no creado');
        } else {
            return OS::frontendResponse('200', 'success', $data, $msg = 'Detalle de orden creado.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(OrderDetail $orderDetail, $id)
    {

        //$orderDetail = orderDetail::find(request('id'));
        $data = orderDetail::find($id);
        if (!empty($data)) {
            return OS::frontendResponse('200', 'success', $data, $msg = 'Detalle de orden encontrado.');
        } else {
            return OS::frontendResponse('404', 'error',  NULL, $msg = 'Detalle de orden no encontrado.');
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
    public function update(Request $request, $id)
    {
        $orderDetail = orderDetail::find($id);
        $orderDetail->o_id = $request->o_id;
        $orderDetail->product_id = $request->product_id;
        $orderDetail->qty = $request->qty;
        $orderDetail->subtotal = $request->subtotal;
        $orderDetail->param_state = $request->param_state;
        $orderDetail->save();    // save
        $data[] = $orderDetail;
        if ($data == null) {
            return OS::frontendResponse('404', 'error',  $data, $msg = 'Detalle de orden no actualizado.');
        } else {
            return OS::frontendResponse('200', 'success', $data, $msg = 'Detalle de orden actualizado correctamente.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id, Request $request)
    {

        $orderDetail = orderDetail::find($id);

        if ($orderDetail->param_state != 1652) {
            $orderDetail->param_state = 1652;
            $orderDetail->save();
            $data[] = $orderDetail;
            return OS::frontendResponse('200', 'success', $data, 'El detalle de orden se ha desactivado correctamente.');
        } else {
            return OS::frontendResponse('404', 'error', NULL, 'El detalle de orden ya se encuentra inactivo.');
        }
    }
}
