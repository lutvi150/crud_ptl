<?php

namespace App\Http\Controllers;

use App\Models\TamuModel as Tamu;
use App\Models\TransaksiModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TamuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tamu=Tamu::orderBy('table_tamu.id_tamu','desc')->join('table_kamar','table_kamar.id_kamar','=','table_tamu.id_kamar')->join('table_transaksi','table_transaksi.id_tamu','=','table_tamu.id_tamu')->get();
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
        $rules=[
            'nama_tamu'=>'required',
            'nomor_kontak'=>'required|numeric',
            'id_kamar'=>'required|numeric',
            'tgl_in'=>'required|date',
            'tgl_out'=>'required|date'
        ];
        $message=[
            'nama_tamu.required'=> 'Nama tamu tidak boleh kosong',
            'nomor_kontak.required'=> 'Nomor kontak tidak boleh kosong',
            'nomor_kontak.numeric'=> 'Nomor kontak harus berupa angka',
            'id_kamar.required'=> 'Kamar tidak boleh kosong',
            'id_kamar.numeric'=> 'Kamar harus berupa angka',
            'tgl_in.required'=> 'Tanggal masuk tidak boleh kosong',
            'tgl_in.date'=> 'Tanggal masuk harus berupa tanggal',
            'tgl_out.required'=> 'Tanggal keluar tidak boleh kosong',
            'tgl_out.date'=> 'Tanggal keluar harus berupa tanggal'
        ];
        $validation=Validator::make($request->all(),$rules,$message);
        if($validation->fails()){
            $response=[
                'status'=> 'error',
                'message'=>'Data tamu gagal ditambahkan',
                'error'=> $validation->errors(),
            ];
        }else{
            $type=$request->input('type');
            if($type=='add'){
                $tamu=new Tamu;
                $tamu->nama_tamu=$request->nama_tamu;
                $tamu->nomor_kontak=$request->nomor_kontak;
                $tamu->id_kamar=$request->id_kamar;
                $tamu->tgl_in=$request->tgl_in;
                $tamu->tgl_out=$request->tgl_out;
                $tamu->save();
                $response=[
                    'status'=>'success',
                    'message'=> 'Data tamu berhasil ditambahkan',
                    'data'=> $tamu
                ];
            }else{
                $tamu=Tamu::find($request->id_tamu);
                $tamu->update($request->all());
                $update=[
                    'total_harga'=>$request->total_harga,
                    'lama_menginap'=>$request->durasi
                ];
                // transaction
               $transaksi=TransaksiModel::where('id_tamu', $request->id_tamu)->update( $update );
                $response=[
                    'status'=> 'success',
                    'message'=> 'Data tamu berhasil diubah',
                    'data'=> $tamu
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
        $tamu=Tamu::findOrFail($id);
        $transaksi=TransaksiModel::where('id_tamu', $id)->first();
        $response=[
            'status'=>'success',
            'message'=> 'Data tamu berhasil ditampilkan',
            'data'=> $tamu,
            'transaksi'=>$transaksi
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
        $transaksi=TransaksiModel::where('id_tamu', $id)->delete();
        $tamu=Tamu::find($id);
        $tamu->delete();
        $response=[
            'status'=>'success',
            'message'=> 'Data tamu berhasil dihapus'
        ];
        return response()->json($response,200);
    }
}
