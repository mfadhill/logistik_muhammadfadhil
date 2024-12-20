<?php

namespace App\Http\Controllers;

use App\Models\BarangKeluar;
use App\Models\BarangMasuk;
use App\Models\Barang;
use Illuminate\Http\Request;

class BarangKeluarController extends Controller
{
    // Menampilkan daftar barang keluar (optional)
    public function index()
    {
        $barangKeluar = BarangKeluar::all(); // Ambil semua data barang keluar
        return view('barang_keluar.index', compact('barangKeluar')); // Ganti dengan view yang sesuai
    }

    // Menampilkan form untuk membuat barang keluar baru
    public function create()
    {
        $barangMasuk = BarangMasuk::with('barang')->get(); // Ambil data barang masuk beserta barang terkait
        return view('barang_keluar.create', compact('barangMasuk'));
    }

    public function store(Request $request)
    {
        // Validasi data
        $validatedData = $request->validate([
            'no_barang_keluar' => 'required|unique:barang_keluar',
            'kode_barang' => 'required',
            'quantity' => 'required|integer|min:1',
            'destination' => 'required',
            'tanggal_keluar' => 'required|date',
        ]);

        // Cek apakah barang dengan kode_barang sudah ada di tabel barang
        $barang = Barang::where('kode_barang', $validatedData['kode_barang'])->first();

        // Jika barang tidak ada di tabel barang, maka redirect dengan pesan error
        if (!$barang) {
            return redirect()->route('barang_keluar.index')->with('error', 'Barang dengan kode tersebut tidak ditemukan.');
        }

        // Cek apakah stok barang cukup untuk keluar
        if ($barang->stok < $validatedData['quantity']) {
            return redirect()->route('barang_keluar.index')->with('error', 'Stok barang tidak cukup.');
        }

        // Simpan data barang keluar
        $barangKeluar = BarangKeluar::create($validatedData);

        // Update stok di tabel barang
        $barang->stok -= $validatedData['quantity'];
        $barang->save();

        return redirect()->route('barang_keluar.index')->with('success', 'Barang berhasil keluar.');
    }
}
