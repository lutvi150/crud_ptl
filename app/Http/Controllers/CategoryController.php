<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        $response = [
            'status' => 'success',
            'data' => $categories
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
            'description' => 'nullable|string',
        ];
        $messages = [
            'name.required' => 'Name is required',
            'name.string' => 'Name must be a string',
            'name.max' => 'Name must not be greater than 255 characters',
            'description.string' => 'Description must be a string',
        ];
        $validation = Validator::make($request->all(), $rules, $messages);
        if ($validation->fails()) {
            $response = [
                'status' => 'error',
                'message' => 'Validation errors',
                'errors' => $validation->errors()
            ];
        } else {
            $type = $request->action;
            if ($type == 'add') {
                $category = new Category();
                $category->name = $request->name;
                $category->description = $request->description;
                $category->save();
                $response = [
                    'status' => 'success',
                    'message' => 'Category added successfully',
                    'data' => $category
                ];
            } else if ($type == 'edit') {
                $category = Category::find($request->id);
                $category->name = $request->name;
                $category->description = $request->description;
                $category->save();
                $response = [
                    'status' => 'success',
                    'message' => 'Category updated successfully',
                    'data' => $category
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
        $category = Category::findOrFail($id);
        $response = [
            'status' => 'success',
            'data' => $category
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
        Category::destroy($id);
        $response = [
            'status' => 'success',
            'message' => 'Category deleted successfully'
        ];
        return response()->json($response, 200);
    }
}
