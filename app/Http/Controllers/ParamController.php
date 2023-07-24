<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Param;
class ParamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $param = Param::all() ; 
        return response()->json($param) ;
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
        $param=new Param;   
        $param->paramtype_id = $request -> paramtype_id ;
        $param->name= $request ->name ;
        $param->param_foreign = $request -> param_foreign  ;
        $param->param_state= $request ->param_state;
        $param-> save ();    // save
        $data=[
          'message' => 'Param created successfully',
          'Param' => $param,
        ];
        return response()->json($data);
  
    }

    /**
     * Display the specified resource.
     */
    public function show(Param $param)
    {
        return response()->json($param);
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
    public function update(Request $request, Param $param)
    {
        $param=new Param;   
        $param->paramtype_id = $request -> paramtype_id ;
        $param->name= $request ->name ;
        $param->param_foreign = $request -> param_foreign  ;
        $param->param_state= $request ->param_state;
        $param-> save ();    // save
        $data=[
          'message' => 'Orderdetail update successfully',
          'orderdetail' => $param,
        ];
        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Param $param)
    {
        $param->delete();
        $data = [
            'message' => 'orders deleted successfully',
            'order' => $param
        ];
        return response()->json($data);
    }
}
