<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with('category')->get();
        $response = [
            "status" => 'success',
            "message" => 'Data retrieved successfully',
            "data" => $products
        ];
        return response()->json($response, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'category' => 'required|exists:categories,id'
        ];
        $message = [
            'name.required' => 'Name is required',
            'description.required' => 'Description is required',
            'price.required' => 'Price is required',
            'price.min' => 'Price must be greater than or equal to 0',
            'category.required' => 'Category is required',
            'category.exists' => 'Category not found'
        ];
        $validator = Validator::make($request->all(), $rules, $message);
        if ($validator->fails()) {
            $response = [
                "status" => 'error',
                "message" => 'Validation error',
                "errors" => $validator->errors()
            ];
        } else {
            $type = $request->action;
            if ($type == 'add') {
                $product = new Product;
                $product->name = $request->name;
                $product->description = $request->description;
                $product->price = $request->price;
                $product->category_id = $request->category;
                $product->save();
                $response = [
                    "status" => 'success',
                    "message" => 'Data added successfully',
                ];
            } else {
                $product = Product::find($request->id);
                $product->name = $request->name;
                $product->description = $request->description;
                $product->price = $request->price;
                $product->category_id = $request->category;
                $product->save();
                $response = [
                    "status" => 'success',
                    "message" => 'Data updated successfully',
                ];
            }
        }
        return response()->json($response, 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::findOrFail($id);
        $response = [
            "status" => 'success',
            "message" => 'Data retrieved successfully',
            "data" => $product
        ];
        return response()->json($response, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Product::destroy($id);
        $response = [
            "status" => 'success',
            "message" => 'Data deleted successfully'
        ];
        return response()->json($response, 200);
    }
}
