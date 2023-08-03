<?php

namespace App\Http\Controllers;
use App\Http\Controllers\ServiceController as OS;
use Illuminate\Http\Request;
use App\Models\ParamType;

class ParamTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $paramtypes = Paramtype::all()->sortBy('id');
        foreach ($paramtypes as $paramtype){

        $paramtype['name'] = $paramtype -> name ;
        $paramtype['range_min']= $paramtype ->range_min ;
        $paramtype['range_max'] = $paramtype -> range_max  ;
        $data[] = $paramtype; 
    }
    return OS::frontendResponse('200','success', $data, null); 

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
      
        $paramtype=new Paramtype;   
        $paramtype->name = $request -> name ;
        $paramtype->range_min= $request ->range_min ;
        $paramtype->range_max = $request -> range_max  ;
        $paramtype-> save ();    // save
        $data=[
          'message' => 'ParamType created successfully',
          'ParamType' => $paramtype,
        ];
        return response()->json($data);
    }

    /**
     * Display the specified resource.
     */
    public function show(Paramtype $paramtype)
    {
       return response()->json($paramtype);
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
    public function update(Request $request, Paramtype $paramtype)
    {
        $paramtype->name = $request -> name ;
        $paramtype->range_min= $request ->range_min ;
        $paramtype->range_max = $request -> range_max  ;
        $paramtype-> save ();    // save
        $data=[
          'message' => 'Orderdetail update successfully',
          'orderdetail' => $paramtype,
        ];
        return response()->json($data);
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Paramtype $paramtype)
    {
          $paramtype->delete();
        $data = [
            'message' => 'orders deleted successfully',
            'order' => $paramtype
        ];
        return response()->json($data);
    }
}
