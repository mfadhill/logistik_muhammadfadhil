<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BarangMasuk;
use App\Models\BarangKeluar;
use Illuminate\Http\Request;

class StokController extends Controller
{
    public function index()
    {
        $barang = Barang::all();

        $stokBarang = [];

        foreach ($barang as $item) {
            $barangMasuk = BarangMasuk::where('kode_barang', $item->kode_barang)->get();
            $barangKeluar = BarangKeluar::where('kode_barang', $item->kode_barang)->get();

            $totalMasuk = 0;
            $totalKeluar = 0;

            foreach ($barangMasuk as $masuk) {
                $totalMasuk += $masuk->quantity;
            }

            foreach ($barangKeluar as $keluar) {
                $totalKeluar += $keluar->quantity;
            }

            $stokTersedia = $item->stok;

            $stokBarang[] = [
                'kode_barang' => $item->kode_barang,
                'quantity_masuk' => $totalMasuk,
                'quantity_keluar' => $totalKeluar,
                'stok_tersedia' => $stokTersedia,
                'barang_masuk' => $barangMasuk,
                'barang_keluar' => $barangKeluar,
            ];
        }
        // dd($stokBarang);
        return view('stok_barang.index', compact('stokBarang'));
    }

    public function destroy($kode_barang)
    {
        $barang = Barang::where('kode_barang', $kode_barang)->first();

        if ($barang) {
            $barangMasuk = BarangMasuk::where('kode_barang', $kode_barang)->get();
            $barangKeluar = BarangKeluar::where('kode_barang', $kode_barang)->get();

            $totalMasuk = $barangMasuk->sum('quantity');
            $totalKeluar = $barangKeluar->sum('quantity');

            BarangMasuk::where('kode_barang', $kode_barang)->delete();
            BarangKeluar::where('kode_barang', $kode_barang)->delete();

            $barang->stok -= $totalMasuk;
            $barang->stok += $totalKeluar;
            $barang->save();

            $barang->delete();
        }

        return redirect()->route('stok.barang.index')->with('success', 'Data barang berhasil dihapus dan stok diperbarui.');
    }
}
