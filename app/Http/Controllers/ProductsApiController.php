<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductsApi;
class ProductsApiController extends Controller
{
    public function index()
    {
        return response()->json(ProductsApi::all());
    }

     /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $post = ProductsApi::create($request->all());
        return response()->json($post, 201);
    }


   

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return response()->json(ProductsApi::find($id));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $post = ProductsApi::findOrFail($id);
        $post->update($request->all());
        return response()->json($post);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        ProductsApi::findOrFail($id)->delete();
        return response()->json(null, 204);

    }

    public function getLatestProducts()
    {
        $latestProducts = ProductsApi::getLatestProducstModel();
        return response()->json($latestProducts);
    }
    public function getProductsHot()
    {
        $ProductsHot = ProductsApi::getProductsHot();
        return response()->json($ProductsHot);
    }

}
