<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ServiceController as OS;
use GuzzleHttp\Psr7\Message;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Param;
use App\Models\OrderDetail;
use App\Models\Product;

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
    $user_id = $request->user_id;
    $product_ids = $request->input('product_ids', []); // Obtener un arreglo de IDs de productos
    $param_state = $request->param_state;

    $data = []; // Para almacenar los detalles de órdenes creados

    // Crear una nueva orden si no existe una orden existente para el usuario
    $existingOrder = Order::where('user_id', $user_id)
        ->where('param_status', 1701) // Ajusta el estado según tus necesidades
        ->first();

    if (!$existingOrder) {
        $newOrder = new Order();
        $newOrder->user_id = $user_id;
        $newOrder->code = $request->code;
        $newOrder->date = $request->date;
        $newOrder->total = $request->total;
        $newOrder->param_paymethod = $request->param_paymethod;
        $newOrder->param_status = 1701; // Ajusta el estado según tus necesidades
        $newOrder->param_state = $param_state;
        $newOrder->save();
    } else {
        $newOrder = $existingOrder;
    }

    foreach ($product_ids as $product_id) {
        // Verificar si ya existe un OrderDetail con el mismo product_id en la orden actual
        $existingOrderDetail = OrderDetail::where('o_id', $newOrder->id)
            ->where('product_id', $product_id)
            ->first();

        if ($existingOrderDetail) {
            // Si ya existe, actualiza la cantidad (qty) y el subtotal
            $existingOrderDetail->qty += $request->qty; // Ajusta la cantidad según tus necesidades
            $existingOrderDetail->subtotal += $request->subtotal; // Ajusta el subtotal según tus necesidades
            $existingOrderDetail->save();
            $data[] = $existingOrderDetail;
        } else {
            // Si no existe, crea un nuevo OrderDetail
            $orderDetail = new OrderDetail();
            $orderDetail->o_id = $newOrder->id;
            $orderDetail->product_id = $product_id;
            $orderDetail->qty = $request->qty; // Ajusta la cantidad según tus necesidades
            $orderDetail->subtotal = $request->subtotal; // Ajusta el subtotal según tus necesidades
            $orderDetail->param_state = $param_state;
            $orderDetail->save();
            $data[] = $orderDetail;
        }
    }

    //puede servir despues: 
    // Recalcula el total sumando los subtotales de todos los detalles de orden
    // $totalValue = $newOrder->orderDetails->sum('subtotal');
    // $newOrder->total = $totalValue;
    // $newOrder->save();

    return OS::frontendResponse('200', 'success', $data, 'Detalles de orden creados o actualizados.');
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

    public function showshopping(Request $request, Order $order, OrderDetail $orderDetail){
        
            // Obtener el ID del usuario de la solicitud
            $userId = $request->user_id;
        
            // Buscar todas las órdenes del usuario que coinciden con el param_status igual a 1701
            $orders = $order->where('user_id', $userId)
                            ->where('param_status', 1701)
                            ->get();
        
            if ($orders->isEmpty()) {
                // Si no se encuentran órdenes que cumplan con los criterios, devuelve un mensaje de error
                return OS::frontendResponse('404', 'error', null, 'El usuario no tiene órdenes con estado 1701.');
            }
        
            $totalQty = 0;      // Variable para la suma total de qty
            $totalSubtotal = 0; // Variable para la suma total de subtotal
        
            $orderDetails = [];
        
            // Iterar a través de las órdenes encontradas
            foreach ($orders as $order) {
                // Obtener todas las OrderDetail asociadas a esa orden
                $details = $orderDetail->where('o_id', $order->id)->get();
        
                // Verificar si el `o_id` coincide con el `product_id` y obtener el producto correspondiente
                $products = [];
                foreach ($details as $detail) {
                    $product = Product::find($detail->product_id);
                    if ($product) {
                        $products[] = $product;
                    }
                    $totalQty += $detail->qty;
                    $totalSubtotal += $detail->subtotal;
                }
        
                // Agregar los detalles de la orden y los productos al arreglo
                $orderDetails[] = [
                    'details' => $details,
                    'products' => $products,
                ];
            }
        
            // Devolver la respuesta con los detalles de las órdenes encontradas, el total de qty y el total de subtotal
            $response = [
                'orderDetails' => $orderDetails,
                'totalQty' => $totalQty,
                'totalSubtotal' => $totalSubtotal,
            ];
        
            return OS::frontendResponse('200', 'success', $response, 'Detalles de las órdenes con estado 1701 y totales.');
        }
        
    
    

    public function showOrders(Request $request)
    { 
        // Obtener el código del Request
        $code = $request->input("code");
    
       
        // Buscar todas las órdenes cuyo código coincide con el código proporcionado
        $orders = Order::where("code", $code)->get();
       
        if ($orders->isEmpty()) {
            // Si no se encuentra ninguna coincidencia, retornar un mensaje de error
            return OS::frontendResponse("404", "error", [], "Orden no encontrada.");
        }
    
        // Inicializar una variable para almacenar el estado de la orden encontrada
        $paramStatus = null;
    
        // Recorrer todas las órdenes para encontrar el estado de la orden
        foreach ($orders as $order) {
            $statusId = $order->param_status;
            $paramStatus = Order::find($statusId);
    

            if ($paramStatus) {
                // Si se encuentra el estado de la orden, salir del bucle
                break;
            }
        }
        $data[]=$statusId;

        if ($statusId) {
            // Si se encuentra el ParamStatus, retornar como respuesta
            return OS::frontendResponse("200", "success", $data, "Estado de la orden encontrado correctamente.");
        } else {
            // Si no se encuentra el ParamStatus, retornar un mensaje de error
            return OS::frontendResponse("404", "error", [], "ParamStatus no encontrado.");
        }
    }
    
    
    
}