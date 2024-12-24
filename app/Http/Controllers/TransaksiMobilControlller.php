<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TransaksiMobilControlller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transaksi = Transaction::with((['customer', 'product']))->get();
        $response = [
            "status" => 'success',
            'message' => 'Data transaksi berhasil ditampilkan',
            'data' => $transaksi
        ];
        return response()->json($response);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'customer_id' => 'required|exists:customers,id',
            'product_id' => 'required|exists:products,id',
            'total_price' => 'required|numeric|min:0',
            'transaction_date' => 'required|date'
        ];
        $validation = Validator::make($request->all(), $rules);
        if ($validation->fails()) {
            $response = [
                "status" => 'error',
                'message' => 'Data transaksi gagal ditambahkan',
                'errors' => $validation->errors()
            ];
        } else {
            $type = $request->action;
            if ($type == 'add') {
                $transaksi = new Transaction();
                $transaksi->customer_id = $request->customer_id;
                $transaksi->product_id = $request->product_id;
                $transaksi->total_price = $request->total_price;
                $transaksi->transaction_date = $request->transaction_date;
                $transaksi->save();
                $response = [
                    "status" => 'success',
                    'message' => 'Data transaksi berhasil ditambahkan'
                ];
            } else {
                $transaksi = Transaction::find($request->id);
                $transaksi->customer_id = $request->customer_id;
                $transaksi->product_id = $request->product_id;
                $transaksi->total_price = $request->total_price;
                $transaksi->transaction_date = $request->transaction_date;
                $transaksi->save();
                $response = [
                    "status" => 'success',
                    'message' => 'Data transaksi berhasil diubah'
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
        $transaksi = Transaction::findOrFail($id);
        $response = [
            "status" => 'success',
            'message' => 'Data transaksi berhasil ditampilkan',
            'data' => $transaksi
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
        Transaction::destroy($id);
        $response = [
            "status" => 'success',
            'message' => 'Data transaksi berhasil dihapus'
        ];
        return response()->json($response, 200);
    }
}
