<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BarangKeluar extends Model
{
    protected $table = 'barang_keluar';
    protected $guarded = ['id'];


    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }
}
