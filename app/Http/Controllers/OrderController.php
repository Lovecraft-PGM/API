<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ServiceController as OS;
use GuzzleHttp\Psr7\Message;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Param;

class OrderController extends Controller
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
        $orders = Order::all()->sortBy('id');

        foreach ($orders as $order) {
            $order['user_id'] = $order->user_id;
            $order['code'] = $order->code;
            $order['date'] = $order->date;
            $order['total'] = $order->total;
            $order['param_paymethod'] = $this->getParamName($order->param_paymethod);
            $order['param_status'] = $this->getParamName($order->param_status);
            $order['param_state'] = $this->getParamName($order->param_state);
            $data[] = $order;
        }
        if (count($orders) == null) {
            $data = $orders;
            return OS::frontendResponse('404', 'error',  $data, $msg = 'Ordenes no encontradas.');
        } else {
            return OS::frontendResponse('200', 'success', $data, $msg = 'Ordenes encontradas');
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
        $order = new Order;
        $order->user_id = $request->user_id;
        $order->code = $request->code;
        $order->date = $request->date;
        $order->total = $request->total;
        $order->param_paymethod = $request->param_paymethod;
        $order->param_status = $request->param_status;
        $order->param_state = $request->param_state;
        $order->save();    // save
        $data[] = $order;
        if ($data == null) {
            return OS::frontendResponse('404', 'error',  $data, $msg = 'Orden no creada.');
        } else {
            return OS::frontendResponse('200', 'success', $data, $msg = 'Orden creada correctamente.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        $data[] = $order;
        if ($data == null) {
            return OS::frontendResponse('404', 'error',  $data, $msg = 'Orden no encontrada.');
        } else {
            return OS::frontendResponse('200', 'success', $data, $msg = 'Orden encontrada.');
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
        $order->user_id = $request->user_id;
        $order->code = $request->code;
        $order->date = $request->date;
        $order->total = $request->total;
        $order->param_paymethod = $request->param_paymethod;
        $order->param_status = $request->param_status;
        $order->param_state = $request->param_state;
        $order->save();    // save
        $data[] = $order;
        if ($data == null) {
            return OS::frontendResponse('404', 'error',  $data, $msg = 'Orden no actualizada.');
        } else {
            return OS::frontendResponse('200', 'success', $data, $msg = 'Orden actualizada correctamente.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order, Request $request)
    {
        if ($order->param_state != 1652) {
            $order->param_state = 1652;
            $order->save();
            $data[] = $order;
            return OS::frontendResponse('200', 'success', $data, $msg = 'La orden se ha desactivado correctamente.');
        } else {
            return OS::frontendResponse('404', 'error', [], $msg = 'La orden ya se encuentra inactiva.');
        }
    }

    public function statusShopping(Order $order, Request $request)
    {
        if ($order->param_state != 1652) {
            $order->param_state = 1652;
            $order->save();
            $data[] = $order;
            return OS::frontendResponse('200', 'success', $data, $msg = 'La orden se ha desactivado correctamente.');
        } else {
            return OS::frontendResponse('404', 'error', [], $msg = 'La orden ya se encuentra inactiva.');
        }
    }



    public function shoppingCardCreate(Order $order, Request $request)
    {

        $orderexist = Order::where('user_id', $request->user_id)->where('param_status', 1701)->get();

        if (!$orderexist) {
        }

        // if ($idParam >= $typeParam->range_min && $idParam <= $typeParam->range_max) {

        //     $param = new Param;
        //     $param->id = $idParam ;
        //     $param->paramtype_id = $typeParam-> id;
        //     $param->name = $request->name;
        //     $param->param_foreign = $request->param_foreign;
        //     $param->param_state = $request->param_state;
        //     $param->save(); // save
        //     $data[] = $param;

        //     return OS::frontendResponse('200', 'success', $data, 'Parametro creado correctamente.');
        // } else {
        //     return OS::frontendResponse('400', 'error', [], 'Parametro no creado correctamente(no hay espacio dentro de los parametros)');
        // }

        $order = new Order;
        $order->user_id = $request->user_id;
        $order->code = $request->code;
        $order->date = $request->date;
        $order->total = $request->total;
        $order->param_paymethod = $request->param_paymethod;
        $order->param_status = $request->param_status;
        $order->param_state = $request->param_state;
        $order->save();    // save
        $data[] = $order;
        if ($data == null) {
            return OS::frontendResponse('404', 'error',  $data, $msg = 'Orden no creada.');
        } else {
            return OS::frontendResponse('200', 'success', $data, $msg = 'Orden creada correctamente.');
        }

        //   payment = Param::where('paramtype_id', '16')->get();
    }



    public function shoppingCardUpdate(Order $order)
    {
        if ($order->param_status = 1701) {
            $order->param_state = 1700;
            $order->save();
            $data[] = $order;
            return OS::frontendResponse('200', 'success', $data, $msg = 'La orden se ha desactivado correctamente.');
        } else {
            return OS::frontendResponse('404', 'error', [], $msg = 'La orden ya se encuentra inactiva.');
        }
    }



    public function showCard(Order $order)
    {
    }
}
