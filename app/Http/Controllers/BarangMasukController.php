<?php

namespace App\Http\Controllers;

use App\Models\BarangMasuk;
use App\Models\Barang;
use Illuminate\Http\Request;

class BarangMasukController extends Controller
{
    public function index()
    {
        $barangMasuk = BarangMasuk::all();
        return view('barang_masuk.index', compact('barangMasuk'));
    }

    public function create()
    {
        return view('barang_masuk.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'no_barang_masuk' => 'required|unique:barang_masuk',
            'kode_barang' => 'required',
            'quantity' => 'required|integer|min:1',
            'origin' => 'required',
            'tanggal_masuk' => 'required|date',
        ]);

        $barang = Barang::where('kode_barang', $validatedData['kode_barang'])->first();

        if (!$barang) {
            $barang = Barang::create([
                'kode_barang' => $validatedData['kode_barang'],
                'stok' => 0, // Stok awal diatur ke 0
            ]);
        }

        $barangMasuk = BarangMasuk::create($validatedData);

        $barang->stok += $validatedData['quantity'];
        $barang->save();

        return redirect()->route('barang_masuk.index')->with('success', 'Barang berhasil masuk.');
    }
}
