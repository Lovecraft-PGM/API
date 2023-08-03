<?php

namespace App\Http\Controllers;
use App\Http\Controllers\ServiceController as OS;


use Illuminate\Http\Request;
use App\Models\Product;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all()->sortBy('id');
        foreach ($products as $product){
        $product['reference'] = $product->reference;
        $product['name']= $product->name;
        $product['description' ]= $product->description;     
        $product['stock']= $product->stock;
        $product['price']  = $product->price;
        $product['discount'] = $product ->discount ;
        $product['tax'] =   $product -> tax;  
        $product['images'] = $product ->images ;
        $product['param_size']= $product ->param_size ;
        $product['param_gender'] =$product ->param_gender ;
        $product['param_subcategory']=$product ->param_subcategory ;
        $product['param_color']=$product ->param_color ;
        $product['param_state']=$product ->param_state ;
        $data[] = $product; 
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
        $product=new Product;   
        $product->reference = $request -> reference ;
        $product->name= $request ->name ;
        $product->description = $request -> description  ;
        $product->stock = $request -> stock  ;
        $product->price = $request -> price  ;
        $product->discount = $request -> discount  ;
        $product->tax = $request -> tax  ;
        $product->images = $request -> images  ;
        $product->param_size  = $request -> param_size   ;
        $product->param_gender  = $request -> param_gender   ;
        $product->param_subcategory  = $request -> param_subcategory   ;
        $product->param_color   = $request -> param_color    ;
        $product->param_state  = $request -> param_state   ;
        $product-> save ();    // save
        $data=[
          'message' => 'Product created successfully',
          'Product' => $product,
        ];
        return response()->json($data);
    }

    /**
     * Display the specified resource.
     */
    public function show( Product $product)
    {
        return response()->json($product);
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
    public function update(Request $request, Product $product)
    {
        
        $product->provider_id = $request -> provider_id ; 
        $product->reference = $request -> reference ;
        $product->name= $request ->name ;
        $product->description = $request -> description  ;
        $product->stock = $request -> stock  ;
        $product->price = $request -> price  ;
        $product->discount = $request -> discount  ;
        $product->tax = $request -> tax  ;
        $product->images = $request -> images  ;
        $product->param_size  = $request -> param_size   ;
        $product->param_gender  = $request -> param_gender   ;
        $product->param_subcategory  = $request -> param_subcategory   ;
        $product->param_color   = $request -> param_color    ;
        $product->param_state  = $request -> param_state   ;
        $product-> save ();    // save
        $data=[
          'message' => 'Orderdetail update successfully',
          'orderdetail' => $product,
        ];
        return response()->json($data);
    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        $data = [
            'message' => 'orders deleted successfully',
            'order' => $product
        ];
        return response()->json($product);
    }
}
