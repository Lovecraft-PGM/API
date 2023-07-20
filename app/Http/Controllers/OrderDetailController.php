<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orderdetail = Orderdetail::all() ; 
        return response()->json($orderdetail) ;
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
        $orderdetail=new Orderdetail;
        $orderdetail->o_id= $request -> o_id ;
        $orderdetail->product_id= $request ->product_id ;
        $orderdetail->qty= $request -> qty  ;
        $orderdetail->subtotal=$request ->subtotal;
        $orderdetail->param_state= $request ->param_state;
        $orderdetail-> save ();    // save
        $data=[
          'message' => 'Orderdetail created successfully',
          'orderdetail' => $orderdetail,
        ];
        return response()->json($data);
  
    }

    /**
     * Display the specified resource.
     */
    public function show(Orderdetail $orderdetail)
    {
        return response()->json($orderdetail);
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
    public function update(Request $request, Orderdetail $orderdetail)
    {
        $orderdetail=new Orderdetail;
        $orderdetail->o_id= $request -> o_id ;
        $orderdetail->product_id= $request ->product_id ;
        $orderdetail->qty= $request -> qty  ;
        $orderdetail->subtotal=$request ->subtotal;
        $orderdetail->param_state= $request ->param_state;
        $orderdetail-> save ();    // save
        $data=[
          'message' => 'Orderdetail update successfully',
          'orderdetail' => $orderdetail,
        ];
        return response()->json($data);
  
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Orderdetail $orderdetail)
    {
        $orderdetail->delete();
        $data = [
            'message' => 'orders deleted successfully',
            'order' => $orderdetail
        ];
        return response()->json($data);
    }
}
