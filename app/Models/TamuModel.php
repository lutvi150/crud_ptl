<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TamuModel extends Model
{
    protected $table = "table_tamu";
    protected $fillable = ['id_tamu','nama_kamu','id_kamar','tgl_in','tgl_out'];
    public $timestamps = false;
    public function kamar()
    {
        return $this->belongsTo(KamarModel::class, 'id_kamar');
    }
}
