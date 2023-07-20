<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProviderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $provider = Provider ::all() ; 
        return response()->json($provider) ;
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
        $provider=new Provider;   
        $provider->namelegal = $request -> namelegal ;
        $provider->namecommercial= $request ->namecommercial ;
        $provider->email= $request-> email  ;
        $provider->phone= $request-> phone  ;
        $provider->address= $request-> address  ;
        $provider->name_contact= $request-> name_contact  ;
        $provider->param_city= $request-> param_city   ;
        $provider->param_bank= $request-> param_bank   ;
        $provider->param_account= $request-> param_account    ;
        $provider->param_gender= $request-> param_gender   ;
        $provider->param_subcategory= $request -> param_subcategory   ;
        $provider->account= $request-> account    ;
        $provider->param_state= $request->param_state;
        $provider-> save ();    // save
        $data=[
          'message' => 'Orderdetail created successfully',
          'orderdetail' => $provider,
        ];
        return response()->json($data);
    }

    /**
     * Display the specified resource.
     */
    public function show(Provider $provider)
    {
        return response()->json($provider);
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
    public function update(Request $request, Provider $provider)
    {
        $provider->namelegal = $request -> namelegal ;
        $provider->namecommercial= $request ->namecommercial ;
        $provider->email= $request-> email  ;
        $provider->phone= $request-> phone  ;
        $provider->address= $request-> address  ;
        $provider->name_contact= $request-> name_contact  ;
        $provider->param_city= $request-> param_city   ;
        $provider->param_bank= $request-> param_bank   ;
        $provider->param_account= $request-> param_account    ;
        $provider->param_gender= $request-> param_gender   ;
        $provider->param_subcategory= $request -> param_subcategory   ;
        $provider->account= $request-> account    ;
        $provider->param_state= $request->param_state;
        $provider-> save ();    // save
        $data=[
          'message' => 'Orderdetail update successfully',
          'orderdetail' => $provider,
        ];
        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Provider $provider)
    {
        $provider->delete();
        $data = [
            'message' => 'orders deleted successfully',
            'order' => $provider
        ];
        return response()->json($provider);
    }
}
