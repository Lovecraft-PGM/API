<?php

namespace App\Http\Controllers;
use App\Http\Controllers\ServiceController as OS;
use Illuminate\Http\Request;
use App\Models\paramType;

class paramTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $paramTypes = paramType::all()->sortBy('id');

        foreach ($paramTypes as $paramType){
        $paramType['name'] = $paramType -> name ;
        $paramType['range_min']= $paramType ->range_min ;
        $paramType['range_max'] = $paramType -> range_max  ;
        $data[] = $paramType; 
    }
    if (count($paramTypes) == null) {
        $data = $paramTypes;
        return OS::frontendResponse('404', 'error',  $data,  'Tipo de Parametro no encontrado.' );
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
      
        $paramType=new paramType;   
        $paramType->name = $request -> name ;
        $paramType->range_min= $request ->range_min ;
        $paramType->range_max = $request -> range_max  ;
        $paramType-> save ();    // save
        $data[] = $paramType;
        if ($data == null) {
            return OS::frontendResponse('404', 'error',  $data, 'Tipo de Parametro no creado.' );
        }else{
            return OS::frontendResponse('201','success', $data, 'Tipo de Parametro creado correctamente.'); 
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(paramType $paramType)
    {

            $data[] = $paramType;
        if ($data == null) {
            return OS::frontendResponse('404', 'error',  $data, 'tipos de parametros no encontrados.' );
        }else{
            return OS::frontendResponse('200','success', $data, ' tipos de parametros Parametros encontrados.'); 
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
    public function update(Request $request, paramType $paramType)
    {
        $paramType->name = $request -> name ;
        $paramType->range_min= $request ->range_min ;
        $paramType->range_max = $request -> range_max  ;
        $paramType-> save ();    // save
        $data[] = $paramType;
        if ($data == null) {
            return OS::frontendResponse('404', 'error',  $data, 'Tipo de Parametro no Actualizado.' );
        }else{
            return OS::frontendResponse('201','success', $data, 'Tipo de Parametro Actualizado correctamente.'); 
        }
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(paramType $paramType)
    {
          $paramType->delete();
          $data[] = $paramType;
          return OS::frontendResponse('200','success', $data, 'Tipo de Parametro eliminado'); 
    }
}
