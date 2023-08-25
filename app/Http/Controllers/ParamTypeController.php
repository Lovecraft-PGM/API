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
        $paramtypes = ParamType::all()->sortBy('id');

        foreach ($paramtypes as $paramtype){
        $paramtype['name'] = $paramtype -> name ;
        $paramtype['range_min']= $paramtype ->range_min ;
        $paramtype['range_max'] = $paramtype -> range_max  ;
        $data[] = $paramtype; 
    }
    if (count($paramtypes) == null) {
        $data = $paramtypes;
        return OS::frontendResponse('404', 'error',  $data, $msgError = 'Tipo de Parametro no encontrado.' );
    }else{
        return OS::frontendResponse('200','success', $data, null); 
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
      
        $paramtype=new ParamType;   
        $paramtype->name = $request -> name ;
        $paramtype->range_min= $request ->range_min ;
        $paramtype->range_max = $request -> range_max  ;
        $paramtype-> save ();    // save
        $data[] = $paramtype;
        if ($data == null) {
            return OS::frontendResponse('404', 'error',  $data, 'Tipo de Parametro no creado.' );
        }else{
            return OS::frontendResponse('201','success', $data, 'Tipo de Parametro creado correctamente.'); 
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(ParamType $paramtype)
    {
        $data[] = $paramtype;
        if ($data == null) {
            return OS::frontendResponse('404', 'error',  $data, 'Tipos de Parametros  no encontrados.' );
        }else{
            return OS::frontendResponse('200','success', $data, 'Tipos de Parametros encontrados.'); 
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
    public function update(Request $request, ParamType $paramtype)
    {
        $paramtype->name = $request -> name ;
        $paramtype->range_min= $request ->range_min ;
        $paramtype->range_max = $request -> range_max  ;
        $paramtype-> save ();    // save
        $data[] = $paramtype;
        if ($data == null) {
            return OS::frontendResponse('404', 'error',  $data, 'Tipo de Parametro no Actualizado.' );
        }else{
            return OS::frontendResponse('201','success', $data, 'Tipo de Parametro Actualizado correctamente.'); 
        }
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ParamType $paramtype)
    {
          $paramtype->delete();
          $data[] = $paramtype;
          return OS::frontendResponse('200','success', $data, 'Tipo de Parametro eliminado'); 
    }
}
