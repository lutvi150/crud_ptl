<?php

namespace App\Http\Controllers;

use App\Models\KamarModel as Kamal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KamarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kamar=Kamal::orderBy('id_kamar','desc')->get();
        $response=[
            'status'=> 'success',
            'message'=> 'Data berhasil ditemukan',
            'data' => $kamar
        ];
        return response()->json($response,200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validation=Valida::make($request->all(),[
            'nama_kamar' =>'required',
            'harga_kamar' =>'required',
            'fasilitas' =>'required',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
        //
    }
}
