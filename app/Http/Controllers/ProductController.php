<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ServiceController as OS;

use App\Models\Param;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Provider;;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private function getParamName($paramId)
    {
        $param = Param::find($paramId);

        return $param ? $param->name : null;
    }

    private function getProviderName($providerId)
    {
        $provider = Provider::find($providerId);

        return $provider ? $provider->legal_name : null;
    }




    public function index()
    {

        $products = Product::all()->sortBy('id');

        foreach ($products as $product) {
            $product['provider_id'] = $this->getProviderName($product->provider_id);
            $product['reference'] = $product->reference;
            $product['name'] = $product->name;
            $product['description'] = $product->description;
            $product['stock'] = $product->stock;
            $product['price'] = $product->price;
            $product['discount'] = $product->discount;
            $product['tax'] = $product->tax;
            $product['images'] = $product->images;
            $product['param_size'] = $this->getParamName($product->param_size);
            $product['param_gender'] = $this->getParamName($product->param_gender);
            $product['param_mark'] = $this->getParamName($product->param_mark);
            $product['param_subcategory'] = $this->getParamName($product->param_subcategory);
            $product['param_color'] = $this->getParamName($product->param_color);
            $product['param_state'] = $this->getParamName($product->param_state);
            $data[] = $product;
        }
        if (count($products) == null) {
            $data = $products;
            return OS::frontendResponse('404', 'error',  $data, $msg = 'Productos no encontrado.');
        } else {
            return OS::frontendResponse('200', 'success', $data, $msg = 'Productos encontrados');
        }
    }
    // if (count($products) == 0) {
    //     return OS::frontendResponse('404', 'error', null, 'No se encontraron productos');
    // }

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
    // Verificar si ya existe un producto con el mismo nombre y referencia en la base de datos
    $existingProduct = Product::where('name', $request->name)
                                ->where('reference', $request->reference)
                                ->first();

    if ($existingProduct) {
        return OS::frontendResponse('400', 'error', null, 'El producto con este nombre y referencia ya existe.');
    }

    // Si el producto no existe, crea un nuevo producto
    $product = new Product;
    $product->provider_id = $request->provider_id;
    $product->reference = $request->reference;
    $product->name = $request->name;
    $product->description = $request->description;
    $product->stock = $request->stock;
    $product->price = $request->price;
    $product->discount = $request->discount;
    $product->tax = $request->tax;
    $product->images = $request->images;
    $product->param_size = $request->param_size;
    $product->param_gender = $request->param_gender;
    $product->param_subcategory = $request->param_subcategory;
    $product->param_color = $request->param_color;
    $product->param_state = $request->param_state;

    $product->save();

    return OS::frontendResponse('200', 'success', $product, 'Producto creado correctamente');
}
    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $data[] = $product;
        if ($data == null) {
            return OS::frontendResponse('404', 'error',  [], $msg = 'Producto no encontrado.');
        } else {
            return OS::frontendResponse('200', 'success', $data, $msg = 'Producto encontrado.');
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
    public function update(Request $request, Product $product)
    {

        $product->provider_id = $request->provider_id;
        $product->reference = $request->reference;
        $product->name = $request->name;
        $product->description = $request->description;
        $product->stock = $request->stock;
        $product->price = $request->price;
        $product->discount = $request->discount;
        $product->tax = $request->tax;
        $product->images = $request->images;
        $product->param_size = $request->param_size;
        $product->param_gender = $request->param_gender;
        $product->param_subcategory = $request->param_subcategory;
        $product->param_color = $request->param_color;
        $product->param_state = $request->param_state;
        $product->save();    // save
        $data[] = $product;
        if ($data == null) {
            return OS::frontendResponse('404', 'error',  $data, $msg = 'Producto no actualizado.');
        } else {
            return OS::frontendResponse('200', 'success', $data, $msg = 'Producto actualizado correctamente.');
        }
    }

    public function destroy(Product $product)
    {
        if ($product->param_state != 1652) {
            $product->param_state = 1652;
            $product->save();
            $data[] = $product;
            return OS::frontendResponse('200', 'success', $data, $msg = 'El producto se ha desactivado correctamente.');
        } else {
            return OS::frontendResponse('404', 'error', [], $msg = 'El producto ya se encuentra inactivo.');
        }
    }
}
