<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;
use Illuminate\Http\Response;

class ProductController extends Controller
{
    public function index()
    {
        return response()->json([
            'message' => 'Products retrieved successfully',
            'products' => ProductResource::collection(Product::all())
        ], Response::HTTP_OK);
    }

    public function store(ProductRequest $request)
    {
        $product = Product::create($request->validated());

        return response()->json([
            'message' => 'Product created successfully',
            'product' => new ProductResource($product)
        ], Response::HTTP_CREATED);
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);

        return response()->json([
            'message' => 'Product retrieved successfully',
            'product' => new ProductResource($product)
        ], Response::HTTP_OK);
    }

    public function update(ProductRequest $request, $id)
    {
        $product = Product::findOrFail($id);
        $product->update($request->validated());

        return response()->json([
            'message' => 'Product updated successfully',
            'product' => new ProductResource($product)
        ], Response::HTTP_OK);
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return response()->json([
            'message' => 'Product deleted successfully'
        ], Response::HTTP_OK);
    }
}
