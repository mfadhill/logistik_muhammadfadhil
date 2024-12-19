<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BarangKeluar;
use Illuminate\Http\Request;

class BarangKeluarController extends Controller
{
    // Menampilkan daftar barang keluar
    public function index()
    {
        // Mengambil data barang keluar beserta data barang yang terkait
        $barangKeluar = BarangKeluar::with('barang')->get();
        return view('barang_keluar.index', compact('barangKeluar'));
    }

    // Menampilkan form untuk tambah barang keluar
    public function create()
    {
        // Mengambil semua data barang untuk dropdown
        $barang = Barang::all();
        return view('barang_keluar.create', compact('barang'));
    }

    // Menyimpan data barang keluar
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'barang_id' => 'required|exists:barang,id',  // Memastikan barang_id ada di tabel barang
            'no_barang_keluar' => 'required|unique:barang_keluar,no_barang_keluar',
            'quantity' => 'required|integer|min:1',
            'destination' => 'required|string',
            'tanggal_keluar' => 'required|date',
        ]);

        // Menyimpan data barang keluar
        BarangKeluar::create([
            'barang_id' => $request->barang_id,
            'no_barang_keluar' => $request->no_barang_keluar,
            'quantity' => $request->quantity,
            'destination' => $request->destination,
            'tanggal_keluar' => $request->tanggal_keluar,
        ]);

        // Update stok barang
        $barang = Barang::find($request->barang_id);
        $barang->stok -= $request->quantity;
        $barang->save();

        return redirect()->route('barang_keluar.index')->with('success', 'Barang Keluar Berhasil Ditambahkan');
    }
}
