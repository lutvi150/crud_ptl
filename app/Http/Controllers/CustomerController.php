<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers = Customer::all();
        $response = [
            "status" => "success",
            "message" => "Data retrieved successfully",
            "data" => $customers,
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
            'phone' => 'required|string|max:15',
            'address' => 'required|string'
        ];
        $messages = [
            'name.required' => 'Name is required',
            'name.string' => 'Name must be a string',
            'name.max' => 'Name must not be greater than 255 characters',
            'email.required' => 'Email is required',
            'email.string' => 'Email must be a string',
            'email.max' => 'Email must not be greater than 255 characters',
            'phone.required' => 'Phone is required',
            'phone.string' => 'Phone must be a string',
            'phone.max' => 'Phone must not be greater than 15 characters',
            'address.required' => 'Address is required',
            'address.string' => 'Address must be a string',
        ];
        $type = $request->action;
        if ($type == 'add') {
            $rules['email'] = 'required|string|email|max:255|unique:customers';
            $messages['email.unique'] = 'Email already exists';
        } else {
            $rules['email'] = 'required|string|email|max:255';
        }
        $validation = Validator::make($request->all(), $rules, $messages);
        if ($validation->fails()) {
            $response = [
                "status" => "error",
                "message" => "Validation errors",
                "errors" => $validation->errors(),
            ];
        } else {
            if ($type == 'add') {
                $customer = new Customer();
                $customer->name = $request->name;
                $customer->email = $request->email;
                $customer->phone = $request->phone;
                $customer->address = $request->address;
                $customer->save();
                $response = [
                    "status" => "success",
                    "message" => "Data added successfully",
                    "data" => $customer,
                ];
            } else {
                $customer = Customer::find($request->id);
                $customer->name = $request->name;
                $customer->email = $request->email;
                $customer->phone = $request->phone;
                $customer->address = $request->address;
                $customer->save();
                $response = [
                    "status" => "success",
                    "message" => "Data updated successfully",
                    "data" => $customer,
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
        $customer = Customer::findOrFail($id);
        $response = [
            "status" => "success",
            "message" => "Data retrieved successfully",
            "data" => $customer,
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
        Customer::destroy($id);
        $response = [
            "status" => "success",
            "message" => "Data deleted successfully",
        ];
        return response()->json($response, 200);
    }
}
