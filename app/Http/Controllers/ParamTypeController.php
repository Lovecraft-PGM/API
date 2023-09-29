<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ServiceController as OS;
use Illuminate\Http\Request;
use App\Models\ParamType;
use App\Models\Param;

class ParamTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    
    public function index()
    {
        $paramTypes = ParamType::all()->sortBy('id');

        foreach ($paramTypes as $paramType) {
            $paramType['name'] = $paramType->name;
            $paramType['range_min'] = $paramType->range_min;
            $paramType['range_max'] = $paramType->range_max;
            $data[] = $paramType;
        }
        if (count($paramTypes) == null) {
            $data = $paramTypes;
            return OS::frontendResponse('404', 'error',  $data,  $msg = 'Tipos de Parametros no encontrado.');
        } else {
            return OS::frontendResponse('200', 'success', $data, $msg = 'Tipos de Parametros no encontrado');
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
    // Verificar si ya existe un tipo de parámetro con el mismo nombre en la base de datos
    $existingParamType = ParamType::where('name', $request->name)->first();

    if ($existingParamType) {
        $data[] = null;
        return OS::frontendResponse('400', 'error', $data, 'El tipo de parámetro con este nombre ya existe.');
    }

    $lastRangeMax = ParamType::max('range_max') + 1;
    $lastId = ParamType::latest('id')->first()->id;
    $newId = $lastId + 1;

    $paramType = new ParamType;
    $paramType->id = $newId;
    $paramType->name = $request->name;
    $paramType->range_min = $lastRangeMax;
    $paramType->range_max = $lastRangeMax + $request->input('amount');

    if ($paramType->save()) {
        $data[] = $paramType;
        return OS::frontendResponse('200', 'success', $data, 'Tipo de Parametro creado correctamente.');
    } else {
        $data[] = null;
        return OS::frontendResponse('404', 'error', $data, 'Tipo de Parametro no creado.');
    }
}
    /**
     * Display the specified resource.
     */
    public function show(ParamType $paramType)
    {

        $data[] = $paramType;
        if ($data == null) {
            return OS::frontendResponse('404', 'error',  $data, $msg = 'Tipo de parametro no encontrado.');
        } else {
            return OS::frontendResponse('200', 'success', $data, $msg = 'Tipo de parametro encontrado.');
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
    public function update(Request $request, ParamType $paramType)
    {
        $paramType->name = $request->name;
        $paramType->range_min = $request->range_min;
        $paramType->range_max = $request->range_max;
        $paramType->save();    // save
        $data[] = $paramType;
        if ($data == null) {
            return OS::frontendResponse('404', 'error',  $data,  $msg = 'Tipo de Parametro no Actualizado.');
        } else {
            return OS::frontendResponse('200', 'success', $data,  $msg = 'Tipo de Parametro Actualizado correctamente.');
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ParamType $paramType){
        if ($paramType->param_state != 1652) {
            $paramType->param_state = 1652;
            $paramType->save();
            $data[] = $paramType;
            return OS::frontendResponse('200', 'success', $data,  $msg = 'Usuario se desactivado correctamente.');
        }else{
            return OS::frontendResponse('404', 'error', [],  $msg = 'El usuario ya se encuentra inactivo.');
        } 
    }
}
