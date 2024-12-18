<?php

namespace App\Http\Controllers;

use App\Models\KamarModel as Kamar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KamarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kamar=Kamar::orderBy('id_kamar','desc')->get();
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
        $rules=[
            'nama_kamar' =>'required',
            'harga_kamar' =>'required',
            'fasilitas' =>'required',
        ] ;
        $message=[
            'nama_kamar.required'=> 'Nama kamar harus diisi',
            'harga_kamar.required'=> 'Harga kamar harus diisi',
            'fasilitas.required'=> 'Fasilitas kamar harus diisi',
        ];
        $validation=Validator::make($request->all(),$rules,$message);
        if($validation->fails()){
            $response=[
               'status'=> 'error',
               'message'=> 'Data gagal disimpan',
                'error' => $validation->errors()
            ];
        }else{
            $type= $request->input('type');
            if ($type=='add') {
                $kamar= new Kamar;
                $kamar->nama_kamar=$request->nama_kamar;
                $kamar->harga_kamar=$request->harga_kamar;
                $kamar->fasilitas=$request->fasilitas;
                $kamar->save();
            $response=[
                'status'=> 'success',
                'message'=> 'Data berhasil disimpan',
            ];
            }else{
                $kamar=Kamar::find($request->input('id_kamar'));
                $kamar->update($request->all());
                $response=[
                    'status'=> 'success',
                    'message'=> 'Data berhasil diupdate',
                ];
            }
        }
            return response()->json($response,200);  
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $kamar=Kamar::findOrFail($id);
        $response=[
            'status'=> 'success',
            'message'=> 'Data berhasil ditemukan',
            'data' => $kamar
        ];
        return response()->json($response,200);
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
        $kamar=Kamar::findOrFail($id);
        $kamar->delete();
        $response=[
            'status'=> 'success',
            'message'=> 'Data berhasil dihapus',
        ];
        return response()->json($response,200);
    }
}
