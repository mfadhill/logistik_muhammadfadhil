<?php

namespace App\Http\Controllers;

use App\Models\BarangMasuk;
use App\Models\Barang;
use Illuminate\Http\Request;

class BarangMasukController extends Controller
{
    // Method untuk menampilkan daftar barang masuk
    public function index()
    {
        // Mengambil semua data barang masuk
        $barangMasuk = BarangMasuk::with('barang')->get(); // Pastikan untuk eager load relasi dengan tabel barang

        // Menampilkan view daftar barang masuk
        return view('barang_masuk.index', compact('barangMasuk'));
    }

    // Method untuk menampilkan form tambah barang masuk
    public function create()
    {
        $barang = Barang::all(); // Mengambil semua data barang untuk dropdown
        return view('barang_masuk.create', compact('barang'));
    }

    // Method untuk menyimpan barang masuk
    public function store(Request $request)
    {
        $validated = $request->validate([
            'barang_id' => 'required|exists:barang,id',
            'no_barang_masuk' => 'required|unique:barang_masuk,no_barang_masuk',
            'quantity' => 'required|integer|min:1',
            'origin' => 'required|string',
            'tanggal_masuk' => 'required|date',
        ]);

        // Menyimpan data barang masuk
        BarangMasuk::create([
            'barang_id' => $request->barang_id,
            'no_barang_masuk' => $request->no_barang_masuk,
            'quantity' => $request->quantity,
            'origin' => $request->origin,
            'tanggal_masuk' => $request->tanggal_masuk,
        ]);

        return redirect()->route('barang_masuk.index')->with('success', 'Barang Masuk Berhasil Ditambahkan');
    }

    // Method untuk menampilkan form edit barang masuk
    public function edit($id)
    {
        $barangMasuk = BarangMasuk::findOrFail($id); // Mencari barang masuk berdasarkan ID
        $barang = Barang::all(); // Mengambil semua data barang untuk dropdown

        return view('barang_masuk.edit', compact('barangMasuk', 'barang'));
    }

    // Method untuk memperbarui data barang masuk
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'barang_id' => 'required|exists:barang,id',
            'no_barang_masuk' => 'required|unique:barang_masuk,no_barang_masuk,' . $id,
            'quantity' => 'required|integer|min:1',
            'origin' => 'required|string',
            'tanggal_masuk' => 'required|date',
        ]);

        // Menemukan barang masuk berdasarkan ID dan memperbarui data
        $barangMasuk = BarangMasuk::findOrFail($id);
        $barangMasuk->update([
            'barang_id' => $request->barang_id,
            'no_barang_masuk' => $request->no_barang_masuk,
            'quantity' => $request->quantity,
            'origin' => $request->origin,
            'tanggal_masuk' => $request->tanggal_masuk,
        ]);

        return redirect()->route('barang_masuk.index')->with('success', 'Barang Masuk Berhasil Diperbarui');
    }

    // Method untuk menghapus barang masuk
    public function destroy($id)
    {
        // Menemukan barang masuk berdasarkan ID dan menghapusnya
        $barangMasuk = BarangMasuk::findOrFail($id);
        $barangMasuk->delete();

        return redirect()->route('barang_masuk.index')->with('success', 'Barang Masuk Berhasil Dihapus');
    }
}
