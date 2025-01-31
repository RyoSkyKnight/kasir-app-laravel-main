<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class ProductController extends Controller
{
    // Add a new product
    public function store(Request $request)
    {
        try {
            // Validasi input
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'stock' => 'required|integer|min:0',
                'price' => 'required|numeric|min:0',
                'status' => 'nullable|string',
                'image' => 'image|mimes:jpg,jpeg,png|max:2048|nullable',
                'created_at' => 'nullable',
                'updated_at' => 'nullable',
            ]);

            // Simpan data ke database
            $product = Product::create($validated);

            return response()->json([
                'message' => 'Product added successfully!',
                'product' => $product,
            ], 201);
        } catch (ValidationException $e) {
            // Tangani kesalahan validasi
            return response()->json([
                'message' => 'Validation error',
                'errors' => $e->validator->errors(),
            ], 422);
        } catch (\Exception $e) {
            // Tangani kesalahan umum
            return response()->json([
                'message' => 'An error occurred while adding the product.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    // Retrieve all products
    public function index()
    {
        $products = Product::all();

        return response()->json([
            'products' => $products,
        ], 200);
    }

    public function delete(Request $request, $id){
        $product = Product::find($id);
        if($product){
            $product->delete();
            return response()->json([
                'message' => 'Product deleted successfully!',
            ], 200);
        }else{
            return response()->json([
                'message' => 'Product not found',
            ], 404);
        }
    }

    public function update(Request $request, $id){
        $product = Product::find($id);
        if($product){
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'stock' => 'required|integer|min:0',
                'price' => 'required|numeric|min:0',
                'status' => 'nullable|string',
                'image' => 'image|mimes:jpg,jpeg,png|max:2048|nullable',
                'created_at' => 'nullable',
                'updated_at' => 'nullable',
            ]);
            $product->update($validated);
            return response()->json([
                'message' => 'Product updated successfully!',
                'product' => $product,
            ], 200);
        }else{
            return response()->json([
                'message' => 'Product not found',
            ], 404);
        }
    }
}