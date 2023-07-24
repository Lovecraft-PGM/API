<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rating;

class RatingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rating = Rating ::all() ; 
        return response()->json($rating) ;
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
        $rating-> save ();    // save
        $data=[
          'message' => 'Rating created successfully',
          'Rating' => $rating,
        ];
        return response()->json($data);
    }

    /**
     * Display the specified resource.
     */
    public function show(Rating $rating)
    {
        return response()->json($rating);
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
        $data=[
          'message' => 'Orderdetail update successfully',
          'orderdetail' => $rating,
        ];
        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Rating $rating)
    {
        $rating->delete();
        $data = [
            'message' => 'orders deleted successfully',
            'order' => $rating
        ];
        return response()->json($rating);
    }
}
