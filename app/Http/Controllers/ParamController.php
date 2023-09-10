<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ServiceController as OS;
use Illuminate\Http\Request;
use App\Models\Param;


class ParamController extends Controller
{
    public function orderList($params)
    {
        foreach ($params as $param) {
            $data_param = [
                'id' => $param->id,
                'name' => $param->name,
                'typeParam' => $param->param_id,
            ];

            $data[] = $data_param;
        }

        if (!empty($data)) {
            return OS::frontendResponse('200', 'success', $data, $msg = 'Parametros no encontrados.');
        } else {
            return OS::frontendResponse('404', 'error', $data, $msg = 'Parametros no encontrados.');
        }
    }



    public function countriesList()
    {
        $countries = Param::where('param_id', '1')->get();

        return $this->orderList($countries);
    }

    public function departmentsList()
    {
        $departments = Param::where('param_id', '2')->get();

        return $this->orderList($departments);
    }

    public function citiesList()
    {
        $cities = Param::where('param_id', '14')->get();

        return $this->orderList($cities);
    }

    public function typesOfUsersList()
    {
        $typesUsers = Param::where('param_id', '3')->get();

        return $this->orderList($typesUsers);
    }

    public function rolesList()
    {
        $roles = Param::where('param_id', '15')->get();

        return $this->orderList($roles);
    }

    public function statesList()
    {
        $states = Param::where('param_id', '9')->get();

        return $this->orderList($states);
    }

    public function banksList()
    {
        $banks = Param::where('param_id', '11')->get();

        return $this->orderList($banks);
    }

    public function typesOfBankAccountsList()
    {
        $bankAccounts = Param::where('param_id', '12')->get();

        return $this->orderList($bankAccounts);
    }

    public function sizesList()
    {
        $sizes = Param::where('param_id', '6')->get();

        return $this->orderList($sizes);
    }

    public function genderList()
    {
        $genders = Param::where('param_id', '7')->get();

        return $this->orderList($genders);
    }

    public function categoriesList()
    {
        $categories = Param::where('param_id', '5')->get();

        return $this->orderList($categories);
    }

    public function subcategoriesList()
    {
        $subcategories = Param::where('param_id', '13')->get();

        return $this->orderList($subcategories);
    }

    public function marksList()
    {
        $marks = Param::where('param_id', '4')->get();

        return $this->orderList($marks);
    }

    public function colorsList()
    {
        $colors = Param::where('param_id', '8')->get();

        return $this->orderList($colors);
    }

    public function paymentMethodsList()
    {
        $payment = Param::where('param_id', '16')->get();

        return $this->orderList($payment);
    }

    public function typesOfordersList()
    {
        $orders = Param::where('param_id', '10')->get();

        return $this->orderList($orders);
    }

    public function index()
    {


        $params = Param::all()->sortBy('id');

        foreach ($params as $param) {
            $param['param_id'] = $param->param_id;
            $param['name'] = $param->name;
            $param['param_foreign'] = $param->param_foreign;
            $param['param_state'] = $param->param_state;
            $data[] = $param;
        }
        if ($data == null) {
            return OS::frontendResponse('404', 'error', $data, $msg = 'Parametros no encontrados.');
        } else {
            return OS::frontendResponse('200', 'success', $data, $msg = 'Parametros encontrados.');
        }
    }

    public function create()
    {
        //
    }

    public function store(Request $request )
    {

        $typeParam = Param::find($request->paramId);
        $lastParamId = Param::where('param_id', $typeParam->id)->max('id');
        $idParam = $lastParamId + 1;

        if ($idParam >= $typeParam->range_min && $idParam <= $typeParam->range_max) {

            $param = new Param;
            $param->id = $idParam ;
            $param->param_id = $typeParam-> id;
            $param->name = $request->name;
            $param->param_foreign = $request->param_foreign;
            $param->param_state = $request->param_state;
            $param->save(); // save
            $data[] = $param;

            return OS::frontendResponse('200', 'success', $data, $msg ='Parametro creado correctamente.');
        } else {
            return OS::frontendResponse('404', 'error', [], $msg = 'Parametro no creado correctamente (no hay espacio dentro de los parametros)');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Param $param)
    {
        $data[] = $param;
        if ($data == null) {
            return OS::frontendResponse('404', 'error', $data, $msg = 'Parametros no encontrados.');
        } else {
            return OS::frontendResponse('200', 'success', $data, $msg = 'Parametros encontrados.');
        }
    }


    public function edit(string $id)
    {
        //
    }


    public function update(Request $request, Param $param)
    {

        $param->param_id = $request->param_id;
        $param->name = $request->name;
        $param->param_foreign = $request->param_foreign;
        $param->param_state = $request->param_state;
        $param->save(); // save
        $data[] = $param;
        if (!empty($data)) {
        return OS::frontendResponse('200', 'success', $data, $msg = 'Parametro actualizado correctamente.');

        }else{

        return OS::frontendResponse('404', 'error', $data=[], $msg = 'Parametro no actualizado.');
        }

    }


    public function destroy(Param $param)
    {
        if ($param->param_state != 1652) {
            $param->param_state = 1652;
            $param->save();
            $data[] = $param;
            return OS::frontendResponse('200', 'success', $data, $msg = 'Parametro se desactivado correctamente.');
        }else{
            return OS::frontendResponse('404', 'error', [], $msg = 'El parametro ya se encuentra inactivo.');
        } 
    }
}
