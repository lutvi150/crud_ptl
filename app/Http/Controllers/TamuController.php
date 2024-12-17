<?php

namespace App\Http\Controllers;

use App\Models\TamuModel as Tamu;
use Illuminate\Http\Request;

class TamuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tamu=Tamu::orderBy('id_tamu','desc')->join('table_kamar','table_kamar.id_kamar','=','table_tamu.id_kamar')->get();
        $response=[
            'status'=>'success',
            'message'=> 'Data tamu berhasil ditampilkan',
            'data'=> $tamu
        ];
        return response()->json($response, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
