<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransaksiModel extends Model
{
    protected $table = "table_transaksi";
    protected $fillable = ["id_transaksi", "id_tamu", "total_harga", "lama_menginap"];
    public $timestamps = false;
    
}
