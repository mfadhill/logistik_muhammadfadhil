<?php

namespace App\Http\Controllers;

use App\Models\BarangKeluar;
use App\Models\BarangMasuk;
use App\Models\Barang;
use Illuminate\Http\Request;

class BarangKeluarController extends Controller
{
    public function index()
    {
        $barangKeluar = BarangKeluar::all();
        return view('barang_keluar.index', compact('barangKeluar'));
    }

    public function create()
    {
        $barangMasuk = BarangMasuk::with('barang')->get();
        return view('barang_keluar.create', compact('barangMasuk'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'no_barang_keluar' => 'required|unique:barang_keluar',
            'kode_barang' => 'required',
            'quantity' => 'required|integer|min:1',
            'destination' => 'required',
            'tanggal_keluar' => 'required|date',
        ]);

        $barang = Barang::where('kode_barang', $validatedData['kode_barang'])->first();

        if (!$barang) {
            return redirect()->route('barang_keluar.index')->with('error', 'Barang dengan kode tersebut tidak ditemukan.');
        }   

        if ($barang->stok < $validatedData['quantity']) {
            return redirect()->route('barang_keluar.index')->with('error', 'Stok barang tidak cukup.');
        }

        $barangKeluar = BarangKeluar::create($validatedData);

        $barang->stok -= $validatedData['quantity'];
        $barang->save();

        return redirect()->route('barang_keluar.index')->with('success', 'Barang berhasil keluar.');
    }
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'no_barang_keluar' => 'required',
            'kode_barang' => 'required',
            'quantity' => 'required|integer|min:1',
            'destination' => 'required',
            'tanggal_keluar' => 'required|date',
        ]);

        $barangKeluar = BarangKeluar::findOrFail($id);
        $barangKeluar->update($validatedData);

        $barang = Barang::where('kode_barang', $validatedData['kode_barang'])->first();
        if ($barang) {
            $barang->stok += $barangKeluar->quantity - $validatedData['quantity'];
            $barang->save();
        }

        return redirect()->route('barang_keluar.index')->with('success', 'Barang keluar berhasil diupdate.');
    }

    public function destroy($id)
    {
        $barangKeluar = BarangKeluar::findOrFail($id);

        $barang = Barang::where('kode_barang', $barangKeluar->kode_barang)->first();
        if ($barang) {
            $barang->stok += $barangKeluar->quantity;
            $barang->save();
        }

        $barangKeluar->delete();

        return redirect()->route('barang_keluar.index')->with('success', 'Barang keluar berhasil dihapus.');
    }
}
