<?php

// app/Http/Controllers/StokBarangController.php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BarangMasuk;
use App\Models\BarangKeluar;
use Illuminate\Http\Request;

class StokController extends Controller
{
    public function index()
    {
        // Ambil data barang dan stok barang
        $barang = Barang::all();

        foreach ($barang as $item) {
            $barangMasuk = BarangMasuk::where('barang_id', $item->id)->sum('quantity');
            $barangKeluar = BarangKeluar::where('barang_id', $item->id)->sum('quantity');
            $item->stok_tersedia = $barangMasuk - $barangKeluar;
        }

        // Kirim data barang ke view
        return view('stok_barang.index', compact('barang'));
    }
}
