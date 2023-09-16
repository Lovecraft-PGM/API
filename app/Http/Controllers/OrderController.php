<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ServiceController as OS;
use GuzzleHttp\Psr7\Message;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Param;
use App\Models\OrderDetail;

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
            // Crear una nueva orden
            $newOrder = new Order();
            $newOrder->user_id = $request->user_id;
            $newOrder->code = $request->code;
            $newOrder->date = $request->date;
            $newOrder->total = $request->total;
            $newOrder->param_paymethod = $request->param_paymethod;
            $newOrder->param_status = 1701; // Esto puede variar según tu lógica
            $newOrder->param_state = $request->param_state;
            $newOrder->save();

            // Crear un nuevo detalle de orden y relacionarlo con la orden
            $orderDetail = new OrderDetail();
            $orderDetail->o_id = $newOrder->id; // Asignar el ID de la nueva orden
            $orderDetail->product_id = $request->product_id;
            $orderDetail->qty = $request->qty;
            $orderDetail->subtotal = $request->subtotal;
            $orderDetail->param_state = $request->param_state;
            $orderDetail->save();

            $data = [
                'order' => $newOrder,
                'orderDetail' => $orderDetail,
            ];

            return OS::frontendResponse('200', 'success', $data, 'Detalle de orden creado.');
        } else {
            // Si la orden ya existe, crea un nuevo detalle de orden asociado a esa orden
            $existingOrder = Order::find($orderexist); // Suponiendo que $orderexist es el ID de la orden existente

            if ($existingOrder) {
                $orderDetail = new OrderDetail();
                $orderDetail->o_id = $existingOrder->id; // Asignar el ID de la orden existente
                $orderDetail->product_id = $request->product_id;
                $orderDetail->qty = $request->qty;
                $orderDetail->subtotal = $request->subtotal;
                $orderDetail->param_state = $request->param_state;
                $orderDetail->save();

                $data = [
                    'order' => $existingOrder,
                    'orderDetail' => $orderDetail,
                ];

                return OS::frontendResponse('200', 'success', $data, 'Detalle de orden creado para la orden existente.');
            } else {
                return OS::frontendResponse('404', 'error', null, 'Orden existente no encontrada.');
            }
        }
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

    public function showcarrito(Request $request, Order $order, OrderDetail $orderDetail)
    {
        // Obtener el ID del usuario de la solicitud
        $userId = $request->user_id;

        // Buscar todas las órdenes del usuario
        $orders = $order->where('user_id', $userId)->get();

        if ($orders->isEmpty()) {
            // Si el usuario no tiene órdenes, puedes devolver un mensaje de error
            return OS::frontendResponse('404', 'error', null, 'El usuario no tiene órdenes.');
        }

        $orderDetails = [];
        $totalValue = 0;
        $totalQuantity = 0;

        // Iterar a través de las órdenes del usuario
        foreach ($orders as $order) {
            // Verificar si la orden tiene el estado de carrito
            if ($order->param_state === 'carrito') {
                // Si la orden está en estado de carrito, obtener todas las OrderDetail asociadas a esa orden
                $details = $orderDetail->where('o_id', $order->id)->get();

                // Sumar el valor de los detalles de la orden y la cantidad total
                foreach ($details as $detail) {
                    $totalValue += $detail->subtotal;
                    $totalQuantity += $detail->qty;
                }

                // Agregar los detalles de la orden al arreglo
                $orderDetails[] = $details;
            }
        }

        // Filtrar los detalles de la orden que tienen elementos
        $filteredOrderDetails = array_filter($orderDetails, function ($details) {
            return !$details->isEmpty();
        });

        // Comprobar si se encontraron detalles de orden en estado de carrito
        if (empty($filteredOrderDetails)) {
            return OS::frontendResponse('200', 'success', null, 'El usuario no tiene detalles de órdenes en estado de carrito.');
        }

        // Construir una respuesta con todas las órdenes del usuario, los detalles de las órdenes en estado de carrito, el total y la cantidad
        $data = [
            'orders' => $orders,
            'orderDetails' => $filteredOrderDetails,
            'totalValue' => $totalValue,
            'totalQuantity' => $totalQuantity,
        ];

        return OS::frontendResponse('200', 'success', $data, 'Detalles de órdenes en estado de carrito encontrados.');
    }


    public function showorders(Request $request)
{ 
    // Obtener el código del Request
    $code = $request->input('code');

    // Buscar todas las órdenes cuyo código coincide con el código proporcionado
    $orders = Order::where('code', $code)->get();

    if ($orders->isEmpty()) {
        // Si no se encuentra ninguna coincidencia, retornar un mensaje de error
        return response()->json(['message' => 'Orden no encontrada.'], 404);
    }

    // Obtener el estado de la primera orden encontrada (asumiendo que hay solo una coincidencia)
    $firstOrder = $orders->first();
    $statusId = $firstOrder->param_status;

    // Buscar el ParamStatus correspondiente al estado (status)
    $paramStatus = Order::find($statusId);

    if ($paramStatus) {
        // Si se encuentra el ParamStatus, retornar como respuesta
        return response()->json($paramStatus, 200);
    } else {
        // Si no se encuentra el ParamStatus, retornar un mensaje de error
        return response()->json(['message' => 'ParamStatus no encontrado.'], 404);
    }
}
    
    
}