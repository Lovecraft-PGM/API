<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ServiceController as OS;
use Illuminate\Http\Request;
use App\Models\Provider;
use App\Models\Param;

class ProviderController extends Controller

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

        $providers = provider::all()->sortBy('id');

        foreach ($providers as $provider) {
            $provider['legal_name'] = $provider->legal_name;
            $provider['commercial_name'] = $provider->commercial_name;
            $provider['email'] = $provider->email;
            $provider['phone'] = $provider->phone;
            $provider['address'] = $provider->address;
            $provider['param_city'] = $this->getParamName($provider->param_city);
            $provider['name_contact'] = $provider->name_contact;
            $provider['param_bank'] = $this->getParamName($provider->param_bank);
            $provider['param_account'] = $this->getParamName($provider->param_account);
            $provider['account'] = $provider->account;
            $provider['param_state'] = $this->getParamName($provider->param_state);
            $data[] = $provider;
        }
        if (count($providers) == null) {
            $data = $providers;
            return OS::frontendResponse('404', 'error',  $data, $msg = 'Proveedores no encontrados.');
        } else {
            return OS::frontendResponse('200', 'success', $data, $msg = 'Prooveedores encontrados.');
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
        // Verificar si ya existe un proveedor con el mismo correo electrónico o número de teléfono en la base de datos
        $existingProvider = Provider::where('email', $request->email)
                                    ->orWhere('phone', $request->phone)
                                    ->first();
    
        if ($existingProvider) {
            return OS::frontendResponse('400', 'error', null, 'El proveedor con este correo electrónico o número de teléfono ya existe.');
        }
    
        // Si el proveedor no existe, crea un nuevo proveedor
        $provider = new Provider;
        $provider->legal_name = $request->legal_name;
        $provider->commercial_name = $request->commercial_name;
        $provider->email = $request->email;
        $provider->phone = $request->phone;
        $provider->address = $request->address;
        $provider->param_city = $request->param_city;
        $provider->name_contact = $request->name_contact;
        $provider->param_bank = $request->param_bank;
        $provider->param_account = $request->param_account;
        $provider->account = $request->account;
        $provider->param_state = $request->param_state;
    
        $provider->save();
    
        return OS::frontendResponse('200', 'success', $provider, 'Proveedor creado correctamente');
    }
    /**
     * Display the specified resource.
     */
    public function show(Provider $provider)
    {

        $data[] = $provider;
        if ($data == null) {
            return OS::frontendResponse('404', 'error',  $data, $msg = 'Proveedor no encontrado.' );
        }else{
            return OS::frontendResponse('200','success', $data, $msg = 'Proveedor encontrado.'); 
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
    public function update(Request $request, Provider $provider)
    {
        $provider->legal_name = $request->legal_name;
        $provider->commercial_name = $request->commercial_name;
        $provider->email = $request->email;
        $provider->phone = $request->phone;
        $provider->address = $request->address;
        $provider->param_city = $request->param_city;
        $provider->name_contact = $request->name_contact;
        $provider->param_bank = $request->param_bank;
        $provider->param_account = $request->param_account;
        $provider->account = $request->account;
        $provider->param_state = $request->param_state;
        $provider->save();    // save
        $data[] = $provider;
        return OS::frontendResponse('200', 'success', $data, $msg = 'Proveedor actualizado');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Provider $provider, Request $request)
    {
        if ($provider->param_state != 1652) {
            $provider->param_state = 1652;
            $provider->save();
            $data[] = $provider;
            return OS::frontendResponse('200', 'success', $data, $msg = 'El proveedor se ha desactivado correctamente.');
        } else {
            return OS::frontendResponse('404', 'error', [], $msg = 'El proveedor ya se encuentra inactivo.');
        }
    }
}
