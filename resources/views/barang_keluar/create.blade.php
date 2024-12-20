@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Tambah Barang Keluar</h1>
        <form action="{{ route('barang_keluar.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="no_barang_keluar">No Barang Keluar</label>
                <input type="text" name="no_barang_keluar" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="kode_barang">Kode Barang</label>
                <select name="kode_barang" class="form-control" required>
                    <option value="" disabled selected>Pilih Kode Barang</option>
                    @foreach ($barangMasuk as $item)
                        <option value="{{ $item->kode_barang }}">{{ $item->kode_barang }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="quantity">Quantity</label>
                <input type="number" name="quantity" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="destination">Tujuan (Destination)</label>
                <input type="text" name="destination" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="tanggal_keluar">Tanggal Keluar</label>
                <input type="date" name="tanggal_keluar" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-success mt-3">Simpan</button>
        </form>
    </div>
@endsection
