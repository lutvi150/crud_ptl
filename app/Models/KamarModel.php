<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KamarModel extends Model
{
    protected $table = "table_kamar";
    protected $primaryKey="id_kamar";
    protected $fillable = ['id_kamar','nama_kamar','harga_kamar','fasilitas'];
    public $timestamps = false;
    

}
