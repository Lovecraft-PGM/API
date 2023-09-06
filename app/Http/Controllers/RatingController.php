<?php

namespace App\Http\Controllers;
use App\Http\Controllers\ServiceController as OS;
use Illuminate\Http\Request;
use App\Models\Rating;

class RatingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ratings = Rating::all()->sortBy('id');
        
        foreach ($ratings as $rating){
        $rating['user_id']  = $rating -> user_id ;
        $rating['product_id'] = $rating ->product_id ;
        $rating['starts']= $rating-> starts  ;
        $rating['comments']= $rating-> comments  ;
        $rating['param_state']= $rating-> param_state  ;
        $data[] = $rating; 
    }
    if (count($ratings) == null) {
        $data = $ratings;
        return OS::frontendResponse('404', 'error',  $data, $msg = 'No encontrado.' );
    }else{
        return OS::frontendResponse('200','success', $data, $msg = 'Encontrado.'); 
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
        $rating=new Rating;   
        $rating->user_id  = $request -> user_id ;
        $rating->product_id = $request ->product_id ;
        $rating->starts= $request-> starts  ;
        $rating->comments= $request-> comments  ;
        $rating->param_state= $request-> param_state  ;
        $rating->save(); 
        $data[] = $rating;
        if ($data == null) {
            return OS::frontendResponse('404', 'error',  $data, $msg = 'Rating no creado.' );
        }else{
            return OS::frontendResponse('200','success', $data, $msg = 'Rating creado correctamente.'); 
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Rating $rating)
    {
        $data[] = $rating;
        if ($data == null) {
            return OS::frontendResponse('404', 'error',  $data, $msg = 'Ratings no encontrados.' );
        }else{
            return OS::frontendResponse('200','success', $data, $msg = 'Ratings encontrados.'); 
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
    public function update(Request $request, Rating $rating)
    {
        $rating->user_id  = $request -> user_id ;
        $rating->product_id = $request ->product_id ;
        $rating->starts= $request-> starts  ;
        $rating->comments= $request-> comments  ;
        $rating->param_state= $request-> addrparam_stateess  ;
        $rating-> save ();    // save
        $data[]= $rating;
        if ($data == null) {
            return OS::frontendResponse('404', 'error',  $data, $msg = 'Rating no Actualizado.' );
        }else{
            return OS::frontendResponse('200','success', $data, $msg = 'Rating Actualizado correctamente.'); 
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Rating $rating, Request $request)
    {
        $rating = Rating::find($request->id);

        if ($rating->param_state != 1652) {

            $param_state = $rating->param_state;
            $rating->param_state = 1652;
            $rating->save();
            $data[] = $rating;
            return OS::frontendResponse('200', 'success', $data, $msg = 'Usuario desactivado correctamente.');
        }else{
            return OS::frontendResponse('400', 'error', [], $msg = 'El usuario ya se encuentra inactivo.');
        }
    }
}
