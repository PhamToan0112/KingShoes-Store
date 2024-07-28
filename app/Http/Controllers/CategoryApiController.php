<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CategoryApi;

class CategoryApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(CategoryApi::all());

    }


     public function store(Request $request)
    {
        $post = CategoryApi::create($request->all());
        return response()->json($post, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return response()->json(CategoryApi::find($id));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $post = CategoryApi::findOrFail($id);
        $post->update($request->all());
        return response()->json($post);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        CategoryApi::findOrFail($id)->delete();
        return response()->json(null, 204);

    }

}
