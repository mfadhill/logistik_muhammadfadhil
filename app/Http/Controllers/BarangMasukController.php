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
                'stok' => 0,
            ]);
        }

        $barangMasuk = BarangMasuk::create($validatedData);

        $barang->stok += $validatedData['quantity'];
        $barang->save();

        return redirect()->route('barang_masuk.index')->with('success', 'Barang berhasil masuk.');
    }

    public function edit($id)
    {
        // Ambil data barang masuk berdasarkan ID
        $barangMasuk = BarangMasuk::findOrFail($id);

        return view('barang_masuk.edit', compact('barangMasuk'));
    }

    public function update(Request $request, $id)
    {
        // Validasi data yang diupdate
        $validatedData = $request->validate([
            'no_barang_masuk' => 'required|unique:barang_masuk,no_barang_masuk,' . $id,
            'kode_barang' => 'required',
            'quantity' => 'required|integer|min:1',
            'origin' => 'required',
            'tanggal_masuk' => 'required|date',
        ]);

        // Cari barang masuk yang akan diupdate
        $barangMasuk = BarangMasuk::findOrFail($id);

        // Cari barang berdasarkan kode_barang
        $barang = Barang::where('kode_barang', $validatedData['kode_barang'])->first();

        // Update data barang masuk
        $barangMasuk->update($validatedData);

        // Update stok barang
        if ($barang) {
            // Update stok berdasarkan perubahan quantity
            $barang->stok += $validatedData['quantity'] - $barangMasuk->quantity;
            $barang->save();
        }

        return redirect()->route('barang_masuk.index')->with('success', 'Barang berhasil diupdate.');
    }

    public function destroy($id)
    {
        // Cari data barang masuk berdasarkan ID
        $barangMasuk = BarangMasuk::findOrFail($id);

        // Ambil data barang terkait
        $barang = Barang::where('kode_barang', $barangMasuk->kode_barang)->first();

        if ($barang) {
            // Kurangi stok barang sesuai dengan quantity barang masuk yang dihapus
            $barang->stok -= $barangMasuk->quantity;
            $barang->save();
        }

        // Hapus data barang masuk
        $barangMasuk->delete();

        return redirect()->route('barang_masuk.index')->with('success', 'Barang berhasil dihapus.');
    }
}
